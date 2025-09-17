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

require_once('../model/loyaltyModel.php');
$records = getAllLoyalties();

$message = "";
$messageColor = "red"; 

        $_SESSION['username'] = "Al Nahian Fatin";
// $_SESSION['username'] = $_REQUEST['username'];
require_once('../model/rentModel.php');
$records = getAvailableLoyalties();
        $points = getCustomerLoyaltyPoints($_SESSION['username']);
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
        <label class="font-itim">Available Loyalty Points: <?= htmlspecialchars($points['lpoints']) ?></label>
    </div><br>

    <table style="border: 1; border-collapse: collapse;">
        <thead style = "font-weight: bold;">
            <tr>
                <td >Reward Scheme</td>
                <td>Points Required</td>
                <td>Amenities</td>
                <td>Amount</td>
                <td>Apply</td>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($records)) { 
                foreach ($records as $record) { ?>
                    <tr>
                        <td><?= htmlspecialchars($record['scheme']) ?></td>
                        <td><?= htmlspecialchars($record['points'] ? $record['points'] : 0) ?></td>
                        <td><?= htmlspecialchars($record['amentities']) ?></td>
                        <td><?= htmlspecialchars($record['amount']) ?></td>
                        <td><input type="submit"  name="submit" value="Apply" onclick="return applyScheme('<?= htmlspecialchars($record['scheme']) ?>')"></td>
                    </tr>
            <?php } 
            } 
            else { ?>
                <tr><td colspan="11">No records found</td></tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="Admin_LoyaltyProgram_F.php">
        <button type="button">Admin View</button>
    </a>

    <script src="../asset/loyaltyProgram_F.js"></script>
</body>

</html>