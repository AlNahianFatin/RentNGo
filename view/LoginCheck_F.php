<?php
    session_start();

    $username = trim($_REQUEST['username']);
    $password = trim($_REQUEST['password']);

    if($username == "" || $password == ""){
        header('location: index.php?error=null');
    }
    else{
        if($username == $password){
            $_SESSION['username'] = $username;
            setcookie('status', true, time()+3, '/');
            header('location: Staff_FuelTracking.php');
        }
        elseif(!isset($_COOKIE['status'])){
            header('location: login.php?error=sessionexpired');
        }
        else{
            header('location: index.php?error=invalid');
        }
    }
?>