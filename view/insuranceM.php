<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tier = $_POST["coverageTier"];
    $deductible = $_POST["deductible"];
    $scenario = trim($_POST["claimScenario"]);

    if (empty($tier) || $deductible === "" || empty($scenario)) {
        echo "❌ All fields are required.";
        exit;
    }
    if (!is_numeric($deductible) || $deductible < 0) {
        echo "❌ Deductible must be a positive number.";
        exit;
    }

    echo "✅ Insurance submitted: Tier = $tier, Deductible = $deductible, Scenario = $scenario";
}
?>
