<?php
require_once('db.php');

function getRentRecordByCName($cName) {
    $conn = getConnection();
    $cNameEscaped = mysqli_real_escape_string($conn, $cName);
    $sql = "SELECT * FROM rentrecord WHERE cname LIKE '%$cNameEscaped%'";
    $result = mysqli_query($conn, $sql);

    $records = [];

    if($result && mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result))
            $records [] = $row;
        mysqli_close($conn);
        return $records;
    }
    else {
        mysqli_close($conn);
        return $records;
    }
}

function getAllRentRecords() {
    $conn = getConnection();
    $sql = "SELECT * FROM rentrecord";
    $result = mysqli_query($conn, $sql);

    $records = [];

    if($result && mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result))
            $records [] = $row;
        mysqli_close($conn);
        return $records;
    }
    else {
        mysqli_close($conn);
        return $records;
    }
}
?>