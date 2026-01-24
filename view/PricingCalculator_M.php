<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $startDate   = $_POST["startDate"];
    $endDate     = $_POST["endDate"];
    $vehicleType = $_POST["vehicleType"];
    $promoCode   = $_POST["promoCode"];
    $role        = $_POST["role"] ?? "user";

    $error = "";

    if (empty($startDate) || empty($endDate) || empty($vehicleType)) {
        $error = "❌ All required fields must be filled.";
    } else {
        $start = strtotime($startDate);
        $end   = strtotime($endDate);

        if ($end <= $start) {
            $error = "❌ End date must be after start date.";
        }
    }

    if (!$error) {
        $dailyRates = [
            "Premio" => 50,
            "Prado"  => 80,
            "Hiace"  => 70,
            "BMW"    => 120,
            "Allion" => 45
        ];

        $days = ($end - $start) / (60 * 60 * 24);
        $rate = isset($dailyRates[$vehicleType]) ? $dailyRates[$vehicleType] : 0;
        $price = $days * $rate;

        if (!empty($promoCode) && strtoupper($promoCode) === "DISCOUNT10") {
            $price *= 0.9;
        }

        setcookie("startDate", $startDate, time() + (7 * 24 * 60 * 60), "/");
        setcookie("endDate", $endDate, time() + (7 * 24 * 60 * 60), "/");
        setcookie("vehicleType", $vehicleType, time() + (7 * 24 * 60 * 60), "/");
        setcookie("promoCode", $promoCode, time() + (7 * 24 * 60 * 60), "/");
        setcookie("totalPrice", number_format($price, 2), time() + (7 * 24 * 60 * 60), "/");
        setcookie("role", $role, time() + (7 * 24 * 60 * 60), "/");
    }

    if ($error) {
        echo "<h2 style='color:red;'>$error</h2>";
        echo "<a href='PricingCalculatorM.html'>⬅ Go back</a>";
    } else {
        echo "<h2 style='color:green;'>✅ Price calculated successfully!</h2>";
        echo "<p><strong>Vehicle:</strong> $vehicleType</p>";
        echo "<p><strong>Start:</strong> $startDate</p>";
        echo "<p><strong>End:</strong> $endDate</p>";
        echo "<p><strong>Promo:</strong> " . ($promoCode ?: "None") . "</p>";
        echo "<p><strong>Total Price:</strong> $" . number_format($price, 2) . "</p>";
        echo "<p><strong>Mode:</strong> $role</p>";
        echo "<a href='PricingCalculatorM.html'>⬅ Back to form</a> | ";
        echo "<a href='DamageReportsM.html'>➡ Continue to Damage</a>";
    }
}
?>
