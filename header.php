<?php
include("include/common.php");
?>

<link rel="stylesheet" href="resources/css/navigation.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<nav class="navbar navbar-expand-lg navbar-light bg-light" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Title</a>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <?php
                if ($_SESSION["isLogin"]){
                echo "<a href='index.php?logout'><button name='logout' type='submit' class='btn btn-outline-primary'>Logout</button></a>";
                }
                ?>
                <!-- <button type="button" class="btn btn-outline-success">Login</button> -->
                <img src="/resources/images/profile.png"/>
                <div class="dropdown">
                    <button class="dropbtn">Username
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content">
                        <a href="#">Profile</a>
                        <a href="#">Logout</a>
                    </div>
                </div>
        </div>
            </ul>
        </div>
    </div>
</nav>
