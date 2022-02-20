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

function login($username,$password){
    global $conn;
    if (mysqli_num_rows(mysqli_query($conn, "SELECT username FROM user WHERE username='{$username}';")) == 0){
        return false;
    }
    else{
        return password_verify($password,mysqli_fetch_assoc(mysqli_query($conn, "SELECT password FROM user WHERE username='{$username}';"))["password"]);
    }
}

function startlogin($username,$password){
    global $conn;
    if (login($username,$password)){
        $_SESSION["isLogin"]=true;
        $_SESSION["username"]=$_POST["username"];
        $_SESSION["userid"]=mysqli_fetch_assoc(mysqli_query($conn, "SELECT userid FROM user WHERE username='{$username}';"))["userid"];
        echo "<div class='alert alert-success' role='alert'><p>Login successfully, will jump to the home page</p></div>";
        echo "<script>setTimeout(\"javascript:location.href='index.php'\", 1000);</script>";
    }
    else{
        $_SESSION["isLogin"]=false;
        echo "<div class=\"alert alert-danger\" role=\"alert\"><p>Incorrect username or password</p></div>";
    }
}

//Click the login bottom
if (isset($_POST['login'])) {
    if (isset($_POST["username"]) or isset($_POST["password"])){
        startlogin($_POST["username"], $_POST["password"]);
    }
    else{
        echo "<div class='alert alert-danger' role='alert'><p>Username or password cannot be empty</p></div>";
    }
}
?>
<html lang="en-GB">
<head>
    <link rel="stylesheet" href="resources/css/style.css">
    <title>Login</title>
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
                <button name="login" class="btn btn-outline-primary" type="submit">Login</button>
            </form>
          </div>
    </div>
</body>
</html>