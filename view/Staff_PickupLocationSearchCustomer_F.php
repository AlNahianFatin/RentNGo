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
    <title>Staff_PickupLocationSearchCustomer</title>

    <link rel="stylesheet" href="../asset/style_F.css">
    <style>
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

    <?php if (!empty($message)): ?>
            <div id="msg" style="
                position: fixed;
                top: 20px;
                left: 50%;
                transform: translateX(-50%);
                color: white;
                opacity: 0.9;
                padding: 10px 20px;
                border: 1px solid black;
                border-radius: 6px;
                font-family: Inika;
                z-index: 9999;
                box-shadow: 0 5px 10px rgba(0,0,0,0.6);
                background-color: <?= $messageColor ?>;
            ">
                <?= htmlspecialchars($message) ?>
            </div>
            <script>
                setTimeout(() => {
                    const msg = document.getElementById('msg');
                    if (msg) msg.remove();
                }, 2000);
            </script>
        <?php endif;?>

        <div class="row">
            <label for="Customer">Enter Customer Name:</label>
            <input type="text" id="Customer" class="font-itim" name="Customer" style="border-radius: 10px;"
                placeholder="Customer Name"> <br> <br>
            <button type="button" name="search" onclick="searchCustomer()">Search</button>
        </div>

    <script src="../asset/pickupLocations_F.js"></script>
</body>

</html>