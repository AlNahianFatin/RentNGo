<?php
session_start();
require_once "../model/db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tier     = $_POST["coverageTier"];
    $deduct   = $_POST["deductible"];
    $scenario = trim($_POST["claimScenario"]);

    $error = "";
    $allowedTiers = ["basic","standard","premium"];

    if (empty($tier) || $deduct === "" || empty($scenario)) {
        $error = "All fields are required.";
    } elseif (!in_array($tier, $allowedTiers)) {
        $error = "Invalid coverage tier.";
    } elseif (!is_numeric($deduct) || $deduct < 0) {
        $error = "Deductible must be a positive number.";
    } else {
        $deduct = (float)$deduct;
    }

    if ($error) {
        echo "<h2 style='color:red;'>$error</h2><a href='InsuranceOptions_M.html'>⬅ Go back</a>";
    } else {
        $sql = "INSERT INTO insurance (booking_id, coverage_tier, deductible, claim_scenario) 
                VALUES ('{$_SESSION["booking_id"]}', '$tier', '$deduct', '$scenario')";

        if (!mysqli_query($conn, $sql)) {
            die("Insert failed: " . mysqli_error($conn));
        }

        $_SESSION["insurance_id"] = mysqli_insert_id($conn);
        header("Location: Review&Rating_M.html");
        exit;
    }
}
?>
