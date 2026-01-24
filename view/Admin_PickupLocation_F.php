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
if(isset($_SESSION['error']) === "invalidbid") {
    $_SESSION['message'] = "Branch location could not be found. Please try refreshing the page.";
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

require_once('../model/branchModel.php');
$records = getAllBranches();

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

if(isset($_SESSION['bid']))
    unset($_SESSION['bid']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin_PickupLocation</title>

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

    <div class="row">
        <label for="Branch">Search Branch:</label>
        <input type="text" id="Branch" class="font-itim" name="Branch" style="border-radius: 10px;"
            placeholder="Branch Location"> <br> <br>
    </div><br>

    <table id="records" style="border-collapse: collapse;">
        <thead style="font-weight: bold;">
            <tr>
                <td>Branch ID</td>
                <td>District</td>
                <td>Location</td>
                <td>Availibility</td>
                <td>Activate/Deactivate</td>
                <td>Update</td>
                <td>Delete</td>
            </tr>
        </thead>
    
        <tbody>
            <?php if (!empty($records)) { 
                foreach ($records as $record) { ?>
                    <tr>
                        <td><?= htmlspecialchars($record['bid']) ?></td>
                        <td><?= htmlspecialchars($record['district']) ?></td>
                        <td><?= htmlspecialchars($record['location']) ?></td>
                        <td id="availibilityStts<?= htmlspecialchars($record['bid']) ?>"><?= ((int)$record['available'] === 1) ? "Available" : "Unavailable" ?></td>
                        <td> <button id="availableBttn<?= htmlspecialchars($record['bid']) ?>" onclick="availability('<?= htmlspecialchars($record['bid']) ?>', <?= (int)htmlspecialchars($record['available']) ?>)"> <?= $record['available'] ? 'Deactivate' : 'Activate' ?> </button> </td>
                        <td><a href="../controller/setBranch_F.php?bid=<?= urlencode($record['bid']) ?>">
                                <button type="button">Update</button>
                            </a>
                        </td>
                        <td> <button id="dltBttn<?= htmlspecialchars($record['bid']) ?>" style="background-color: red;" onclick="dlt('<?= htmlspecialchars($record['bid']) ?>')">Delete</button> </td>
                    </tr>
            <?php } 
            } 
            else { ?>
                <tr><td colspan="7">No records found</td></tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="Admin_PickupLocationAdd_F.php" style="display: flex; justify-content: center; align-items: center; text-decoration: none;">
        <button>Add Branch</button>
    </a>

    <a href="Customer_PickupLocation_F.php">
        <button>Customer View</button>
    </a>

    <script src="../asset/pickupLocations_F.js"></script>
</body>

</html>