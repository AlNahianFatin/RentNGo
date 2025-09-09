<?php
session_start();

if(!isset($_SESSION['username'])) {
    // header('location: ../index.php?error=sessionExpired');
    // exit;
}
if(!isset($_SESSION['status'])) {
    // header('location: ../index.php?error=invalidRequest');
    // exit;
}

$id = $_GET['id'] ?? '';
// echo "Received ID: " . htmlspecialchars($id);
// echo "Received ID: " . $id;
?>