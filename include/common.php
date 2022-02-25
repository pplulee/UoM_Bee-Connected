<?php
header('Content-Type: text/html; charset=UTF-8');
define('ROOT', dirname(__FILE__).'/');
include ROOT.'../config.php';
include ("function.php");


//Enable error reporting
if ($Sys_config["debug"]){
    ini_set("display_errors","On");
    error_reporting(E_ALL);
}


if ($Sys_config["mysql_enable"]){
    $conn = @mysqli_connect($Sys_config["db_host"], $Sys_config["db_user"], $Sys_config["db_password"], $Sys_config["db_database"]);  //Database connection
}


//Initialize session
session_start();
if (!(isset($_SESSION["isLogin"]))){
    $_SESSION["isLogin"]=false;
}

//Initialize CSS
echo'<!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Grand+Hotel&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
</body>
</html>';
