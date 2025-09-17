<?php
session_start();
require_once "../model/db_connect.php";

header("Content-Type: application/json");

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
        echo json_encode(["success"=>false, "message"=>$error]);
        exit;
    }

    $sql = "INSERT INTO bookings (vehicle_type, pickup_date, pickup_time, return_date, return_time, role) 
            VALUES ('$vehicleType', '$pickupDate', '$pickupTime', '$returnDate', '$returnTime', '$role')";

    if (!mysqli_query($conn, $sql)) {
        echo json_encode(["success"=>false, "message"=>"Database insert failed"]);
        exit;
    }

    $_SESSION["booking_id"] = mysqli_insert_id($conn);
    $_SESSION["vehicleType"] = $vehicleType;
    $_SESSION["pickupDate"]  = $pickupDate;
    $_SESSION["pickupTime"]  = $pickupTime;
    $_SESSION["returnDate"]  = $returnDate;
    $_SESSION["returnTime"]  = $returnTime;

    setcookie("lastVehicle", $vehicleType, time() + (30 * 24 * 60 * 60), "/");

    echo json_encode([
        "success" => true,
        "message" => "Booking confirmed!",
        "next" => "PricingCalculator_M.html"
    ]);
}
?>
