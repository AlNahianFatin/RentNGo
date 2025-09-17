<?php
session_start();
require_once('../model/branchModel.php');

header('Content-Type: application/json');

$records = [];
$branch = $_REQUEST['branch'] ?? '';
if ($branch === '') {
    $records = getAllBranches();
    echo json_encode($records);
    exit;
}

$records = searchBranchByLocation($branch);

if (!is_array($records)) 
    $records = [];

echo json_encode($records);
?>