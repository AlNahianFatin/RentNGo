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
    <title>Customer_BookingData</title>

    <link rel="stylesheet" href="../asset/style_F.css">

    <style>
        td {
            min-width: 23vh;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="../asset/RentNGo logo.png" class="logo" alt="RentNGo Logo">
        <div>
            <h1>RentNGo</h1>
            <h2>Smart Rentals<br>Smooth Rides</h2>
        </div>
    </div>

    <table id="records" style="width: auto; max-width: 100vw; margin: 10vh 0">
        <thead>
            <td>Booking Date</td>
            <td>Pickup Location</td>
            <td>Dropoff Location</td>
            <td>Hours Rented</td>
            <td>Car Rent</td>
            <td>Fuel Cost</td>
            <td>Total Rent</td>
        </thead>
        <tbody></tbody>
    </table>

    <a href="Admin_BookingData_F.php">
        <button type="button">Admin View</button>
    </a>
</body>
</html>