<?php
session_start();

$valid_username = "user";
$valid_password = "password123";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION["authUser"] = $username;
        setcookie("authUser", $username, time() + 86400, "/"); // 1 day
        echo json_encode(["success" => true]);
    } 
    else {
        echo json_encode(["success" => false, "message" => "Invalid credentials"]);
    }
    exit;
}
?>