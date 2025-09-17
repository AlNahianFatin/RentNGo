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

require_once('../model/rentModel.php');
$records = getAllRentRecords();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin_FuelTracking</title>

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
        <label for="Customer">Search Customer:</label>
        <input type="text" id="Customer" class="font-itim" name="Customer" style="border-radius: 10px;"
            placeholder="Customer Name"> <br> <br>
    </div>

    <table id="records" style="width: auto; max-width: 100vw; margin: 5vh 20vw">
        <thead style = "font-weight: bold;">
            <tr>
                <td>Customer Name</td>
                <td>Pickup Location</td>
                <td>Dropoff Location</td>
                <td>Hours Rented</td>
                <td>Fuel Cost</td>
                </tr>
        </thead>
        <tbody>
            <?php if (!empty($records)) { 
                foreach ($records as $record) { ?>
                    <tr>
                        <td><?= htmlspecialchars($record['cname']) ?></td>
                        <td><?= htmlspecialchars($record['plocation']) ?></td>
                        <td><?= htmlspecialchars($record['dlocation']) ?></td>
                        <td><?= htmlspecialchars($record['renthours']) ?></td>
                        <td><?= htmlspecialchars($record['fcost']) ?></td>
                    </tr>
            <?php } 
            } 
            else { ?>
                <tr><td colspan="5">No records found</td></tr>
            <?php } ?>
            </tbody>
    </table>

    <a href="Staff_FuelTracking_F.php">
        <button>Staff View</button>
    </a>

    <script src="../asset/admin_FuelTracking_F.js"></script>
</body>
</html>