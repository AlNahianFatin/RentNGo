<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $location = $_POST["location"] ?? "";

    // if(!isset($_COOKIE['status'])) 
    //    header('location: index.php?error=sessionExpired');
    
    if (empty($location)) {
        echo "<p style='color:red;'>Please enter a pickup location first.</p>";
        header('location: Admin_PickupLocation_F.php?error=invalidPickupLocatoion');
    } 
    else {
        echo "Branch location added successfully.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin_PickupLocation</title>

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
    
    <form action="Admin_PickupLocation_F.php" method="post" onsubmit="return validateLocation(event)">
        <fieldset>
            <legend>Add Pickup Locations</legend>
            <label for="location">Pickup Location:</label>
            <input type="text" id="location" class="font-itim" name="location" style="border-radius: 10px;" placeholder="Enter a Branch Location"> <br> <br>
            <input type="submit" name="submit" value="Add">
        </fieldset>
    </form> <br> <br>

    <table id="records">
        <thead>
            <td class="left">Branch ID</td>
            <td>Branch Locations</td>
        </thead>
        <tbody></tbody>
    </table>

    <a href="Customer_PickupLocation_F.html">
        <button type="button">Customer View</button>
    </a>

    <script src="../asset/pickupLocations_F.js"></script>
</body>

</html>