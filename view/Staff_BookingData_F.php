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
    <title>Staff_BookingData</title>

    <link rel="stylesheet" href="../asset/style_F.css">

    <style>
        td {
            min-width: 23vh;
        }

        .row {
            font-family: Itim;
            font-size: 30px;
            margin-top: 17vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            width: auto;
            gap: 2vw;
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

    <div class="row">
        <label for="Customer">Enter Customer Name:</label>
        <input type="text" id="Customer" class="font-itim" name="Customer" style="border-radius: 10px;"
            placeholder="Customer Name"> <br> <br>
        <button type="button" name="search" onclick="searchCustomer()">Search</button>
    </div>

    <table id="records" style="width: auto; max-width: 100vw; margin: 10vh 0">
        <thead>
            <td>Customer ID</td>
            <td>Customer Name</td>
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

    <a href="Customer_BookingData_F.php">
        <button type="button">Customer View</button>
    </a>
    <a href="Admin_BookingData_F.php">
        <button type="button">Admin View</button>
    </a>

    <script src="../asset/bookingData_F.js"></script>
</body>

</html>