<?php
include ("../include/common.php");
if (!isset($_SESSION['isLogin']) or !isadmin($_SESSION["userid"])){
    echo "<script>window.location.href='../index.php';</script>";
    exit;
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">Website index</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="user.php">User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="category.php">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="loginrecord.php">Login Record</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="report.php">Report Manage</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
