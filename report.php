<?php
include("header.php");
if (isset($_GET["type"])) {
    switch ($_GET["type"]) {
        case "post":
        {
            if ($_GET["id"] == "" || !is_numeric($_GET["id"])) {
                echo "<h1>Invalid post id</h1>";
                exit;
            } else {
                $result = mysqli_query($conn, "SELECT pid, title, content, author FROM post WHERE hide='0' AND pid={$_GET["id"]};");
                if (mysqli_num_rows($result) == 0) {
                    echo "<h1>Post not found</h1>";
                    exit;
                } else {
                    $result = mysqli_fetch_assoc($result);
                    $userid = $result["author"];
                    $title = htmlspecialchars_decode($result["title"]);
                    $content = htmlspecialchars_decode($result["content"]);
                }
            }
            break;
        }
        case "comment":
        {
            if ($_GET["id"] == "" || !is_numeric($_GET["id"])) {
                echo "<h1>Invalid comment id</h1>";
                exit;
            } else {
                $result = mysqli_query($conn, "SELECT rid, userid, content FROM reply WHERE visible='1' AND rid={$_GET["id"]};");
                if (mysqli_num_rows($result) == 0) {
                    echo "<h1>Comment not found</h1>";
                    exit;
                } else {
                    $result = mysqli_fetch_assoc($result);
                    $userid = $result["userid"];
                    $title = "Comment";
                    $content = htmlspecialchars_decode($result["content"]);
                }
            }
            break;
        }
        default:
        {
            echo "<h1>Invalid type</h1>";
            exit;
        }
    }
} else {
    echo "<h1>Invalid type</h1>";
    exit;
}
?>
    <head>
        <title>Report</title>
    </head>
    <link rel="stylesheet" href="resources/css/index.css">
    <div class="main">
    <div class="container-fluid">
        <div class="row">
            <?php
            include "category.php";
            ?>
            <div class="col-8 content">
                <div class='posts post_read_more' id="posts">
                    <div class='read_more_main'>
                        <div class='img_user_report_read_more'>
                            <img src='<?php echo getprofilepic($userid); ?>'>
                            <h1><?php echo get_name_by_id($userid); ?></h1>
                        </div>
                        <div class='post_content_read_more'>
                            <h1><?php echo $title; ?></h1>
                            <p><?php echo $content; ?></p>
                        </div>
                    </div>
                    <div class='comment_input'>
                        <form action='action.php?action=report_submit' method='post'>
                            <input type='text' class='comment_input_content' name='report_reason'
                                   placeholder='Type Your report reason here...'
                                   required maxlength='50'>
                            <input name='type' type='hidden' value='<?php echo $_GET["type"]; ?>'>
                            <input name='id' type='hidden' value='<?php echo $_GET["id"]; ?>'>
                            <button class="send_comment" name='send_report' type=submit><i
                                        class="fa-solid fa-paper-plane"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <?php
            include "trending.php";
            ?>
        </div>
    </div>
