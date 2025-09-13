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
if(isset($_SESSION['error']) === "invalidScheme") {
    $_SESSION['message'] = "Scheme name could not be found. Please try refreshing the page.";
    $_SESSION['messageColor'] = "red";
    unset($_SESSION['error']);
    exit;
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

if (isset($_SESSION['message'])): ?>
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
        background-color: <?= $_SESSION['messageColor'] ?>;
    ">
        <?= htmlspecialchars($_SESSION['message']) ?>
    </div>
    <script>
        setTimeout(() => {
            const msg = document.getElementById('msg');
            if (msg) msg.remove();
        }, 2000);
    </script>
    <?php unset($_SESSION['message'], $_SESSION['messageColor']); ?>
<?php endif;

if(isset($_SESSION['scheme']))
    unset($_SESSION['scheme']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin_LoyaltyProgram</title>

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

    <div style="display: flex; flex-direction: row; align-items: center; justify-content: center; margin-top: 10vh;">
        <img src="../asset/points.png" class="loyaltyPoints" alt="Points icon" style="width: 40px;">
        <label class="font-itim" style="font-weight: bold; font-size: 35px;">Loyalty Program Management</label>
    </div><br>

    <table id="records" style="width: auto; max-width: 100vw; margin: 5vh 0">
        <thead style = "font-weight: bold;">
            <!-- <td style="border: 1; font-size: 25px;" colspan="8">Reward Catalog</td> -->
        <!-- </thead> -->
        <tr>
            <td class="left" style="border: 1; font-weight: bold;">Reward Scheme</td>
            <td style="border: 1; font-weight: bold;">Points Required</td>
            <td style="border: 1; font-weight: bold;">Amenities</td>
            <td style="border: 1; font-weight: bold;">Amount</td>
            <td style="border: 1; font-weight: bold;">Activation Status</td>
            <td style="border: 1; font-weight: bold;">Activate/Deactivate</td>
            <td style="border: 1; font-weight: bold;">Update</td>
            <td style="border: 1; font-weight: bold;">Delete</td>
        </tr>
        </thead>

        <tbody>
            <?php if (!empty($records)) { 
                foreach ($records as $record) { ?>
                    <tr>
                        <td><?= htmlspecialchars($record['scheme']) ?></td>
                        <td><?= htmlspecialchars(!$record['points']) ? 0 : $record['points'] ?></td>
                        <td><?= htmlspecialchars($record['amentities']) ?></td>
                        <td><?= htmlspecialchars($record['amount']) ?></td>
                        <td id="activationStts<?= htmlspecialchars($record['scheme']) ?>"><?= htmlspecialchars($record['activation']) ? "Active" : "Deactive" ?></td>
                        <td> <button id="activationBttn<?= htmlspecialchars($record['scheme']) ?>" onclick="activation('<?= htmlspecialchars($record['scheme']) ?>', <?= (int)htmlspecialchars($record['activation']) ?>)"> <?= $record['activation'] ? 'Deactivate' : 'Activate' ?> </button> </td>
                        <td><a href="../controller/setLoyalty_F.php?scheme=<?= urlencode($record['scheme']) ?>">
                                <button type="button">Update</button>
                            </a>
                        </td>
                        <td> <button id="dltBttn<?= htmlspecialchars($record['scheme']) ?>" style="background-color: red;" onclick="dlt('<?= htmlspecialchars($record['scheme']) ?>')">Delete</button> </td>
                    </tr>
            <?php } 
            } 
            else { ?>
                <tr><td colspan="11">No records found</td></tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="Admin_LoyaltyProgramAdd_F.php" style="display: flex; justify-content: center; align-items: center; text-decoration: none;">
        <button>Add Schemes</button>
    </a>

    <a href="Customer_LoyaltyProgram_F.php">
        <button>Customer View</button>
    </a>

    <script src="../asset/loyaltyProgram_F.js"></script>
</body>

</html>