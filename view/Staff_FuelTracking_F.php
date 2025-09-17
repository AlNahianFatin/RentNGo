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
    $pickupFuel = isset($_POST["pickupFuel"]) ? floatval($_POST["pickupFuel"]) : "";
    $dropoffFuel = isset($_POST["dropoffFuel"]) ? floatval($_POST["dropoffFuel"]) : "";
    $fuelRate = isset($_POST["fuelRate"]) ? floatval($_POST["fuelRate"]) : "";
    $refilled = isset($_POST["refilled"]) ? floatval($_POST["refilled"]) : 0;

    if ($pickupFuel === "" || !is_numeric($pickupFuel) || $pickupFuel < 0) 
        $message = "Enter a valid number for pickup fuel.";

    else if ($dropoffFuel === "" || !is_numeric($dropoffFuel) || $dropoffFuel < 0) 
        $message = "Enter a valid number for dropoff fuel.";

    else if ($pickupFuel != $dropoffFuel && ($fuelRate === "" || !is_numeric($fuelRate) || $fuelRate < 0)) 
        $message = "Enter a valid fuel rate.";
    
    else if ($pickupFuel < $dropoffFuel && (!is_numeric($refilled) || $refilled <= 0)) 
        $message = "Enter a valid refill amount.";    
}
?>

<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Staff_FuelTracking</title>

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

        <form action="" method="post" onsubmit="return validateFuel()">
            <fieldset>
                <legend>Fuel Checkout</legend>
                <label for="pickupFuel">Fuel at Pickup:</label>
                <input type="number" id="pickupFuel" class="font-itim" name="pickupFuel" style="border-radius: 10px;"> litres <br> <br>
                <label for="dropoffFuel">Fuel at Dropoff:</label>
                <input type="number" id="dropoffFuel" class="font-itim" name="dropoffFuel" style="border-radius: 10px;"> litres <br> <br>
                <label for="fuelRate">Current Fuel Rate:</label>
                <input type="number" id="fuelRate" class="font-itim" name="fuelRate" style="border-radius: 10px;"> tk/litre <br> <br>
                <label id="refuelCost">Fuel Cost: 0 tk </label> <br> <br>
                <button type="button" style="background-color: red;" onclick="refuel()">Refueled</button>
                <input type="submit" name="submit" value="Submit">
            </fieldset>
        </form> <br> <br>
        <a href="Admin_FuelTracking_F.php">
            <button type="button">Admin View</button>
        </a>

        <script src="../asset/staff_FuelTracking_F.js"></script>
    </body>

</html>