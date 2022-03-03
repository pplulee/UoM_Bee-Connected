<?php
include("header.php");
checklogin();
$profilepic_url = getprofilepic($_SESSION["userid"]);
$result = mysqli_query($conn, "SELECT * FROM user WHERE userid='{$_SESSION["userid"]}';");
if (mysqli_num_rows($result) == 0){
    echo '<div class="alert alert-danger" role="alert"><p>Wrong parameters</p></div>';
    exit;
}
$result = mysqli_fetch_assoc($result);
?>
    <html lang="en-GB">
    <head>
        <link rel="stylesheet" href="resources/css/user-style.css">
    </head>
    <body>
    <div class="main">
        <form action="" method="post" enctype="multipart/form-data" name="image_save">
            <div class="row">
                <div class="col-5">
                    <img class="user_img" src=<?php echo $profilepic_url; ?>><br>
                    <input id="browse" type="file" name="profile_pic" hidden>
                    <input class="btn btn-primary" type="submit" name="upload" value="UPDATE" hidden>
                    <label for="browse">Choose File</label>
                </div>
                <div class="col-7">
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
                    <button name="save" id="save" type="submit">SAVE
                    </button>
                </div>
            </div>
        </form>
    </div>
    </body>
    </html>
<?php
if (isset($_POST["save"])) {
    if ($_POST["password"] != "") {
        //Change password first
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        mysqli_query($conn, "UPDATE user SET password='{$password}' WHERE userid='{$_SESSION["userid"]}';");
    }
    mysqli_query($conn, "UPDATE user SET bio='{$_POST['motto']}' WHERE userid='{$_SESSION["userid"]}';");
    if ((file_exists($_FILES["profile_pic"]["tmp_name"])) or (is_uploaded_file($_FILES["profile_pic"]["tmp_name"]))) {
        uploadpic();
    }
    echo "<script>alert('Modified successfully');window.location.href='';</script>";
}
function uploadpic()
{
    $allowedExts = array("gif", "jpeg", "jpg", "png");
    $temp = explode(".", $_FILES["profile_pic"]["name"]);
    $extension = end($temp);     // Get the extension
    if ((($_FILES["profile_pic"]["type"] == "image/gif")
            || ($_FILES["profile_pic"]["type"] == "image/jpeg")
            || ($_FILES["profile_pic"]["type"] == "image/jpg")
            || ($_FILES["profile_pic"]["type"] == "image/pjpeg")
            || ($_FILES["profile_pic"]["type"] == "image/x-png")
            || ($_FILES["profile_pic"]["type"] == "image/png"))
        && ($_FILES["profile_pic"]["size"] < 512000)   // Less than 500kb
        && in_array($extension, $allowedExts)) {
        if ($_FILES["profile_pic"]["error"] > 0) {
            echo "Upload Error:" . $_FILES["profile_pic"]["error"] . "<br>";
        } else {
            $existpic = getprofilepic($_SESSION["userid"]);
            if ($existpic != "data/image_profile/default.png") {
                // Image already exist
                unlink("{$_SERVER['DOCUMENT_ROOT']}/{$existpic}");
            }
            move_uploaded_file($_FILES["profile_pic"]["tmp_name"], "{$_SERVER['DOCUMENT_ROOT']}/data/image_profile/{$_SESSION['userid']}.$extension");
        }
    } else {
        echo "Illegal file formats";
    }
}
?>