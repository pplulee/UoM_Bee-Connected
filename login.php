<?php
include("header.php");
//If user is already login, exit this page
if (isset($_SESSION["isLogin"]) and $_SESSION["isLogin"] == TRUE) {
    echo "<script>alert('You are already logged in!');window.location.href='index.php';</script>";
    exit;
}

function addloginrecord($username, $status)
{
    global $conn;
    if (userexist($username)) {
        $userid = get_id_by_name($username);
        $ip = getIp();
        $datetime = date('Y-m-d H:i:s');
        mysqli_query($conn, "INSERT INTO user_login (userid, ip, datetime, type) VALUES ('$userid', '$ip', '$datetime', $status);");
    }
}

function login($username, $password)
{
    global $conn;
    if (userexist($username)) {
        return password_verify($password, mysqli_fetch_assoc(mysqli_query($conn, "SELECT password FROM user WHERE username='$username';"))["password"]);
    } else {
        return false;
    }
}

function startlogin($username, $password)
{
    if (login($username, $password)) {
        addloginrecord($username, 1);
        $_SESSION["isLogin"] = true;
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["permission"] = get_permission($username);
        $_SESSION["userid"] = get_id_by_name($username);
        echo "<script>alert('Login successfully!');window.location.href='index.php';</script>";
    } else {
        addloginrecord($username, 0);
        $_SESSION["isLogin"] = false;
        echo "<script>alert('Incorrect username or password!');window.location.href='login.php';</script>";
    }
}


//Click the login bottom
if (isset($_POST['login'])) {
    if ($_POST["username"]==null or $_POST["password"]==null) {
        echo "<script>alert('Username or password cannot be empty!');window.location.href='login.php';</script>";
        exit;
    } else {
        startlogin($_POST["username"], $_POST["password"]);
    }
} elseif (isset($_POST['register'])) {
    if ($_POST["username"]==null or $_POST["password"]==null) {
        echo "<script>alert('Username or password cannot be empty!');window.location.href='login.php';</script>";
        exit;
    } elseif (register($_POST["username"], $_POST["password"])) {
        echo "<script>alert('Register successfully!');window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('This user already exists!');window.location.href='login.php';</script>";
    }
}
?>
<html lang="en-GB">
<head>
    <link rel="stylesheet" href="resources/css/login-style.css">
    <title>Login</title>
</head>
<body>
<div class="main">
    <div class="logo">
        <h1><b>WHERE ALL THE STUDENTS BUZZ AROUND...</b></h1><br>
        <img src="/resources/images/bees.png">
    </div>
    <div class="login-box">
        <h1>Bee Connected!</h1>
        <form action="" method="post">
            <div class="user-box">
                <input type="text" name="username">
                <label>Username</label>
            </div>
            <div class="user-box">
                <input type="password" name="password">
                <label>Password</label>
            </div>
            <button name="login" class="login_btn" type="submit">Login
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </button>
            <h5>OR</h5>
            <button name="register" class="login_btn" type="submit">Register
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </button>
        </form>
    </div>
</div>
<div class='login-footer'>
</div>
</body>
</html>