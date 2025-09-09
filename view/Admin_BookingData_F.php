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
    <title>Admin_BookingData</title>

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
            <tr>
                <th>Customer ID</th>
                <th>Customer Name</th>
                <th>Booking Date</th>
                <th>Pickup Location</th>
                <th>Dropoff Location</th>
                <th>Hours Rented</th>
                <th>Car Rent</th>
                <th>Fuel Cost</th>
                <th>Total Rent</th>
            </tr>
        </thead>

        <tbody></tbody>
    </table>

    <a href="Customer_BookingData_F.php">
        <button type="button">Customer View</button>
    </a>

    <div style="display: flex; justify-content: center; align-items: center;" >
        <button onclick="">Download Record</button>
    </div>
</body>

</html>