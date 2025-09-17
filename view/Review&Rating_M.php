<?php
session_start();
require_once "../model/db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = trim($_POST["name"]);
    $rating  = $_POST["rating"];
    $comment = trim($_POST["comment"]);

    $error = "";

    if (empty($name) || empty($rating) || strlen($comment) < 10) {
        $error = "All fields are required (comment at least 10 chars).";
    } elseif (!is_numeric($rating) || $rating < 1 || $rating > 5) {
        $error = "Rating must be between 1 and 5.";
    }

    if ($error) {
        echo "<h2 style='color:red;'>$error</h2><a href='Review&Rating_M.html'>⬅ Go back</a>";
    } else {
        $sql = "INSERT INTO reviews (booking_id, name, rating, comment) 
                VALUES ('{$_SESSION["booking_id"]}', '$name', '$rating', '$comment')";

        if (!mysqli_query($conn, $sql)) {
            die("Insert failed: " . mysqli_error($conn));
        }

        $_SESSION["review_id"] = mysqli_insert_id($conn);
        header("Location: SessionSummary_M.php");
        exit;
    }
}
?>
