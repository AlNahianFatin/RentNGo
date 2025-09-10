<?php
session_start();
require_once('../model/rentModel.php');

header('Content-Type: application/json');

$customer = $_GET['customer'] ?? '';
if ($customer === '') {
    echo json_encode([]);
    exit;
}

$records = getRentRecordByCName($customer);
if (!is_array($records)) $records = [];

echo json_encode($records);
