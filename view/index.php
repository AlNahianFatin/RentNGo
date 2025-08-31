<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn Page</title>

    <link rel="stylesheet" href="../asset/style.css">
</head>
<body>
    <form action="LoginCheck.php" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Signin</legend>
                <label for="username"> Username: </label>
                <input type="text" name="username" class="font-itim" name="location" style="border-radius: 10px; margin: 0px 15px;" placeholder="username"> <br>
                <label for="password"> Password: </label>
                <input type="password" name="password" class="font-itim" name="location" style="border-radius: 10px; margin: 0px 15px;" placeholder="password"> <br>
                <input type="submit" name="submit" value="Submit">
            </fieldset>
        </form>
</body>
</html>

<?php
    session_start();
    if(isset($_REQUEST['error'])){
        if($_REQUEST['error'] == "invalid"){
            echo "invalid username/password!";
        }
        elseif($_REQUEST['error'] == "null"){
            echo "null username or password!";
        }
    }
?>