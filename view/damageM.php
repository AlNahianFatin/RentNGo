<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vehicleId = trim($_POST["vehicleId"]);
    $damageType = $_POST["damageType"];
    $signature = trim($_POST["signature"]);

    if (empty($vehicleId) || empty($signature)) {
        echo "❌ Vehicle ID and Signature are required.";
        exit;
    }
    if (empty($damageType) && empty($_FILES["damagePhoto"]["name"])) {
        echo "❌ Must provide damage type or photo.";
        exit;
    }

    echo "✅ Damage report submitted for vehicle: $vehicleId";
}
?>
