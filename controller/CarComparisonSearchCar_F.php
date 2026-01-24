<?php
session_start();
require_once('../model/carModel.php');

header('Content-Type: application/json');

$records = [];
$car = $_REQUEST['car'] ?? '';
if ($car === '') {
    $records = getAllCars();
    echo json_encode($records);
    exit;
}

$records = searchCarByBrandModel($car);

if (!is_array($records)) 
    $records = [];

echo json_encode($records);
?>