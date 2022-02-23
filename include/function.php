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

//Get user's name by userID
function getname($userid){
    global $conn;
    return mysqli_fetch_assoc(mysqli_query($conn, "SELECT username FROM user WHERE userid='{$userid}';"))['username'];
}

function getprofilepic($userid){
    global $conn;
    if(file_exists("data/image_profile/$userid.png")){
        return "data/image_profile/$userid.png";
    }else{
        return "data/image_profile/default.png";
    }
}