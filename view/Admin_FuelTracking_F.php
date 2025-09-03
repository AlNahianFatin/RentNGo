<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // if(!isset($_COOKIE['status'])) 
    //    header('location: index.php?error=sessionExpired');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin_FuelTracking</title>

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

    <table id="records">
        <thead>
            <td class="left">Customer ID</td>
            <td>Customer Name</td>
            <td>Pickup Location</td>
            <td>Dropoff Location</td>
            <td>Fuel Cost</td>
        </thead>
        <tbody></tbody>
    </table>

    <a href="Staff_FuelTracking_F.html">
        <button type="button">Staff View</button>
    </a>

    <script src="../asset/fuelTracking_F.js"></script>
</body>
</html>