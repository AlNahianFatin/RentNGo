<?php
require_once('db.php');

function checkSchemeExistance($sName) {
    $conn = getConnection();
    $sEscaped = mysqli_real_escape_string($conn, $sName);
    $sql = "SELECT * FROM loyalty WHERE scheme = '$sEscaped'";
    $count = mysqli_query($conn, $sql);
    
    if($count && mysqli_num_rows($count) >= 1) {
        mysqli_close($conn);
        return true;
    }
    return false;
}

function searchLoyaltyBySName($sName) {
    $conn = getConnection();
    $sNameEscaped = mysqli_real_escape_string($conn, $sName);
    $sql = "SELECT * FROM loyalty WHERE scheme LIKE '%$sNameEscaped%'";
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

function getLoyaltyBySName($sName) {
    $conn = getConnection();
    $sNameEscaped = mysqli_real_escape_string($conn, $sName);
    $sql = "SELECT * FROM loyalty WHERE scheme = '$sNameEscaped'";
    $result = mysqli_query($conn, $sql);

    $record = null;

    if($result && mysqli_num_rows($result) === 1) {
        $record = mysqli_fetch_assoc($result);
        mysqli_close($conn);
        return $record;
    }
    else {
        mysqli_close($conn);
        return $record;
    }
}

function getAllLoyalties() {
    $conn = getConnection();
    $sql = "SELECT * FROM loyalty";
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

function getAvailableLoyalties() {
    $conn = getConnection();
    $sql = "SELECT * FROM loyalty WHERE activation = '1'";
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

function addScheme($loyalty) {
    if(checkSchemeExistance($loyalty['scheme']))
        return ['status' => 'exists'];

    $conn = getConnection();
    $sEscaped = mysqli_real_escape_string($conn, $loyalty['scheme']);

    $sql = "INSERT INTO loyalty VALUES ('$sEscaped', '{$loyalty['points']}', '{$loyalty['amentities']}', '{$loyalty['amount']}', '{$loyalty['activation']}')";
    if(mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        return ['status' => 'success'];
    }
    mysqli_close($conn);
    return ['status' => 'error'];
}

function activationBySName($sName, $isActive) {
    $conn = getConnection();
    $sEscaped = mysqli_real_escape_string($conn, $sName);

    $sql = "UPDATE loyalty SET activation = '$isActive' WHERE scheme = '$sEscaped'";
    if(mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        return true;
    }
    mysqli_close($conn);
    return false;
}

function deletionBySName($sName) {
    $conn = getConnection();
    $sEscaped = mysqli_real_escape_string($conn, $sName);

    $sql = "DELETE FROM loyalty WHERE scheme = '$sEscaped'";
    if(mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        return true;
    }
    mysqli_close($conn);
    return false;
}

function updateScheme($loyalty) {
    $conn = getConnection();
    $sEscaped = mysqli_real_escape_string($conn, $loyalty['scheme']);

    $sql = "UPDATE loyalty SET points = '{$loyalty['points']}', amentities = '{$loyalty['amentities']}', amount = '{$loyalty['amount']}' WHERE scheme = '$sEscaped'";
    if(mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        return true;
    }
    mysqli_close($conn);
    return false;
}

function getCustomerLoyaltyPoints($cName) {
    $conn = getConnection();
    $cEscaped = mysqli_real_escape_string($conn, $cName);

    $sql = "SELECT * FROM customer WHERE username = '$cEscaped'";
    $result = mysqli_query($conn, $sql);

    $record = []; 
    if($result && mysqli_num_rows($result) == 1) 
        $record = mysqli_fetch_assoc($result);

    mysqli_close($conn);
    return $record;
}
?>