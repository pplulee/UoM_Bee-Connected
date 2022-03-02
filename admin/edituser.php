<?php
include ("header.php");

if (!isset($_GET["id"])){
    echo '<div class="alert alert-danger" role="alert"><p>Wrong parameters</p></div>';
    exit;
}else {
    $result = mysqli_query($conn, "SELECT * FROM user WHERE userid='{$_GET['id']}';");
    if (mysqli_num_rows($result) == 0){
        echo '<div class="alert alert-danger" role="alert"><p>User not found</p></div>';
        exit;
    }
    $result=mysqli_fetch_assoc($result);
}
?>
<form action='' method='post'>
    <div class='row'>
        <div class='col'>
            <label>User ID</label><br>
            <input type='text' class='form-control' name='userid' value='<?php echo $result["userid"]?>' readonly>
        </div>
        <div class='col'>
            <label>Username</label><br>
            <input type='text' class='form-control' name='username' value='<?php echo $result["username"]?>' readonly>
        </div>
    </div>
    <div class='form-group'>
        <label>Bio</label><br>
        <input type='text' class='form-control' name='bio' value='<?php echo $result["bio"]?>'>
    </div>
    <div class='form-group'>
        <label>Password</label><br>
        <input type='text' class='form-control' name='password' value='' placeholder='Please leave blank if you do not modify' >
    </div>
    <div class='form-group'>
        <label>Permission</label><br>
        <input type='text' class='form-control' name='permission' value='<?php echo $result["permission"]?>' required>
    </div>
    <input type='submit' name='submit' class='btn btn-primary btn-block' value='Update'>
    </form>
<?php
if (isset($_POST["submit"])){
    //Change password first
    if ($_POST["password"]!=""){
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        mysqli_query($conn, "UPDATE user SET password='{$password}' WHERE userid='{$_GET['id']}';");
    }
    mysqli_query($conn, "UPDATE user SET bio='{$_POST['bio']}' WHERE userid='{$_GET['id']}';");
    mysqli_query($conn, "UPDATE user SET permission='{$_POST['permission']}' WHERE userid='{$_GET['id']}';");
    echo "<div class='alert alert-success' role='alert'><p>Modified successfully, will return to user list soon</p></div>";
    echo "<script>setTimeout(\"javascript:location.href='user.php'\", 1000);</script>";
    exit;
}
