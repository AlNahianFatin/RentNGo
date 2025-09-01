<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $startDate = $_POST["startDate"];
    $endDate = $_POST["endDate"];
    $vehicleType = $_POST["vehicleType"];
    $promoCode = $_POST["promoCode"];

    if (empty($startDate) || empty($endDate) || empty($vehicleType)) {
        echo "❌ All required fields must be filled.";
        exit;
    }

    $start = strtotime($startDate);
    $end = strtotime($endDate);

    if ($start >= $end) {
        echo "❌ End date must be after start date.";
        exit;
    }

    // Example daily rates
    $rates = ["Premio"=>50, "Prado"=>80, "Hiace"=>70, "BMW"=>120, "Allion"=>45];
    $days = ($end - $start) / (60 * 60 * 24);
    $cost = $days * $rates[$vehicleType];

    if ($promoCode === "DISCOUNT10") {
        $cost *= 0.9;
    }

    echo "✅ Total Price: $" . number_format($cost, 2);
}
?>
