<?php
include("header.php");
//If user is already login, exit this page
if (isset($_SESSION["isLogin"]) and $_SESSION["isLogin"] == TRUE) {
    echo "<div class='alert alert-success' role='alert'><p>You are already logged in, you are about to jump to the home page</p></div>";
    echo "<script>
                setTimeout(\"javascript:location.href='index.php'\", 3000);
              </script>";
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
        echo "<div class='alert alert-success' role='alert'><p>Login successfully, will jump to the home page</p></div>";
        echo "<script>setTimeout(\"javascript:location.href='index.php'\", 3000);</script>";
    } else {
        addloginrecord($username, 0);
        $_SESSION["isLogin"] = false;
        echo "<div class=\"alert alert-danger\" role=\"alert\"><p>Incorrect username or password</p></div>";
    }
}


//Click the login bottom
if (isset($_POST['login'])) {
    if (isset($_POST["username"]) or isset($_POST["password"])) {
        startlogin($_POST["username"], $_POST["password"]);
    } else {
        echo "<div class='alert alert-danger' role='alert'><p>Username or password cannot be empty</p></div>";
    }
} elseif (isset($_POST['register'])) {
    if (!isset($_POST["username"]) or !isset($_POST["password"])) {
        echo "<div class='alert alert-danger' role='alert'><p>Username or password cannot be empty</p></div>";
    } elseif (register($_POST["username"], $_POST["password"])) {
        echo "<div class='alert alert-success' role='alert'><p>Register successfully, page will refresh</p></div>";
        echo "<script>
                setTimeout(\"javascript:location.href=''\", 3000);
              </script>";
    } else {
        echo "<div class='alert alert-danger' role='alert'><p>This user already exists</p></div>";
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