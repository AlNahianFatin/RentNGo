<?php
session_start();
session_destroy();
header("Location: ../view/index.html");
exit();
?>
