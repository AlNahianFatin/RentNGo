<?php
require_once('db.php');

function searchBranchByLocation($branch) {
    $conn = getConnection();
    $bEscaped = mysqli_real_escape_string($conn, $branch);
    $sql = "SELECT * FROM branch WHERE location LIKE '%$bEscaped%' OR district LIKE '%$bEscaped%'";
    $result = mysqli_query($conn, $sql);

    $records = [];

    if($result && mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result))
            $records [] = $row;
    }
    mysqli_close($conn);
    return $records;
}

function getBranchByID($bid) {
    $conn = getConnection();
    $bIDEscaped = (int)$bid;
    $sql = "SELECT * FROM branch WHERE bid = $bIDEscaped";
    $result = mysqli_query($conn, $sql);

    $record = [];

    if($result && mysqli_num_rows($result) == 1) 
        $record = mysqli_fetch_assoc($result);

    mysqli_close($conn);
    return $record;
}

function getAllBranches() {
    $conn = getConnection();
    $sql = "SELECT * FROM branch";
    $result = mysqli_query($conn, $sql);

    $records = [];

    if($result && mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result))
            $records [] = $row;
    }
    mysqli_close($conn);
    return $records;
}

function checkBranchExistance($district, $location) {
    $conn = getConnection();
    $dEscaped = mysqli_real_escape_string($conn, $district);
    $sql = "SELECT * FROM branch WHERE district = '$dEscaped'";
    $count = mysqli_query($conn, $sql);

    $lEscaped = mysqli_real_escape_string($conn, $branch);
    $sql2 = "SELECT * FROM branch WHERE location = '$lEscaped'";
    $count2 = mysqli_query($conn, $sql2);
    
    if($count && mysqli_num_rows($count) >= 1 && $count2 && mysqli_num_rows($count2) >= 1) {
        mysqli_close($conn);
        return true;
    }
    return false;
}

function getAvailableBranches() {
    $conn = getConnection();
    $sql = "SELECT * FROM branch WHERE available = '1'";
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

function addBranch($branch) {
    if(checkBranchExistance($branch['location']))
        return ['status' => 'exists'];

    $conn = getConnection();

    $sql = "INSERT INTO branch VALUES ('{$branch['bid']}', '{$branch['district']}', '{$branch['location']}', '{$branch['available']}')";
    if(mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        return ['status' => 'success'];
    }
    mysqli_close($conn);
    return ['status' => 'error'];
}

function activationByBID($bid, $isActive) {
    $conn = getConnection();
    $bIDEscaped = mysqli_real_escape_string($conn, $bid);

    $sql = "UPDATE branch SET available = '$isActive' WHERE bid = '$bIDEscaped'";
    if(mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        return true;
    }
    mysqli_close($conn);
    return false;
}

function deletionByBID($bid) {
    $conn = getConnection();
    $bIDEscaped = mysqli_real_escape_string($conn, $bid);

    $sql = "DELETE FROM branch WHERE bid = '$bIDEscaped'";
    if(mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        return true;
    }
    mysqli_close($conn);
    return false;
}

function updateBranch($branch) {
    $conn = getConnection();
    // $bIDEscaped = mysqli_real_escape_string($conn, $branch['bid']);
    $bIDEscaped = (int)$branch['bid'];

    $sql2 = "UPDATE branch SET district = '{$branch['district']}' WHERE bid = '$bIDEscaped'";
    $sql = "UPDATE branch SET location = '{$branch['location']}' WHERE bid = '$bIDEscaped'";
    if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)) {
        mysqli_close($conn);
        return true;
    }
    mysqli_close($conn);
    return false;
}

// function getCustomerLoyaltyPoints($cName) {
//     $conn = getConnection();
//     $cEscaped = mysqli_real_escape_string($conn, $cName);

//     $sql = "SELECT * FROM customer WHERE username = '$cEscaped'";
//     $result = mysqli_query($conn, $sql);

//     $record = []; 
//     if($result && mysqli_num_rows($result) == 1) 
//         $record = mysqli_fetch_assoc($result);

//     mysqli_close($conn);
//     return $record;
// }
?>