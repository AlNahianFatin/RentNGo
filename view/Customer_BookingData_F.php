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
        $_SESSION['username'] = "Al Nahian Fatin";
// $_SESSION['username'] = $_REQUEST['username'];
require_once('../model/rentModel.php');
$records = getRentRecordByCName($_SESSION['username']);
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

        .row {
            font-family: Itim;
            font-size: 30px;
            margin-top: 5vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            width: 100vw;
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

    <table id="records" style="width: auto; max-width: 100vw; margin: 5vh 0">
        <thead style = "font-weight: bold;">
            <tr>
                <td>Booking Date</td>
                <td>Pickup Location</td>
                <td>Dropoff Location</td>
                <td>Hours Rented</td>
                <td>Car Rent</td>
                <td>Fuel Cost</td>
                <td>Total Rent</td>
                <td>Applied Loyalty</td>
                <td>Final Rent</td>
                <td>Payment Status</td>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($records)) { 
                foreach ($records as $record) { ?>
                    <tr>
                        <td><?= htmlspecialchars($record['bdate']) ?></td>
                        <td><?= htmlspecialchars($record['plocation']) ?></td>
                        <td><?= htmlspecialchars($record['dlocation']) ?></td>
                        <td><?= htmlspecialchars($record['renthours']) ?></td>
                        <td><?= htmlspecialchars($record['crent']) ?></td>
                        <td><?= htmlspecialchars($record['fcost']) ?></td>
                        <td><?= htmlspecialchars($record['trent']) ?></td>
                        <td><?= htmlspecialchars($record['loyalty']) != "" ? htmlspecialchars($record['loyalty']) : "---" ?></td>
                        <td><?= htmlspecialchars($record['frent']) ?></td>
                        <td><?= htmlspecialchars($record['pstatus']) ? "Paid" : "Pending" ?></td>
                    </tr>
            <?php } 
            } 
            else { ?>
                <tr><td colspan="11">No records found</td></tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="Admin_BookingData_F.php">
        <button type="button">Admin View</button>
    </a>
</body>
</html>