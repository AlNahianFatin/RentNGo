<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vehicleId  = trim($_POST["vehicleId"]);
    $damageType = $_POST["damageType"];
    $signature  = trim($_POST["signature"]);
    $photoName  = $_FILES["damagePhoto"]["name"] ?? '';

    $error = "";

    if (empty($vehicleId) || empty($signature)) {
        $error = "❌ Vehicle ID and Signature are required.";
    } elseif (empty($damageType) && empty($photoName)) {
        $error = "❌ Must provide damage type or photo.";
    }

    if (!$error) {
        setcookie("vehicleId", $vehicleId, time() + (7 * 24 * 60 * 60), "/");
        setcookie("damageType", $damageType, time() + (7 * 24 * 60 * 60), "/");
        setcookie("signature", $signature, time() + (7 * 24 * 60 * 60), "/");

        if (!empty($photoName)) {
            setcookie("damagePhoto", $photoName, time() + (7 * 24 * 60 * 60), "/");
        }
    }

    if ($error) {
        echo "<h2 style='color:red;'>$error</h2>";
        echo "<a href='DamageReportsM.html'>⬅ Go back</a>";
    } else {
        echo "<h2 style='color:green;'>✅ Damage report submitted successfully!</h2>";
        echo "<p><strong>Vehicle ID:</strong> $vehicleId</p>";
        echo "<p><strong>Damage Type:</strong> " . ($damageType ?: "Photo uploaded") . "</p>";
        echo "<p><strong>Signature:</strong> $signature</p>";
        echo "<a href='DamageReportsM.html'>⬅ Back to form</a> | ";
        echo "<a href='InsuranceOptionsM.html'>➡ Continue to Insurance</a>";
    }
}
?>
