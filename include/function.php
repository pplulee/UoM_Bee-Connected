<?php
//Function for logout
function logout(){
    unset($_SESSION['isLogin']);
    unset($_SESSION['userid']);
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    unset($_SESSION['permission']);
    exit("<script>alert('You have been successfully logged out');window.location.href='./index.php';</script>");
}

function get_name_by_id($userid){
    global $conn;
    return mysqli_fetch_assoc(mysqli_query($conn, "SELECT username FROM user WHERE userid='$userid';"))['username'];
}

function get_id_by_name($username){
    global $conn;
    return mysqli_fetch_assoc(mysqli_query($conn, "SELECT userid FROM user WHERE username='$username';"))['userid'];
}

function getprofilepic($userid){
    if(file_exists("data/image_profile/$userid.png")){
        return "data/image_profile/$userid.png";
    }else{
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
function is_ip($str){
    $ip=explode('.',$str);
    for($i=0;$i<count($ip);$i++){
        if($ip[$i]>255){
            return false;
        }
    }
    return preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/',$str);
}