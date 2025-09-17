<?php
session_start();
require_once "../model/db_connect.php";

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vehicleId      = trim($_POST["vehicleId"]);
    $damageType     = $_POST["damageType"];
    $signature      = trim($_POST["signature"]);
    $photoName      = $_FILES["damagePhoto"]["name"] ?? '';
    $signaturePhoto = $_FILES["signaturePhoto"]["name"] ?? '';

    $error = "";

    if (empty($vehicleId) || empty($signature)) {
        $error = "Vehicle ID and Signature are required.";
    } elseif (empty($damageType) && empty($photoName)) {
        $error = "Must provide damage type or photo.";
    }

    if ($error) {
        echo json_encode(["success"=>false, "message"=>$error]);
        exit;
    }

    // ⚠️ Note: files are not being moved, only filenames stored
    $sql = "INSERT INTO damage_reports (booking_id, vehicle_id, damage_type, damage_photo, signature, signature_photo) 
            VALUES ('{$_SESSION["booking_id"]}', '$vehicleId', '$damageType', '$photoName', '$signature', '$signaturePhoto')";

    if (!mysqli_query($conn, $sql)) {
        echo json_encode(["success"=>false, "message"=>"Database insert failed"]);
        exit;
    }

    $_SESSION["damage_id"] = mysqli_insert_id($conn);

    echo json_encode([
        "success" => true,
        "message" => "Damage report submitted!",
        "next" => "InsuranceOptions_M.html"
    ]);
}
?>
