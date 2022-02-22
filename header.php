<?php
include("include/common.php");
?>
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
            </ul>
        </div>
    </div>
</nav>
