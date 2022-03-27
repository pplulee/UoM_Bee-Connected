<?php
include("header.php");
if (!isset($_GET["pid"]) or $_GET["pid"] == "") {
    echo "<h1>Post not found</h1>";
    exit;
} else {
    $result_post = mysqli_query($conn, "SELECT pid, title, content, author FROM post WHERE hide='0' AND pid={$_GET["pid"]};");
    if (mysqli_num_rows($result_post) == 0) {
        echo "<h1>Post not found</h1>";
        exit;
    } else {
        view_inc($_GET["pid"]);
        $result_post = mysqli_fetch_assoc($result_post);
    }
}
if (isset($_POST["comment"])) {
    if (!$_SESSION["isLogin"]) {
        echo "<script>alert('You are not logged in!');window.location.href='index.php';</script>";
        exit;
    } else {
        $feed = reply($_POST["pid"], $_POST["comment"]);
        echo "<script>alert('{$feed[1]}');window.location.href='post.php?pid={$_POST["pid"]}';</script>";
    }
}
?>
    <head>
        <title>Post</title>
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
                <div class='posts post_read_more' id="posts">
                    <div class='read_more_main'>
                        <div class='img_user_report_read_more'>
                            <img src='<?php echo getprofilepic($result_post['author']); ?>'>
                            <h1><?php echo get_name_by_id($result_post['author']); ?></h1>
                            <a href='report.php?type=post&id=<?php echo $_GET["pid"]; ?>' class='report'>
                                !
                            </a>
                            <?php
                            if ($_SESSION["isLogin"] and isauthor($_SESSION["userid"], $_GET["pid"])) {
                                echo "
                                    <a href='index.php?action=delete&pid={$_GET["pid"]}' class='report'>
                                        <i class='fa-solid fa-trash-can text_1'></i>
                                    </a>";
                            }
                            ?>
                        </div>
                        <div class='post_content_read_more'>
                            <h1><?php echo htmlspecialchars_decode($result_post["title"]); ?></h1>
                            <p><?php echo htmlspecialchars_decode($result_post["content"]); ?></p>
                            <?php
                            $image=post_getpic($_GET["pid"]);
                            if ($image!="") {
                                echo "<img src='{$image}'>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class='comment_input'>
                        <form action='' method='post'>
                            <input type='text' class='comment_input_content' name='comment'
                                   placeholder='Type Your comment here...'
                                   required maxlength='50'>
                            <input name='pid' type='hidden' value='<?php echo $_GET["pid"]; ?>'>
                            <button class="send_comment" name='send_comment' type=submit><i
                                        class="fa-solid fa-paper-plane"></i></button>
                        </form>
                    </div>
                    <?php
                    $result_reply= mysqli_query($conn, "SELECT userid, content, date FROM reply WHERE post_id={$_GET["pid"]} ORDER BY date DESC;");
                    if (mysqli_num_rows($result_reply) > 0) {
                        echo "<div class='all_comments'>";
                        while ($row = mysqli_fetch_assoc($result_reply)){
                            $profile_pic = getprofilepic($row['userid']);
                            $username= get_name_by_id($row['userid']);
                            echo "
                                <div class='comment'>
                                    <div class='img_user'>
                                        <img src='{$profile_pic}' >
                                        <h1>{$username}</h1>
                                    </div>
                                    <div class = 'comment_content'>
                                        <p>{$row['content']}</p>
                                    </div>
                                </div>";
                        }
                        echo "</div>";
                    }
                    ?>
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
