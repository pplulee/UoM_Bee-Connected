<?php
include("header.php");
if (!$_SESSION["isLogin"]) {
    echo "<div class=\"alert alert-warning\" role=\"alert\"><p>You are not logged in yet\n</p></div>";
    echo "<a href=\"login.php\"><button type=\"button\" class=\"btn btn-primary\">Go to Login</button></a>";
    exit;
} else {
    echo "If you see this message, it means you are logged in\n";
}
if (isset($_GET["logout"])) {
    logout();
}

function post_submit($userid,$title,$content,$category){
    global $conn;
    if ($_SESSION["permission"]==0){
        return array(false,"You don't have permission to send post");
    }else{
        mysqli_query($conn, "INSERT INTO post (author,title,content,category) VALUES ('$userid','$title','$content','$category')");
        return array(true, "Success!");
    }
}