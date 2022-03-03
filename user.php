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
        <script src="save.js"></script>
    </head>

    <body>
    <div class="main">
        <div class="row">
            <div class="col-5">
                <form action="" method="post" enctype="multipart/form-data" name="image_save">
                    <img class="user_img" src=<?php echo $profilepic_url; ?>><br>
                    <input id="browse" type="file" name="file" hidden>
                    <input class="btn btn-primary" type="submit" name="upload" value="UPDATE" hidden>
                    <label for="browse">Choose File</label>
                </form>
            </div>
            <div class="col-7">
                <form action="" method="post" name="info_save">
                    <div class="user-box">
                        <input type="text" name="username" value="<?php echo $result['username']; ?>" readonly>
                        <label>Username</label>
                    </div>
                    <div class="user-box">
                        <input type="password" name="password" value=""
                               placeholder="Leave blank if you don't want to modify">
                        <label>Password</label>
                    </div>
                    <div class="user-box">
                        <input type="text" name="motto" value="<?php echo $result['bio']; ?>">
                        <label>Motto</label>
                    </div>
                    <button name="save" id="save" type="submit" onclick="submitForms()">SAVE
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
function uploadpic()
{
    $allowedExts = array("gif", "jpeg", "jpg", "png");
    $temp = explode(".", $_FILES["file"]["name"]);
    $extension = end($temp);     // Get the extension
    if ((($_FILES["file"]["type"] == "image/gif")
            || ($_FILES["file"]["type"] == "image/jpeg")
            || ($_FILES["file"]["type"] == "image/jpg")
            || ($_FILES["file"]["type"] == "image/pjpeg")
            || ($_FILES["file"]["type"] == "image/x-png")
            || ($_FILES["file"]["type"] == "image/png"))
        && ($_FILES["file"]["size"] < 512000)   // Less than 500kb
        && in_array($extension, $allowedExts)) {
        if ($_FILES["file"]["error"] > 0) {
            echo "Upload Error:" . $_FILES["file"]["error"] . "<br>";
        } else {
            $existpic = getprofilepic($_SESSION["userid"]);
            if ($existpic != "data/image_profile/default.png") {
                // Image already exist
                unlink("{$_SERVER['DOCUMENT_ROOT']}/{$existpic}");
            }
            move_uploaded_file($_FILES["file"]["tmp_name"], "{$_SERVER['DOCUMENT_ROOT']}/data/image_profile/{$_SESSION['userid']}.$extension");
            echo "<script>setTimeout(\"javascript:location.href='user.php'\", 0);</script>";
        }
    } else {
        echo "Illegal file formats";
    }
}

if (isset($_POST["upload"])) {
    uploadpic();
}
?>