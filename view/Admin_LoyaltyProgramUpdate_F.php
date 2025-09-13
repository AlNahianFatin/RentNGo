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

if(!isset($_SESSION['scheme'])) {
    $_SESSION['error'] = "invalidScheme";
    header("Location: Admin_LoyaltyProgram_F.php");
    exit;
}

require_once('../model/loyaltyModel.php');
$records = getLoyaltyBySName($_SESSION['scheme']);

$message = "";
$messageColor = "red"; 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $scheme = isset($_SESSION["scheme"]) ? $_SESSION["scheme"] : "";
    $points = (isset($_POST["points"]) && $_POST["points"] !== "") ? floatval($_POST["points"]) : 0;
    $type = isset($_POST["type"]) ? $_POST["type"] : "";
    $amount = isset($_POST["amount"]) ? floatval($_POST["amount"]) : "";

    if (empty($scheme)) {
        $_SESSION['message'] = "Scheme name could not be found. Please try refreshing the page.";
        $_SESSION['messageColor'] = "red";
        header("Location: Admin_LoyaltyProgram_F.php");
        exit;
    }
    
    else if ($points !== null && (!is_numeric($points) || $points < 0))  
        $message = "Please enter a valid reward point first.";
    
    else if (empty($type)) 
        $message = "Please select a amenities type first.";
    
    else if ($amount === "" || !is_numeric($amount) || $amount <= 0) 
        $message = "Please enter a valid reward amount first.";
    
    else if ($type === "Rent Discount (%)" && $amount > 100) 
        $message = "Loyalty amount cannot be more than 100%.";
    else {
        $loyalty = [
            'scheme'      => $scheme,
            'points'      => $points,
            'amentities'  => $type,
            'amount'      => $amount,
            'activation'  => 1  
        ];

        if(updateScheme($loyalty)) {
            $_SESSION['message'] = "Loyalty scheme updated successfully.";
            $_SESSION['messageColor'] = "green";
            header("Location: Admin_LoyaltyProgramUpdate_F.php");
            exit;
        }
        else {
            $_SESSION['message'] = "Oops! Something went wrong.";
            $_SESSION['messageColor'] = "red";
            header("Location: Admin_LoyaltyProgramUpdate_F.php");
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
    <title>Admin_LoyaltyProgramUpdate</title>

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

    <form action="Admin_LoyaltyProgramUpdate_F.php" method="post" style="margin-top: 5vh;" onsubmit="return validateUpdateScheme()">
        <fieldset>
            <legend>Update Loyalty Program</legend>
            <pre style="font-family: itim; font-size: 30px;" for="scheme">Reward Scheme:        <?= $_SESSION['scheme'] ?></pre> <br>
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
            <input type="submit" name="submit" value="Update">
        </fieldset>
    </form> 

    <a href="Customer_LoyaltyProgram_F.php">
        <button>Customer View</button>
    </a>
    <a href="Admin_LoyaltyProgram_F.php">
        <button>Admin View</button>
    </a>

    <script src="../asset/loyaltyProgram_F.js"></script>
    <script>
        const xhr = new XMLHttpRequest();
        xhr.open("GET", `../controller/LoyaltyProgramUpdatePopulate_F.php?scheme=${encodeURIComponent("<?= $_SESSION['scheme'] ?>")}`, true);
        
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    try {
                        let data = JSON.parse(xhr.responseText);
                        
                        if (!Array.isArray(data) && data.length === 0) {
                            document.getElementById("points").value = "";
                            document.getElementById("type").value = "";
                            document.getElementById("amount").value = "";
                            return;
                        }
                        document.getElementById("points").value = data[0].points;
                        document.getElementById("type").value = data[0].amentities;
                        document.getElementById("amount").value = data[0].amount;
                    } 
                    catch (err) {
                        console.error("Error parsing JSON:", err);
                    }
                }
                else
                    console.error("Error getting scheme details:", xhr.status, xhr.statusText);
            }
        };
        xhr.send();
    </script>
</body>

</html>