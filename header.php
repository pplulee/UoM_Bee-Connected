<?php
include("include/common.php");
?>

<link rel="stylesheet" href="resources/css/navigation.css">
<nav class="navbar navbar-expand-lg navbar-light bg-light" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Bee Connected UOM</a>
        </div>
        <p class="post">POSTS</p>
        <div>
            <ul class="nav navbar-nav">
                <div class="search-container">
                    <input type="text" name="search" placeholder="Search..." class="search-input">
                    <a href="#" class="search-btn">
                        <i class="fas fa-search"></i>
                    </a>
                </div>

                <div class="profile">
                    <?php
                    if ($_SESSION["isLogin"]) {
                        $profilepic_url = getprofilepic($_SESSION["userid"]);
                        echo "<img class = \"profile_pic\" src='{$profilepic_url}'/>
                        <div class='dropdown'>
                            <button class='dropbtn'>{$_SESSION["username"]}
                                <i class='fa fa-caret-down'></i>
                            </button>
                            <div class='dropdown-content'>
                                <a href='user.php'>Profile</a>
                                <a href='index.php?logout'>Logout</a>
                            </div>
                        </div>";
                    } else {
                        echo "<a href='login.php'><button type='button' class='btn btn-outline-success'>Login</button></a>";
                    }
                    ?>
                </div>

        </div>
        </ul>
    </div>
</nav>
