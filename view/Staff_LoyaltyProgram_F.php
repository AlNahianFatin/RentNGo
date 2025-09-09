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

    <div style="display: flex; flex-direction: row; align-items: center; justify-content: center; margin-top: 10vh;">
        <img src="../asset/points.png" class="loyaltyPoints" alt="Points icon" style="width: 40px;">
        <label class="font-itim">Loyalty Program Management</label>
    </div><br>

    <table style="border: none; border-collapse: collapse;">
        <thead>
            <td style="border: none; font-size: 30px;" colspan="6">Reward Catalog</td>
        </thead>
        <thead style="border: none;">
            <td class="left" style="border: none;">Reward Scheme</td>
            <td style="border: none;">Points Required</td>
            <td style="border: none;">Amenities</td>
            <td style="border: none;">Amount</td>
        </thead>
        <tbody></tbody>
    </table><br><br><br>

    <a href="Customer_LoyaltyProgram_F.php">
        <button type="button">Customer View</button>
    </a>

    <script src="../asset/loyaltyProgram_F.js"></script>
</body>

</html>