<?php
session_start();
require_once('../model/loyaltyModel.php');

header('Content-Type: application/json');

$scheme = $_REQUEST['scheme'] ?? '';

if ($scheme !== '') {
    $result = getLoyaltyBySName($scheme);
    echo json_encode($result);
    exit;
}
echo json_encode(false);
?>