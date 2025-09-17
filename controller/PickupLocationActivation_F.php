<?php
session_start();
require_once('../model/branchModel.php');

header('Content-Type: application/json');

$bid = $_REQUEST['bid'] ?? '';
$activation = $_REQUEST['activation'] ?? '';

if ($bid !== '' && ($activation === '0' || $activation === '1')) {
    $result = activationByBID($bid, $activation);
    echo json_encode($result);
    exit;
}
echo json_encode(false);
?>