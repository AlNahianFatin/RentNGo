<?php
session_start();

$valid_firstname = "fName";
$valid_lastname = "lName";
$valid_semail = "email@example.com";
$valid_epassword = "password123";
$valid_confirmPassword = "password123";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST["firstname"] ?? "";
    $lastname = $_POST["lastname"] ?? "";
    $semail = $_POST["semail"] ?? "";
    $epassword = $_POST["epassword"] ?? "";
    $confirmPassword = $_POST["confirmPassword"] ?? "";

    if ($firstname === $valid_firstname &&
        $lastname === $valid_lastname &&
        $semail === $valid_semail &&
        $epassword === $valid_epassword &&
        $confirmPassword === $valid_confirmPassword) {
        
        $_SESSION["authUser"] = $firstname;
        setcookie("authUser", $firstname, time() + 86400, "/"); // 1 day

        header("Location: ../view/CustomerInventory_N.html");
        exit;
    } else {
        echo "❌ Invalid credentials. Please try again.";
    }
}
?>
