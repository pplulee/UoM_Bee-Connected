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
            <div class="col categories">
                <a href="index.php"><h2>Categories</h2></a>
                <ul class="menu-hover-fill flex flex-col items-start leading-none text-2xl uppercase space-y-4">
                    <?php
                    $result_category = mysqli_query($conn, "SELECT name,icon FROM category WHERE enable='1';");
                    if (mysqli_num_rows($result_category) > 0) {
                        while ($row_category = mysqli_fetch_assoc($result_category)) {
                            echo "<a href='index.php?category={$row_category['name']}'><li class='tablinks'><i class='{$row_category['icon']}'></i>{$row_category['name']}</li></a>";
                        }
                    }
                    ?>
                </ul>
            </div>

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
if (isset($_POST["comment"])) {
    if (!$_SESSION["isLogin"]) {
        echo "<script>alert('You are not logged in!');window.location.href='index.php';</script>";
        exit;
    } else {
        $feed = reply($_POST["pid"], $_POST["comment"]);
        echo "<script>alert('{$feed[1]}');window.location.href='post.php?pid={$_POST["pid"]}';</script>";
    }
}
