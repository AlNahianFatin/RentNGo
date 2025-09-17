<?php
$host = "localhost";    
$user = "root";         
$pass = "";             
$dbname = "rentngo";    

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    echo("Connection failed: " . $conn->connect_error);
}
?>
