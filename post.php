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
?>
<head>
    <title>Post</title>
</head>
<link rel="stylesheet" href="resources/css/index.css">
<div class="main">
    <div class="container-fluid">
        <div class="row">
            <?php
            include "category.php"
            ?>
            <div class="col-8 content">
                <div class='posts post_read_more' id="posts">
                    <div class='read_more_main'>
                        <div class='img_user_report_read_more'>
                            <img src='<?php echo getprofilepic($result_post['author']); ?>'>
                            <h1><?php echo get_name_by_id($result_post['author']); ?></h1>
                            <a href='report.php?type=post&id=<?php echo $_GET["pid"]; ?>' class='report' title='report'>
                                !
                            </a>
                            <?php
                            if ($_SESSION["isLogin"] and isauthor($_GET["pid"], $_SESSION["userid"], "post")) {
                                echo "
                                    <a href='action.php?action=delete&type=post&id={$_GET["pid"]}' class='report delete_read_more' title='delete'>
                                        <i class='fa-solid fa-trash-can text_1'></i>
                                    </a>";
                            }
                            ?>
                        </div>
                        <div class='post_content_read_more'>
                            <h1><?php echo htmlspecialchars_decode($result_post["title"]); ?></h1>
                            <p><?php echo htmlspecialchars_decode($result_post["content"]); ?></p><br>
                            <?php
                            $image=post_getpic($_GET["pid"]);
                            if ($image!="") {
                                echo "<img src='{$image}'>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class='comment_input'>
                        <form action='action.php?action=comment_submit' method='post' autocomplete='off'>
                            <input type='text' class='comment_input_content' name='comment'
                                   placeholder='Type Your comment here...'
                                   required maxlength='300'>
                            <input name='pid' type='hidden' value='<?php echo $_GET["pid"]; ?>'>
                            <button class="send_comment" name='send_comment' type=submit><i
                                        class="fa-solid fa-paper-plane"></i></button>
                        </form>
                    </div>
                    <?php
                    $result_reply = mysqli_query($conn, "SELECT rid, userid, content, date FROM reply WHERE post_id={$_GET["pid"]} ORDER BY date DESC;");
                    if (mysqli_num_rows($result_reply) > 0) {
                        echo "<div class='all_comments'>";
                        while ($row = mysqli_fetch_assoc($result_reply)) {
                            $profile_pic = getprofilepic($row['userid']);
                            $username = get_name_by_id($row['userid']);
                            echo "
                                <div class='comment'>
                                    <div class='img_user'>
                                        <img src='{$profile_pic}' >
                                        <h1>{$username}</h1>";
                            echo "<a href='report.php?type=comment&id={$row["rid"]}' class='report' title='report'>
                                    !
                                </a><br>";
                            if ($_SESSION["isLogin"] and isauthor($row["rid"], $_SESSION["userid"], "comment")) {
                                echo "
                                    <a href='action.php?action=delete&type=comment&id={$row["rid"]}' class = 'delete_post' title='delete'>
                                        <i class='fa-solid fa-trash-can text_1'></i>
                                    </a>";
                            }
                            echo "
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
            <?php
            include "trending.php";
            ?>
        </div>
    </div>
