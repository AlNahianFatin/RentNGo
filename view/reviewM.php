<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $rating = $_POST["rating"];
    $comment = trim($_POST["comment"]);

    if (empty($name) || empty($rating) || strlen($comment) < 10) {
        echo "❌ All fields required and comment must be at least 10 characters.";
        exit;
    }

    echo "✅ Review submitted. Thanks, $name! Rating: $rating ★";
}
?>
