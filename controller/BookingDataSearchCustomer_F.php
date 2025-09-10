<?php
session_start();
require_once('../model/rentModel.php');

header('Content-Type: application/json');

$customer = $_GET['customer'] ?? '';
if ($customer === '') {
    $records = getAllRentRecords();
    echo json_encode($records);
    exit;
}

$records = getRentRecordByCName($customer);

if (!is_array($records)) 
    $records = [];

echo json_encode($records);