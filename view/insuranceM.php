<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tier     = $_POST["coverageTier"];
    $deduct   = $_POST["deductible"];
    $scenario = trim($_POST["claimScenario"]);

    $error = "";

    if (empty($tier) || $deduct === "" || empty($scenario)) {
        $error = "❌ All fields are required.";
    } elseif (!is_numeric($deduct) || $deduct < 0) {
        $error = "❌ Deductible must be a positive number.";
    }

    if (!$error) {
        // --- Save into cookies (7 days) ---
        setcookie("coverageTier", $tier, time() + (7 * 24 * 60 * 60), "/");
        setcookie("deductible", $deduct, time() + (7 * 24 * 60 * 60), "/");
        setcookie("claimScenario", $scenario, time() + (7 * 24 * 60 * 60), "/");
    }

    if ($error) {
        echo "<h2 style='color:red;'>$error</h2>";
        echo "<a href='InsuranceOptionsM.html'>⬅ Go back</a>";
    } else {
        echo "<h2 style='color:green;'>✅ Insurance submitted successfully!</h2>";
        echo "<p><strong>Coverage:</strong> $tier</p>";
        echo "<p><strong>Deductible:</strong> $deduct</p>";
        echo "<p><strong>Scenario:</strong> $scenario</p>";
        echo "<a href='InsuranceOptionsM.html'>⬅ Back to form</a> | ";
        echo "<a href='Review&RatingM.html'>➡ Continue to Review</a>";
    }
}
?>
