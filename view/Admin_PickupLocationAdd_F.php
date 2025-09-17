<?php
session_start();

if(!isset($_SESSION['username'])) {
    // header('location: ../index.php?error=sessionExpired');
    // exit;
}
if(!isset($_SESSION['status'])) {
    // header('location: ../index.php?error=invalidRequest');
    // exit;
}

if(!isset($_COOKIE['username'])) {
    // header('location: ../index.php?error=sessionExpired');
    // exit;
}
if(!isset($_COOKIE['status'])) {
    // header('location: ../index.php?error=invalidRequest');
    // exit;
}

require_once('../model/branchModel.php');

$message = "";
$messageColor = "red"; 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $district = (isset($_POST["district"]) && $_POST["district"] !== "") ? trim($_POST["district"]) : "";
    $location = (isset($_POST["location"]) && $_POST["location"] !== "") ? trim($_POST["location"]) : "";

    if (empty($district)) 
        $message = "Please enter a district first.";
    else if (empty($location)) 
        $message = "Please enter a location first.";
    else {
        $branch = [
            'bid' => null,
            'district' => $district,
            'location' => $location,
            'available' => 1
        ];

        $result = addBranch($branch);
        if($result['status'] === "success") {
            $_SESSION['message'] = "Branch added successfully.";
            $_SESSION['messageColor'] = "green";
            header("Location: Admin_PickupLocationAdd_F.php");
            exit;
        }
        else if($result['status'] === "exists") {
            $_SESSION['message'] = "Branch in this area already exists.";
            $_SESSION['messageColor'] = "red";
            header("Location: Admin_PickupLocationAdd_F.php");
            exit;
        }
        else {
            $_SESSION['message'] = "Oops! Something went wrong.";
            $_SESSION['messageColor'] = "red";
            header("Location: Admin_PickupLocationAdd_F.php");
            exit;
        }
    }
}

if (isset($_SESSION['message'])): ?>
    <div id="msg" style="
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        color: white;
        opacity: 0.9;
        padding: 10px 20px;
        border: 1px solid black;
        border-radius: 6px;
        font-family: Inika;
        z-index: 9999;
        box-shadow: 0 5px 10px rgba(0,0,0,0.6);
        background-color: <?= $_SESSION['messageColor'] ?>;
    ">
        <?= htmlspecialchars($_SESSION['message']) ?>
    </div>
    <script>
        setTimeout(() => {
            const msg = document.getElementById('msg');
            if (msg) msg.remove();
        }, 2000);
    </script>
    <?php unset($_SESSION['message'], $_SESSION['messageColor']); ?>
<?php endif;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin_LoyaltyProgramAdd</title>

    <link rel="stylesheet" href="../asset/style_F.css">
</head>

<body>
    <div class="header">
        <img src="../asset/RentNGo logo.png" class="logo" alt="RentNGo Logo">
        <div>
            <h1>RentNGo</h1>
            <h2>Smart Rentals<br>Smooth Rides</h2>
        </div>
    </div>

    <?php if (!empty($message)): ?>
            <div id="msg" style="
                position: fixed;
                top: 20px;
                left: 50%;
                transform: translateX(-50%);
                color: white;
                opacity: 0.9;
                padding: 10px 20px;
                border: 1px solid black;
                border-radius: 6px;
                font-family: Inika;
                z-index: 9999;
                box-shadow: 0 5px 10px rgba(0,0,0,0.6);
                background-color: <?= $messageColor ?>;
            ">
                <?= htmlspecialchars($message) ?>
            </div>
            <script>
                setTimeout(() => {
                    const msg = document.getElementById('msg');
                    if (msg) msg.remove();
                }, 2000);
            </script>
        <?php endif;?>

    <div style="display: flex; flex-direction: row; align-items: center; justify-content: center; margin-top: 10vh;">
        <img src="../asset/points.png" class="loyaltyPoints" alt="Points icon" style="width: 40px;">
        <label class="font-itim" style="font-weight: bold; font-size: 35px;">Loyalty Program Management</label>
    </div><br>

    <form action="Admin_LoyaltyProgramAdd_F.php" method="post" style="margin-top: 5vh;" onsubmit="return validateAddScheme()">
        <fieldset>
            <legend>Add Loyalty Program</legend>
            <label for="scheme">Reward Scheme:</label>
            <input type="text" id="scheme" class="font-itim" name="scheme" style="border-radius: 10px;"
                placeholder="Enter Reward Scheme"> <br> <br>
            <label for="points">Points Required:</label>
            <input type="number" id="points" class="font-itim" name="points" style="border-radius: 10px; 
                width: auto;" placeholder="Required Points"> <br> <br>
            <label for="type">Amentities Type:</label>
            <select id="type" name="type">
                <option value="">Choose type</option>
                <option value="Rent Discount (%)">Rent Discount (%)</option>
                <option value="Rent Discount (tk)">Rent Discount (tk)</option>
            </select> <br> <br>
            <label for="amount">Loyalty Amount:</label>
            <input type="number" id="amount" class="font-itim" name="amount"
                style="border-radius: 10px; width: auto;" placeholder="Amount"> <br> <br>
            <input type="submit" name="submit" value="Add">
        </fieldset>
    </form> 

    <a href="Customer_LoyaltyProgram_F.php">
        <button>Customer View</button>
    </a>
    <a href="Admin_LoyaltyProgram_F.php">
        <button>Admin View</button>
    </a>

    <script src="../asset/loyaltyProgram_F.js"></script>
</body>

</html>