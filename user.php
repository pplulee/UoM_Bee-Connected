<?php
include("header.php");
if (!isset($_SESSION["isLogin"]) or $_SESSION["isLogin"]==false){
    echo "<script>
                setTimeout(\"javascript:location.href='login.php'\", 0);
              </script>";
    exit;
}else{
    $profilepic_url = getprofilepic($_SESSION["userid"]);
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM user WHERE userid='{$_SESSION["userid"]}';");
    if (mysqli_num_rows($result) == 0){
        echo '<div class="alert alert-danger" role="alert"><p>Wrong parameters</p></div>';
        exit;
    }
    $result = mysqli_fetch_assoc($result);
}
?>
<html lang="en-GB">
<head>
    <link rel="stylesheet" href="resources/css/user-style.css">
</head>

<body>
    <div class = "main">
        <div class="row">
            <div class="col-5">
                <img class = "user_img" src=<?php echo $profilepic_url; ?>>
            </div>
            <div class="col-7">
                <form action="" method="post">
                    <div class="user-box">
                        <input type="text" name="username" value="<?php echo $result['username']; ?>" readonly>
                        <label>Username</label>
                    </div>
                    <div class="user-box">
                        <input type="password" name="password" value="" placeholder="Please leave blank if you do not modify">
                        <label>Password</label>
                    </div>
                    <div class="user-box">
                        <input type="text" name="motto" value="<?php echo $result['bio']; ?>">
                        <label>Motto</label>
                    </div>
                    <button name="save" id="save" type="submit">SAVE
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php
if (isset($_POST["save"])) {
    $pwdchanged = false;
    if ($_POST["password"] != "") {
        //Change password first
        $pwdchanged = true;
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        mysqli_query($conn, "UPDATE user SET password='{$password}' WHERE userid='{$_SESSION["userid"]}';");
    }
    mysqli_query($conn, "UPDATE user SET bio='{$_POST['motto']}' WHERE userid='{$_SESSION["userid"]}';");
    echo "<div class='alert alert-success' role='alert'>Modified successfully</div>";
    echo "<script>setTimeout(\"javascript:location.href='user.php'\", 1500); </script>";
}
?>