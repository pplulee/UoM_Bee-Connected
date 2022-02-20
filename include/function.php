<?php
//Function for logout
function logout(){
    unset($_SESSION['isLogin']);
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    unset($_SESSION['permission']);
    exit("<script language='javascript'>alert('You have been successfully logged out');window.location.href='./index.php';</script>");
}

//Get user's name by userID
function getname($userid){
    global $conn;
    return mysqli_fetch_assoc(mysqli_query($conn, "SELECT username FROM user WHERE userid='{$userid}';"))['username'];
}