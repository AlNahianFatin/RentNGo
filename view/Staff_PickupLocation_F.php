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

$message = "";
$messageColor = "red"; 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $pickupLocation = isset($_POST["pickup_location"]) ? $_POST["pickup_location"] : "";
    $dropoffLocation = isset($_POST["dropoff_location"]) ? $_POST["dropoff_location"] : "";

    if (empty($pickupLocation)) 
        $message = "Please select a pickup location first.";
    else if (empty($dropoffLocation)) 
        $message = "Please select a dropoff location first."; 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff_PickupLocation</title>

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

    <div style="margin-top: 180px; display: flex; align-items: center; justify-content: center; text-align: center; gap: 20px;">
        <label for="search" class="font-itim">Search by airport/city:</label>
        <input type="text" name="search" class="font-itim" style="border-radius: 10px;" placeholder="🔍Search">
    </div>

    <form action="" method="post" onsubmit="return validatePickupDropoff()" style=" flex-direction: column;">
        <div class="row">
            <label for="pickup_location">Pickup Location:</label>
            <select id="pickup" name="pickup_location">
                <option value="">Choose a pickup point</option>
                <option value="khilKhet">Khilkhet</option>
                <option value="Jamuna Future Park">Jamuna Future Park</option>
            </select>
        </div>

        <div class="row">
            <label for="dropoff_location">Dropoff Location:</label>
            <select id="dropoff" name="dropoff_location">
                <option value="">Choose a dropoff point</option>
                <option value="khilKhet">Khilkhet</option>
                <option value="Jamuna Future Park">Jamuna Future Park</option>
            </select>
        </div>
        <input type="submit" style="padding: 3px 5px;" name="submit" value="Confirm">
    </form>


    <a href="Admin_PickupLocation_F.php">
        <button type="button">Admin View</button>
    </a>

    <script src="../asset/pickupLocations_F.js"></script>
</body>

</html>