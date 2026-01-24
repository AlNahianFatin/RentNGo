<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = trim($_POST["name"]);
    $rating  = $_POST["rating"];
    $comment = trim($_POST["comment"]);

    $error = "";

    if (empty($name) || empty($rating) || strlen($comment) < 10) {
        $error = "❌ All fields are required (comment at least 10 chars).";
    }

    if (!$error) {
        setcookie("reviewName", $name, time() + (7 * 24 * 60 * 60), "/");
        setcookie("reviewRating", $rating, time() + (7 * 24 * 60 * 60), "/");
        setcookie("reviewComment", $comment, time() + (7 * 24 * 60 * 60), "/");
    }

    if ($error) {
        echo "<h2 style='color:red;'>$error</h2>";
        echo "<a href='Review&RatingM.html'>⬅ Go back</a>";
    } else {
        echo "<h2 style='color:green;'>✅ Review submitted successfully!</h2>";
        echo "<p><strong>Name:</strong> $name</p>";
        echo "<p><strong>Rating:</strong> $rating</p>";
        echo "<p><strong>Comment:</strong> $comment</p>";
        echo "<a href='Review&RatingM.html'>⬅ Back to form</a>";
    }
}
?>
