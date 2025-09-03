<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $scheme = $_POST["scheme"] ?? "";

    // if(!isset($_COOKIE['status'])) 
    //    header('location: index.php?error=sessionExpired');

    if (empty($scheme)) {
        echo "<p style='color:red;'>Please enter a reward scheme first.</p>";
        header('location: Customer_LoyaltyProgram_F.php?error=invalidRewardScheme');
    }
    else {
        // echo "Scheme validated successfully.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer_LoyaltyProgram</title>

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

    <form action="Customer_LoyaltyProgram_F.php" method="post" onsubmit="return validateScheme(event)">
        <label for="scheme">Enter Reward Scheme: </label>
        <input type="text" id="scheme" class="font-itim" name="scheme" style="border-radius: 10px; margin: 0px 15px;" placeholder="Enter Reward Scheme">
        <input type="submit" name="submit" value="Apply">
    </form> <br> <br>

    <a href="Admin_LoyaltyProgram_F.html">
        <button type="button">Admin View</button>
    </a>

    <script src="../asset/loyaltyProgram_F.js"></script>
</body>

</html>