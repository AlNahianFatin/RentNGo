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

if(!isset($_SESSION['bid'])) {
    $_SESSION['error'] = "invalidbid";
    header("Location: Admin_PickupLocation_F.php");
    exit;
}

require_once('../model/branchModel.php');
$record = getBranchByID($_SESSION['bid']);

$message = "";
$messageColor = "red"; 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $bid = isset($record["bid"]) ? $record["bid"] : "";
    $district = (isset($_POST["district"]) && $_POST["district"] !== "") ? trim($_POST["district"]) : $record["district"];
    $location = (isset($_POST["location"]) && $_POST["location"] !== "") ? trim($_POST["location"]) : $record["location"];

    if (empty($bid)) {
        $_SESSION['message'] = "Branch location could not be found. Please try refreshing the page.";
        $_SESSION['messageColor'] = "red";
        header("Location: Admin_PickupLocation_F.php");
        exit;
    }    
    else if ($district === $record["district"] && $location === $record["location"])
        $message = "No record has been changed to update";
    else if (empty($district)) 
        $message = "Please enter a district first.";
    else if (empty($location)) 
        $message = "Please enter a location first.";
    else {
        $branch = [
            'bid' => $bid,
            'district' => $district,
            'location' => $location,
            'available' => 1  
        ];

        if(updateBranch($branch)) {
            $_SESSION['message'] = "Branch Location updated successfully.";
            $_SESSION['messageColor'] = "green";
            header("Location: Admin_PickupLocationUpdate_F.php");
            exit;
        }
        else {
            $_SESSION['message'] = "Oops! Something went wrong.";
            $_SESSION['messageColor'] = "red";
            header("Location: Admin_PickupLocationUpdate_F.php");
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
    <title>Admin_PickupLocationUpdate_F</title>

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

    <form action="Admin_PickupLocationUpdate_F.php" method="post" style="margin-top: 5vh;" onsubmit="return validateUpdateLocation(<?= $record['bid'] ?>)">
        <fieldset>
            <legend>Update Branch Location</legend>
            <label style="font-family: itim; font-size: 30px;" for="district">Location: <?= $record['location'] ?>, <?= $record['district'] ?></label> <br>
            <label for="district">District:</label>
            <input type="text" id="district" class="font-itim" name="district" style="border-radius: 10px; 
                width: auto; margin-top: 5vh;" placeholder="<?= $record['district'] ?>"> <br> <br>
            <label for="location">Location:</label>
            <input type="text" id="location" class="font-itim" name="location"
                style="border-radius: 10px; width: auto;" placeholder="<?= $record['location'] ?>"> <br> <br>
            <input type="submit" name="submit" value="Update">
        </fieldset>
    </form> 

    <a href="Customer_PickupLocation_F.php">
        <button>Customer View</button>
    </a>
    <a href="Admin_PickupLocation_F.php">
        <button>Admin View</button>
    </a>

    <script src="../asset/pickupLocation_F.js"></script>
</body>

</html>