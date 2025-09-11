<?php
session_start();
require_once('../model/carModel.php');

header('Content-Type: application/json');

$record = [];
$car = $_REQUEST['car'] ?? '';
if ($car !== '') {
    $record = getCarByID($car);
    echo json_encode($record);
    exit;
}

else if ($car === '' || !is_array($record)) {
    $record = [];
}

echo json_encode($record);
?>