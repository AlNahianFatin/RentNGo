<?php
session_start();
require_once('../model/rentModel.php');

header('Content-Type: application/json');

$customer = $_REQUEST['customer'] ?? '';
if ($customer === '') {
    $records = getAllRentRecords();
    echo json_encode($records);
    exit;
}

$records = searchRentRecordByCName($customer);

if (!is_array($records)) 
    $records = [];

echo json_encode($records);