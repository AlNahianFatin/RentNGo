<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pickupDate  = $_POST["pickupDate"];
    $pickupTime  = $_POST["pickupTime"];
    $returnDate  = $_POST["returnDate"];
    $returnTime  = $_POST["returnTime"];
    $vehicleType = $_POST["vehicleType"];
    $role        = $_POST["role"] ?? "user";

    $error = "";

    if (empty($pickupDate) || empty($pickupTime) || empty($returnDate) || empty($returnTime)) {
        $error = "❌ All fields are required.";
    } else {
        $pickup = strtotime("$pickupDate $pickupTime");
        $return = strtotime("$returnDate $returnTime");

        if ($pickup < time()) {
            $error = "❌ Pickup time cannot be in the past.";
        } elseif ($return <= $pickup) {
            $error = "❌ Return must be after pickup.";
        }
    }

    if (!$error) {
        setcookie("vehicleType", $vehicleType, time() + (7 * 24 * 60 * 60), "/");
        setcookie("pickupDate", $pickupDate, time() + (7 * 24 * 60 * 60), "/");
        setcookie("pickupTime", $pickupTime, time() + (7 * 24 * 60 * 60), "/");
        setcookie("returnDate", $returnDate, time() + (7 * 24 * 60 * 60), "/");
        setcookie("returnTime", $returnTime, time() + (7 * 24 * 60 * 60), "/");
        setcookie("role", $role, time() + (7 * 24 * 60 * 60), "/");
    }

    if ($error) {
        echo "<h2 style='color:red;'>$error</h2>";
        echo "<a href='BookingCalendarM.html'>⬅ Go back</a>";
    } else {
        echo "<h2 style='color:green;'>✅ Booking successful!</h2>";
        echo "<p><strong>Vehicle:</strong> $vehicleType</p>";
        echo "<p><strong>Pickup:</strong> $pickupDate $pickupTime</p>";
        echo "<p><strong>Return:</strong> $returnDate $returnTime</p>";
        echo "<p><strong>Mode:</strong> $role</p>";
        echo "<a href='BookingCalendarM.html'>⬅ Back to form</a> | ";
        echo "<a href='PricingCalculatorM.html'>➡ Continue to Pricing</a>";
    }
}
?>
