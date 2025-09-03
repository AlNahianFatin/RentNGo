<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $customer = $_POST["Customer"] ?? "";

    // if(!isset($_COOKIE['status'])) 
    //    header('location: index.php?error=sessionExpired');

    if ($customer === "" || !is_numeric($customer)) {
        $errors[] = "Enter a valid number for customer ID.";
        header('location: Staff_PickupLocation_F.php?error=invalidCustomerID');
    }
    else {
        
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff_PickupLocation</title>

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

    <form action="Staff_PickupLocation.php" method="post" onsubmit="return searchCustomer(event)" style=" flex-direction: column;">
        <div class="row">
            <label for="Customer">Enter Customer ID:</label>
            <input type="text" id="Customer" class="font-itim" name="Customer" style="border-radius: 10px;"
                placeholder="Customer ID"> <br> <br>
            <input type="submit" name="submit" value="Search">
        </div>
    </form>

    <script src="../asset/pickupLocations_F.js"></script>
</body>

</html>