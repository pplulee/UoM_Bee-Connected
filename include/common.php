<?php
header('Content-Type: text/html; charset=UTF-8');
define('ROOT', dirname(__FILE__).'/');
include ROOT.'../config.php';
include ("function.php");


//Enable error reporting
ini_set("display_errors","On");
error_reporting(E_ALL);


$conn = @mysqli_connect($servername, $username, $password, $dbname);  //Database connection
if(!$conn)
{
    die ("MySQL connection error:".mysqli_connect_error($conn));
}

//Initialize session
session_start();
if (!(isset($_SESSION["isLogin"]))){
    $_SESSION["isLogin"]=FALSE;
}

//Initialize bootstrap
echo'<!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Grand+Hotel&display=swap" rel="stylesheet">
</head>
<body>
</body>
</html>';


