<?php
include("header.php");
?>
<head>
    <title>BeeConnected!</title>
</head>
<link rel="stylesheet" href="resources/css/index.css">

<div class="main">
    <div class="container-fluid">
        <div class="row">
            <?php
            include "category.php"
            ?>
            <div class="col-8 content">
                <div class='posts' id="posts">
                    <?php
                    if (isset($_GET["search"]) && (isset($_GET["category"]))) {
                        $result = mysqli_query($conn, "SELECT * FROM post WHERE hide ='0' AND caregory = {$_GET["category"]} AND content LIKE '%{$_GET["search"]}%' OR title LIKE '%{$_GET["search"]}%' ORDER BY pid DESC;");
                    } else if (isset($_GET["search"])) {
                        $result = mysqli_query($conn, "SELECT * FROM post WHERE hide ='0' AND content LIKE '%{$_GET["search"]}%' OR title LIKE '%{$_GET["search"]}%' ORDER BY pid DESC;");
                    } else if (isset($_GET["category"])) {
                        $result = mysqli_query($conn, "SELECT * FROM post WHERE hide ='0' AND category = '{$_GET["category"]}' ORDER BY pid DESC;");
                    } else {
                        $result = mysqli_query($conn, "SELECT * FROM post WHERE hide ='0' ORDER BY pid DESC;");
                    }
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $userid = $row["author"];
                            $username = get_name_by_id($userid);
                            $userpic = getprofilepic($userid);
                            $content = htmlspecialchars_decode($row["content"]);
                            $title = htmlspecialchars_decode($row["title"]);
                            $pid = $row["pid"];
                            $viewnum=get_view($pid);
                            echo "
                                    <div class='main_post' id='main_post'>
                                        <div class = 'img_name_report' id = 'img_name_report'>
                                            <img src='$userpic'>
                                            <h1>$username</h1>
                                            <a href='report.php?type=post&id=$pid' class='report'>
                                                <p class='text_1'>!</p>
                                                <p class='text_2'>Report</p>
                                            </a>";
                            if ($_SESSION["isLogin"] and isauthor($pid, $_SESSION["userid"], "post")) {
                                echo "
                                    <a href='action.php?action=delete&type=post&id=$pid' class = 'delete_post' >
                                    <i class='fa-solid fa-trash-can text_1'></i>         
                                    <p class='text_2'>DELETE</p>
                                    </a> ";
                            }
                            echo "       </div>
                                        <div class = 'post_content' >
                                            <h1><b>{$row["category"]}:</b> $title</h1>
                                            <p id = 'post_content_p'>$content</p>
                                            <a href='post.php?pid=$pid' class='read_more'><button id='readmore'>Read more</button></a>
                                            <div class='viewicon'></div>
                                            <span class='viewnum'>$viewnum</span>
                                        </div>
                                    </div>
                                ";
                        }
                    } else {
                        echo "<h1>No post found</h1>";
                    }
                    ?>
                </div>
                <div class="input_area">
                    <form action="action.php?action=post_submit" method="post" enctype="multipart/form-data">
                        <div class="input_text">
                            <input type="text" class="post_title" name="title" placeholder="Your title goes here"
                                   required maxlength="50">
                            <textarea name="input_post" id="post_self" cols="80" rows=4
                                      placeholder="What's on Your mind?" required></textarea>
                        </div>
                        <div class="choose_submit">
                            <select id="post_category" name="category">
                                <?php
                                $result = mysqli_query($conn, "SELECT name FROM category WHERE enable='1';");
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='{$row['name']}'>{$row['name']}</option>";
                                    }
                                }
                                ?>
                            </select>
                            <input id="browse" type="file" name="post_pic" hidden>
                            <input class="btn btn-primary" type="submit" name="upload" value="UPDATE" hidden>
                            <label for="browse" class="send_post"><i class="fa-solid fa-image"></i></label>

                            <button class="send_post" name="post_submit" type=submit><i
                                        class="fa-solid fa-paper-plane"></i></button>

                          </div>
                    </form>
                </div>
            </div>
            <?php
            include "trending.php";
            ?>
        </div>
    </div>
</div>
