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
    $scheme = isset($_POST["scheme"]) ? floatval($_POST["scheme"]) : "";
    
    if (empty($scheme)) 
        $message = "Please enter a reward scheme first.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff_LoyaltyProgram</title>

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
        <label class="font-itim">Loyalty Points: 0</label>
    </div><br>

    <table style="border: none; border-collapse: collapse;">
        <thead>
            <td style="border: none; font-size: 30px;" colspan="4">Available Reward Catalog</td>
        </thead>
        <thead style="border: none;">
            <td class="left" style="border: none;">Reward Scheme</td>
            <td style="border: none;">Points Required</td>
            <td style="border: none;">Amenities</td>
            <td style="border: none;">Copy to Clipboard</td>
        </thead>
        <tbody></tbody>
    </table>

    <form action="Customer_LoyaltyProgram_F.php" method="post" onsubmit="return validateScheme()">
        <label for="scheme">Enter Reward Scheme: </label>
        <input type="text" id="scheme" class="font-itim" name="scheme" style="border-radius: 10px; margin: 0px 15px;" placeholder="Enter Reward Scheme">
        <input type="submit" name="submit" value="Apply">
    </form> <br> <br>

    <a href="Admin_LoyaltyProgram_F.php">
        <button type="button">Admin View</button>
    </a>

    <script src="../asset/loyaltyProgram_F.js"></script>
</body>

</html>