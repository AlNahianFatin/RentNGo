<?php
session_start();
require_once "../model/db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $startDate   = $_POST["startDate"];
    $endDate     = $_POST["endDate"];
    $vehicleType = $_POST["vehicleType"];
    $promoCode   = trim($_POST["promoCode"]);
    $role        = $_POST["role"] ?? "user";

    $error = "";
    $allowedVehicles = ["Premio","Prado","Hiace","BMW","Allion"];

    if (empty($startDate) || empty($endDate) || empty($vehicleType)) {
        $error = "All required fields must be filled.";
    } elseif (!in_array($vehicleType, $allowedVehicles)) {
        $error = "Invalid vehicle type.";
    } else {
        $start = strtotime($startDate);
        $end   = strtotime($endDate);
        if ($end <= $start) {
            $error = "End date must be after start date.";
        }
    }

    if ($error) {
        echo "<h2 style='color:red;'>$error</h2><a href='PricingCalculator_M.html'>⬅ Go back</a>";
    } else {
        $dailyRates = ["Premio"=>50,"Prado"=>80,"Hiace"=>70,"BMW"=>120,"Allion"=>45];
        $days = ($end - $start) / (60*60*24);
        $rate = $dailyRates[$vehicleType];
        $price = $days * $rate;
        if (strtoupper($promoCode) === "DISCOUNT10") {
            $price *= 0.9;
        }

        $sql = "INSERT INTO pricing (booking_id, start_date, end_date, promo_code, total) 
                VALUES ('{$_SESSION["booking_id"]}', '$startDate', '$endDate', '$promoCode', '$price')";

        if (!mysqli_query($conn, $sql)) {
            die("Insert failed: " . mysqli_error($conn));
        }

        $_SESSION["pricing_id"] = mysqli_insert_id($conn);
        header("Location: DamageReports_M.html");
        exit;
    }
}
?>
