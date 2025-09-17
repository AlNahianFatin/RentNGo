<?php
session_start();
require_once('../model/loyaltyModel.php');

header('Content-Type: application/json');

$scheme = $_REQUEST['scheme'] ?? '';
$activation = $_REQUEST['activation'] ?? '';

if ($scheme !== '' && ($activation === '0' || $activation === '1')) {
    $result = activationBySName($scheme, $activation);
    echo json_encode($result);
    exit;
}
echo json_encode(false);
?>