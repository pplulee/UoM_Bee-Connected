<?php
include("include/common.php");
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="loader-wrapper">
    <span class="loader"><span class="loader-inner"></span></span>
</div>
<script>
    $(window).on('load', function(){
        setTimeout(removeLoader, 2000); //wait for page load PLUS two seconds.
    });
    function removeLoader(){
        $( ".loader-wrapper" ).fadeOut(500, function() {
            // fadeOut complete. Remove the loading div
            $( ".loader-wrapper" ).remove(); //makes page more lightweight
        });
    }
</script>
<link rel="stylesheet" href="resources/css/navigation.css">

<nav class="navbar navbar-expand-lg" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="index.php">BeeConnected!</a>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <form name="search" action="index.php" method="get">
                    <div class="search-container">
                        <input type="text" name="search" placeholder="Search..." class="search-input">
                        <a href="javascript:document.search.submit();" class="search-btn">
                            <i class="fas fa-search"></i>
                        </a>
                    </div>
                </form>

                <div class="profile">
                    <?php
                    if ($_SESSION["isLogin"]) {
                        $profilepic_url = getprofilepic($_SESSION["userid"]);
                        echo "<img class='profile_pic' src='{$profilepic_url}'/>
                        <div class='dropdown'>
                            <button class='dropbtn'>{$_SESSION["username"]}
                                <i class='fa fa-caret-down'></i>
                            </button>
                            <div class='dropdown-content'>
                                <a href='user.php'>Profile</a>";
                        if (isadmin($_SESSION["userid"])) {
                            echo "<a href='admin/index.php'>Admin centre</a>";
                        }
                        echo "
                                <a href='loginrecord.php'>Login Record</a>
                                <a href='action.php?action=logout'>Logout</a>
                            </div>
                        </div>";
                    } else {
                        echo "<span><a href='login.php'></a></span>";
                    }
                    ?>

                </div>

        </div>
        </ul>
    </div>
</nav>
