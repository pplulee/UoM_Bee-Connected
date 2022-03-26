<?php
include("header.php");
if (isset($_GET["logout"])) {
    logout();
}
?>
    <head>
        <script src="resources/js/read_more.js"></script>
        <title>Main Page</title>
    </head>
    <link rel="stylesheet" href="resources/css/index.css">
    <div class="main">
    <div class="container-fluid">
        <div class="row">
            <div class="col categories">
                <a href="index.php"><h2>Categories</h2></a>
                <ul class="menu-hover-fill flex flex-col items-start leading-none text-2xl uppercase space-y-4">
                    <?php
                    $result = mysqli_query($conn, "SELECT name,icon FROM category WHERE enable='1';");
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<a href='index.php?category={$row['name']}'><li class='tablinks'><i class='{$row['icon']}'></i>{$row['name']}</li></a>";
                        }
                    }
                    ?>
                </ul>
            </div>
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
                            $pid = $row["pid"];
                            echo "
                               
                                    <div class='main_post' id='main_post'>
                                        <div class = 'img_name_report' id = 'img_name_report'>
                                            <img src='$userpic'>
                                            <h1>$username</h1>
                                            <a class='report'>
                                                <p class='text_1'>!</p>
                                                <p class='text_2'>Report</p>
                                            </a>";
                            if ($_SESSION["isLogin"] and isauthor($_SESSION["userid"], $pid)) {
                                echo "
                                    <a href='index.php?action=delete&pid=$pid' class = 'delete_post' >
                                    <i class='fa-solid fa-trash-can text_1'></i>         
                                    <p class='text_2'>DELETE</p>
                                    </a> ";
                            }
                            echo "       </div>
                                        <div class = 'post_content' >
                                            <h1><b>{$row["category"]}:</b> {$row["title"]}</h1>
                                            <p id = 'post_content_p'>{$row["content"]}</p>
                                            <button onclick='read_more()' id='readmore()'>Read more</button>
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
                    <form action="" method="post" enctype="multipart/form-data">
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
                            <button class="send_post" name="send_post" type=submit><i
                                        class="fa-solid fa-paper-plane"></i></button>

                            <input id="browse" type="file" name="post_pic" hidden>
                            <input class="btn btn-primary" type="submit" name="upload" value="UPDATE" hidden>
                            <label for="browse" class="send_post"><i class="fa-solid fa-paperclip"></i></label>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col trending">
                <h2>Trending</h2>
                <div class="leaderboard">
                    <div class="head" style="text-align: center;">
                        <i class="fas fa-crown"></i>
                    </div>
                    <div class="body">
                        <ol>
                            <?php
                            $result = mysqli_query($conn, "SELECT * FROM post WHERE hide=0 ORDER BY view DESC LIMIT 10;");
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    if (strlen($row["title"]) > 20) {
                                        $row["title"] = substr($row["title"], 0, 20) . "...";
                                    }
                                    echo "
                                        <li>
                                            <mark>{$row["title"]}</mark>
                                            <small>{$row["view"]}</small>
                                        </li>";
                                }
                            }
                            ?>
                        </ol>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php
if (isset($_POST["send_post"])) {
    if (!$_SESSION["isLogin"]) {
        echo "<script>alert('You are not logged in!');window.location.href='index.php';</script>";
        exit;
    } else {
        if ((file_exists($_FILES["post_pic"]["tmp_name"])) or (is_uploaded_file($_FILES["post_pic"]["tmp_name"]))) {
            # have image
            if (check_image_valid($_FILES["post_pic"], 10240000)) {
                if ($_FILES["post_pic"]["error"] > 0) {
                    echo "Upload Error:" . $_FILES["post_pic"]["error"] . "<br>";
                } else {
                    $temp = explode(".", $_FILES["post_pic"]["name"]);
                    $extension = end($temp);
                    $filename = substr(md5(time()), 5, 32) . "." . $extension;
                    upload_image($_FILES["post_pic"]["tmp_name"], "data/image_post/", "{$filename}");
                    $feed = post_submit($_SESSION["userid"], $_POST["title"], $_POST["input_post"], $_POST["category"], $filename);
                }
            }
        } else {
            # no image
            $feed = post_submit($_SESSION["userid"], $_POST["title"], $_POST["input_post"], $_POST["category"]);
        }
        echo "<script>alert('{$feed[1]}');window.location.href='./index.php';</script>";
    }
}
if (isset($_GET["action"])) {
    switch ($_GET["action"]) {
        case "delete":
            if (!$_SESSION["isLogin"]) {
                echo "<script>alert('You are not logged in!');window.location.href='index.php';</script>";
                exit;
            } else {
                $feed = post_delete($_GET["pid"], $_SESSION["userid"]);
                echo "<script>alert('{$feed[1]}');window.location.href='./index.php';</script>";
            }
            break;
    }
}
