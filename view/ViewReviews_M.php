<?php
session_start();
require_once "../model/db_connect.php";

// ✅ Only staff allowed
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "staff") {
    die("Access denied. Staff only.");
}

// Fetch reviews
$result = mysqli_query($conn, "SELECT name, rating, comment FROM reviews ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Customer Reviews</title>
</head>
<body>
  <h2>Customer Reviews</h2>
  <?php while($row = mysqli_fetch_assoc($result)): ?>
    <p><strong><?= htmlspecialchars($row['name']) ?></strong> 
       (<?= $row['rating'] ?>/5)</p>
    <p><?= htmlspecialchars($row['comment']) ?></p>
    <hr>
  <?php endwhile; ?>
</body>
</html>
