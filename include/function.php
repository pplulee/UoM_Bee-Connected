<?php
function logout()
{
    $_SESSION['isLogin'] = false;
    unset($_SESSION['userid']);
    unset($_SESSION['username']);
    exit("<script>alert('You have been successfully logged out');window.location.href='index.php';</script>");
}

function isadmin($userid = 0)
{
    global $conn;
    if (!isset($userid) or $userid == 0) {
        return false;
    }
    if (mysqli_fetch_assoc(mysqli_query($conn, "SELECT permission FROM user WHERE userid='{$userid}';"))['permission'] != 255) {
        return false;
    } else {
        return true;
    }
}

function isauthor($id, $userid, $type = "post")
{
    global $conn;
    if ($id == "" or $userid == "" or !is_numeric($id)) {
        return false;
    }
    if (isadmin($userid)) {
        return true;
    }
    switch ($type) {
        case "post":
            $result = mysqli_query($conn, "SELECT author FROM post WHERE pid='{$id}';");
            if (mysqli_num_rows($result) == 0) {
                return false;
            } else {
                return mysqli_fetch_assoc($result)['author'] == $userid;
            }
        case "comment":
            $result = mysqli_query($conn, "SELECT userid FROM reply WHERE rid='{$id}';");
            if (mysqli_num_rows($result) == 0) {
                return false;
            } else {
                return mysqli_fetch_assoc($result)['userid'] == $userid;
            }
        default:
            return false;
    }
}

function get_permission($username)
{
    global $conn;
    return mysqli_fetch_assoc(mysqli_query($conn, "SELECT permission FROM user WHERE username='{$username}';"))['permission'];
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
        return array(false,"Username already exists");
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($conn, "INSERT INTO user (username, password) VALUES ('{$username}', '{$password}');");
        return array(true,"");
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

function getIp()
{
    $ip = '0.0.0.0'; //Unknown IP
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return is_ip($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : $ip;
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return is_ip($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $ip;
    } else {
        return is_ip($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : $ip;
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

function post_submit($userid, $title, $content, $category, $image = "")
{
    global $conn;
    if ($_SESSION["permission"] == 0) {
        return array(false, "You don't have permission to send post");
    } else {
        $date=get_time();
        $title = htmlspecialchars($title);
        $content = htmlspecialchars($content);
        mysqli_query($conn, "INSERT INTO post (author,title,content,category,attach_pic, date) VALUES ('{$userid}','{$title}','{$content}','{$category}','{$image}', '{$date}');");
        return array(true, "Success!");
    }
}

function post_getpic($postid)
{
    global $conn;
    $result = mysqli_fetch_assoc(mysqli_query($conn, "SELECT attach_pic FROM post WHERE pid={$postid};"))["attach_pic"];
    if ($result != "") {
        return "data/image_post/$result";
    } else {
        return "";
    }
}

function post_report($userid, $type, $id, $reason = "No reason")
{
    global $conn;
    if ($_SESSION["permission"] == 0 or $userid == "" or $type == "" or $id == "" or !is_numeric($userid) or !is_numeric($id)) {
        return array(false, "No permission");
    } else {
        $date=get_time();
        $reason = htmlspecialchars($reason);
        mysqli_query($conn, "INSERT INTO report (id, type, userid, reason, date) VALUES ('{$id}', '{$type}', '{$userid}','{$reason}', '{$date}');");
        return array(true, "Success!");
    }
}

function post_delete_pic($postid)
{
    $result = post_getpic($postid);
    if ($result != "") {
        unlink($result);
    }
}

function post_delete($postid, $userid)
{
    global $conn;
    if (!isauthor($postid, $userid, "post")) {
        return array(false, "No permission");
    }
    if (!is_numeric($postid) or !is_numeric($userid)) {
        return array(false, "Invalid parameters");
    } else {
        post_delete_pic($postid);
        mysqli_query($conn, "DELETE FROM post WHERE pid='{$postid}';");
        return array(true, "Success!");
    }
}

function comment_delete($commentid, $userid)
{
    global $conn;
    if (!is_numeric($commentid) or !is_numeric($userid)) {
        return array(false, "Invalid parameters");
    }
    if (!isauthor($commentid, $userid, "comment")) {
        return array(false, "No permission");
    } else {
        mysqli_query($conn, "DELETE FROM reply WHERE rid='{$commentid}';");
        return array(true, "Success!");
    }
}

function reply($postid, $content, $reply_to = 0)
{
    global $conn;
    if ($_SESSION["permission"] == 0) {
        return array(false, "You don't have permission to reply");
    } else {
        $date = get_time();
        $content = htmlspecialchars($content);
        mysqli_query($conn, "INSERT INTO reply (post_id,userid,content,reply_to, date) VALUES ('{$postid}','{$_SESSION["userid"]}','{$content}','{$reply_to}', '{$date}');");
        return array(true, "Success!");
    }
}

function check_image_valid($image, $size_limit = 1024000)
{
    $allowedExts = array("gif", "jpeg", "jpg", "png");
    $temp = explode(".", $image["name"]);
    $extension = end($temp);
    if ((($image["type"] == "image/gif")
            || ($image["type"] == "image/jpeg")
            || ($image["type"] == "image/jpg")
            || ($image["type"] == "image/pjpeg")
            || ($image["type"] == "image/x-png")
            || ($image["type"] == "image/png"))
        && ($image["size"] < $size_limit)
        && in_array($extension, $allowedExts)) {
        return true;
    } else {
        return false;
    }
}

function get_report_type($rid)
{
    global $conn;
    return mysqli_fetch_assoc(mysqli_query($conn, "SELECT type FROM report WHERE reportid={$rid};"))["type"];
}

function upload_image($imagefilename, $path, $filename)
{
    move_uploaded_file($imagefilename, "{$_SERVER['DOCUMENT_ROOT']}/{$path}{$filename}");
}

function get_time(){
    return date('Y-m-d H:i:s');
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

function view_inc($postid)
{
    global $conn;
    mysqli_query($conn, "UPDATE post SET view=view+1 WHERE pid={$postid};");
}

function check_username_valid($username)
{
    if (preg_match('/^[A-Za-z0-9_-]{4,32}$/', $username)) {
        return true;
    } else {
        return false;
    }
}