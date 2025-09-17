<?php
session_start();
require_once('../model/branchModel.php');

header('Content-Type: application/json');

$bid = $_REQUEST['bid'] ?? '';

if ($bid !== '') {
    $result = getBranchByID($bid);
    echo json_encode($result);
    exit;
}
echo json_encode(false);
?>