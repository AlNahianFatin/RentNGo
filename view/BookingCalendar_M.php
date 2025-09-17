<?php
session_start();
require_once "../model/db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pickupDate  = $_POST["pickupDate"];
    $pickupTime  = $_POST["pickupTime"];
    $returnDate  = $_POST["returnDate"];
    $returnTime  = $_POST["returnTime"];
    $vehicleType = $_POST["vehicleType"];
    $role        = $_POST["role"] ?? "user";

    $error = "";
    $allowedVehicles = ["Premio", "Prado", "Hiace", "BMW", "Allion"];

    if (empty($pickupDate) || empty($pickupTime) || empty($returnDate) || empty($returnTime) || empty($vehicleType)) {
        $error = "All fields are required.";
    } elseif (!in_array($vehicleType, $allowedVehicles)) {
        $error = "Invalid vehicle type.";
    } else {
        $pickup = strtotime("$pickupDate $pickupTime");
        $return = strtotime("$returnDate $returnTime");
        if ($pickup < time()) {
            $error = "Pickup time cannot be in the past.";
        } elseif ($return <= $pickup) {
            $error = "Return must be after pickup.";
        }
    }

    if ($error) {
        echo "<h2 style='color:red;'>$error</h2><a href='BookingCalendar_M.html'>⬅ Go back</a>";
    } else {
        $sql = "INSERT INTO bookings (vehicle_type, pickup_date, pickup_time, return_date, return_time, role) 
                VALUES ('$vehicleType', '$pickupDate', '$pickupTime', '$returnDate', '$returnTime', '$role')";

        if (!mysqli_query($conn, $sql)) {
            die("Insert failed: " . mysqli_error($conn));
        }

        // ✅ save booking info in session
        $_SESSION["booking_id"] = mysqli_insert_id($conn);
        $_SESSION["vehicleType"] = $vehicleType;
        $_SESSION["pickupDate"]  = $pickupDate;
        $_SESSION["pickupTime"]  = $pickupTime;
        $_SESSION["returnDate"]  = $returnDate;
        $_SESSION["returnTime"]  = $returnTime;

        // ✅ save last vehicle in a cookie (valid for 30 days)
        setcookie("lastVehicle", $vehicleType, time() + (30 * 24 * 60 * 60), "/");

        header("Location: PricingCalculator_M.html");
        exit;
    }
}
?>
