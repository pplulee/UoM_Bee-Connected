<?php
include("header.php");
//If user is already login, exit this page
if (isset($_SESSION["isLogin"]) AND $_SESSION["isLogin"]==TRUE){
    echo "<div class='alert alert-success' role='alert'><p>You are already logged in, you are about to jump to the home page</p></div>";
    echo "<script>
                setTimeout(\"javascript:location.href='index.php'\", 1000);
              </script>";
    exit;
}

function userexist($username){
    global $conn;
    if (mysqli_num_rows(mysqli_query($conn, "SELECT username FROM user WHERE username='{$username}';")) == 0){
        return FALSE;
    }else{
        return TRUE;
    }
}

function register($username,$password){
    global $conn;
    global $hashkey;
    $password = password_hash($password,PASSWORD_DEFAULT);
    echo mysqli_query($conn, "INSERT INTO user (username, password) VALUES ('{$username}', '{$password}');");
}

//Click the reg bottom
if (isset($_POST['register'])) {
    if (!isset($_POST["username"]) or !isset($_POST["password"]) or !isset($_POST["password2"])){
        echo "<div class='alert alert-danger' role='alert'><p>Username or password cannot be empty</p></div>";
    }
    elseif ($_POST["password"] != $_POST["password2"]){
        echo "<div class='alert alert-danger' role='alert'><p>Password doesn't match</p></div>";
    }elseif (userexist($_POST["username"])){
        echo "<div class='alert alert-danger' role='alert'><p>This user already exists</p></div>";
    }else{
        register($_POST["username"],$_POST["password"]);
        echo "<div class='alert alert-success' role='alert'><p>Register successfully, will jump to the home page</p></div>";
        echo "<script>
                setTimeout(\"javascript:location.href='index.php'\", 1000);
              </script>";
    }
}
?>
<html lang="en-GB">
<head>
    <link rel="stylesheet" href="resources/css/style.css">
    <title>Register</title>
</head>
<body background="resources/images/bg_origin.png"> <!-- CSS background image doesn't work!! !-->
<div class="main">
    <div class="login-box">
        <h1>Bee Connected!</h1>
        <form action="" method="post">
            <div class="user-box">
                <input type="text" name="username" required="required">
                <label>Username</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required="required">
                <label>Password</label>
            </div>
            <div class="user-box">
                <input type="password" name="password2" required="required">
                <label>Confirm password</label>
            </div>
            <button name="register" class="btn btn-outline-primary" type="submit">Register</button>
        </form>
    </div>
</div>
</body>
</html>