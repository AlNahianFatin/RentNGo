<?php
session_start();
if (isset($_GET['bid'])) {
    $_SESSION['bid'] = $_GET['bid'];
    header("Location: ../view/Admin_PickupLocationUpdate_F.php");
    exit;
}
?>