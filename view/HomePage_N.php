<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username === "admin" && $password === "123456") {
        $_SESSION["user"] = $username;
        header("Location: inventory_N.html");
        exit;
    } 
    else {
        echo "❌ Invalid Username or Password";
    }
}
?>