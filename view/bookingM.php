<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pickupDate = $_POST["pickupDate"];
    $pickupTime = $_POST["pickupTime"];
    $returnDate = $_POST["returnDate"];
    $returnTime = $_POST["returnTime"];

    // Backend validation
    if (empty($pickupDate) || empty($pickupTime) || empty($returnDate) || empty($returnTime)) {
        echo "❌ All fields are required.";
        exit;
    }

    $pickup = strtotime("$pickupDate $pickupTime");
    $return = strtotime("$returnDate $returnTime");

    if ($pickup < time()) {
        echo "❌ Pickup time cannot be in the past.";
        exit;
    }
    if ($return <= $pickup) {
        echo "❌ Return must be after pickup.";
        exit;
    }

    echo "✅ Booking successful! Pickup: $pickupDate $pickupTime, Return: $returnDate $returnTime";
}
?>
