<?php
session_start();
if (isset($_GET['scheme'])) {
    $_SESSION['scheme'] = $_GET['scheme'];
    header("Location: ../view/Admin_LoyaltyProgramUpdate_F.php");
    exit;
}
?>