<?php
include("header.php");
//If user is already login, exit this page
if (isset($_SESSION["isLogin"]) and $_SESSION["isLogin"] == TRUE) {
    echo "<script>alert('You are already logged in!');window.location.href='index.php';</script>";
    exit;
}



function login($username, $password)
{
    global $conn;
    if (userexist($username)) {
        if (password_verify($password, mysqli_fetch_assoc(mysqli_query($conn, "SELECT password FROM user WHERE username='{$username}';"))["password"])) {
            if (get_permission($username) == 0) {
                addloginrecord($username, 0);
                return array(false, "Your account is unavailable");
            } else {
                addloginrecord($username, 1);
                return array(true, "");
            }
        } else {
            addloginrecord($username, 0);
            return array(false, "Wrong password");
        }
    } else {
        return array(false, "User not exist");
    }
}

function startlogin($username, $password)
{
    $result = login($username, $password);
    if ($result[0]) {
        $_SESSION["isLogin"] = true;
        $_SESSION["userid"] = get_id_by_name($username);
        $_SESSION["permission"] = get_permission($username);
        $_SESSION["username"] = $username;
        addloginrecord($username, 1);
        echo "<script>alert('Login successfully!');window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('$result[1]');window.location.href='login.php';</script>";
    }
}

//Click the login bottom
if (isset($_POST['login'])) {
    if ($_POST["username"] == null or $_POST["password"] == null) {
        echo "<script>alert('Username or password cannot be empty!');window.location.href='login.php';</script>";
        exit;
    } else if(!check_username_valid($_POST["username"])) {
        echo "<script>alert('Username is invalid!');window.location.href='login.php';</script>";
        exit;
    } else {
        startlogin($_POST["username"], $_POST["password"]);
    }
} elseif (isset($_POST['register'])) {
    if ($_POST["username"] == null or $_POST["password"] == null) {
        echo "<script>alert('Username or password cannot be empty!');window.location.href='login.php';</script>";
        exit;
    }else if(!check_username_valid($_POST["username"])) {
        echo "<script>alert('Username is invalid!');window.location.href='login.php';</script>";
        exit;
    }else {
        $feed=register($_POST["username"], $_POST["password"]);
        if (!$feed[0]){
            echo "<script>alert('$feed[1]');window.location.href='login.php';</script>";
        }else{
            echo "<script>alert('Register successfully!');window.location.href='login.php';</script>";
        }

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