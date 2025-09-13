<?php
require_once('db.php');

function searchCarByBrandModel($car) {
    $conn = getConnection();
    $cBMEscaped = mysqli_real_escape_string($conn, $car);
    $sql = "SELECT * FROM car WHERE brand LIKE '%$cBMEscaped%' OR model LIKE '%$cBMEscaped%'";
    $result = mysqli_query($conn, $sql);

    $records = [];

    if($result && mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result))
            $records [] = $row;
    }
    mysqli_close($conn);
    return $records;
}

function getCarByID($cid) {
    $conn = getConnection();
    $cIDEscaped = (int)$cid;
    $sql = "SELECT * FROM car WHERE cid = $cIDEscaped";
    $result = mysqli_query($conn, $sql);

    $record = [];

    if($result && mysqli_num_rows($result) == 1) 
        $record = mysqli_fetch_assoc($result);

    mysqli_close($conn);
    return $record;
}

function getAllCars() {
    $conn = getConnection();
    $sql = "SELECT * FROM car";
    $result = mysqli_query($conn, $sql);

    $records = [];

    if($result && mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result))
            $records [] = $row;
    }
    mysqli_close($conn);
    return $records;
}
?>