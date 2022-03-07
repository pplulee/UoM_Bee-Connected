<?php
//Function for logout
function logout(){
    unset($_SESSION['isLogin']);
    unset($_SESSION['userid']);
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    exit("<script>alert('You have been successfully logged out');window.location.href='./index.php';</script>");
}

function isadmin($userid=""){
    global $conn;
    if (!isset($userid) or $userid == "") {
        return false;
    }
    if (mysqli_fetch_assoc(mysqli_query($conn, "SELECT permission FROM user WHERE userid='{$userid}';"))['permission'] != 255) {
        return false;
    } else {
        return true;
    }
}

function get_name_by_id($userid)
{
    global $conn;
    return mysqli_fetch_assoc(mysqli_query($conn, "SELECT username FROM user WHERE userid='$userid';"))['username'];
}

function get_id_by_name($username)
{
    global $conn;
    return mysqli_fetch_assoc(mysqli_query($conn, "SELECT userid FROM user WHERE username='$username';"))['userid'];
}

function checklogin()
{
    if (!isset($_SESSION["isLogin"]) or $_SESSION["isLogin"] == false) {
        echo "<script>
                setTimeout(\"javascript:location.href='login.php'\", 0);
              </script>";
        exit;
    }
}

function userexist($username)
{
    global $conn;
    if (mysqli_num_rows(mysqli_query($conn, "SELECT username FROM user WHERE username='$username';")) == 0) {
        return false;
    } else {
        return true;
    }
}

function register($username, $password)
{
    global $conn;
    if (userexist($username)) {
        return false;
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($conn, "INSERT INTO user (username, password) VALUES ('{$username}', '{$password}');");
        return true;
    }
}

function getprofilepic($userid)
{
    if (file_exists("data/image_profile/$userid.png")) {
        return "data/image_profile/$userid.png";
    } elseif (file_exists("data/image_profile/$userid.jpg")) {
        return "data/image_profile/$userid.jpg";
    } elseif (file_exists("data/image_profile/$userid.jpeg")) {
        return "data/image_profile/$userid.jpeg";
    } elseif (file_exists("data/image_profile/$userid.gif")) {
        return "data/image_profile/$userid.gif";
    } else {
        return "data/image_profile/default.png";
    }
}

function getIp(){
    $ip='0.0.0.0'; //Unknown IP
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        return is_ip($_SERVER['HTTP_CLIENT_IP'])?$_SERVER['HTTP_CLIENT_IP']:$ip;
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        return is_ip($_SERVER['HTTP_X_FORWARDED_FOR'])?$_SERVER['HTTP_X_FORWARDED_FOR']:$ip;
    }else{
        return is_ip($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:$ip;
    }
}

function is_ip($str)
{
    $ip = explode('.', $str);
    for ($i = 0; $i < count($ip); $i++) {
        if ($ip[$i] > 255) {
            return false;
        }
    }
    return preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/', $str);
}

function post_submit($userid, $title, $content, $category)
{
    global $conn;
    if ($_SESSION["permission"] == 0) {
        return array(false, "You don't have permission to send post");
    } else {
        mysqli_query($conn, "INSERT INTO post (author,title,content,category) VALUES ('$userid','$title','$content','$category')");
        return array(true, "Success!");
    }
}