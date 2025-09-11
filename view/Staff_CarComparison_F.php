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

require_once('../model/carModel.php');
$records = getAllCars();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff_CarComparison</title>

    <link rel="stylesheet" href="../asset/style_F.css">
    <style>        
        td {
            min-width: 13vw;
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

    <div class="row">
        <label for="Car">Search Car:</label>
        <input type="text" id="Car" class="font-itim" name="Car" style="border-radius: 10px;"
            placeholder="Car Brand or Model"> <br> <br>
    </div>

    <!-- <button style="margin-left: 90vw; margin-top: 2vh;" onclick="return addCar()">Add a Car</button> -->

    <table id="records" style="width: auto; max-width: 100vw; margin: 5vh 0">
        <thead style = "font-weight: bold;">
            <tr>
                <td>Car ID</td>
                <td>Car Brand</td>
                <td>Car Model</td>
                <td>Rent (tk/hr)</td>
                <td>No. of Seats</td>
                <td>Mileage (km)</td>
                <td>Available Quantity</td>
                <td></td>
            </tr>
        </thead>
    
        <tbody>
            <?php if (!empty($records)) { 
                foreach ($records as $record) { ?>
                    <tr>
                        <td><?= htmlspecialchars($record['cid']) ?></td>
                        <td><?= htmlspecialchars($record['brand']) ?></td>
                        <td><?= htmlspecialchars($record['model']) ?></td>
                        <td><?= htmlspecialchars($record['rent']) ?></td>
                        <td><?= htmlspecialchars($record['seatno']) ?></td>
                        <td><?= htmlspecialchars($record['mileage']) ?></td>
                        <td><?= ($record['available']) <= 0 ? "Not available" : htmlspecialchars($record['available']) ?></td>
                        <td> <button class="compareBttn" onclick="addCar(<?= (int)($record['cid']) ?>, false)">Compare</button> </td>
                    </tr>
            <?php } 
            } 
            else { ?>
                <tr><td colspan="8">No records found</td></tr>
            <?php } ?>
        </tbody>
    </table>

    <script src="../asset/carComparison_F.js"></script>
</body>
</html>