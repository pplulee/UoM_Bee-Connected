<?php
include("header.php");
/*if (!$_SESSION["isLogin"]) {
    echo "<div class=\"alert alert-warning\" role=\"alert\"><p>You are not logged in yet\n</p></div>";
    echo "<a href=\"login.php\"><button type=\"button\" class=\"btn btn-primary\">Go to Login</button></a>";
    exit;
} else {
    echo "If you see this message, it means you are logged in\n";
}
}*/
if (isset($_GET["logout"])) {
    logout();
}
?>
    <head>
        <script src="resources/js/read_more.js"></script>
        <title>main page</title>
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

                    <div class = 'read_more_main'>
                        <div class = 'img_user_report_read_more'>
                            <img src="" alt="">
                            <h1>username</h1>
                            <a class='report'>
                                !
                            </a>
                            <a class='report'>
                                <i class='fa-solid fa-trash-can text_1'></i>
                            </a>
                        </div>
                        <div class = 'post_content_read_more'>
                            <h1>Test post for read more</h1>
                            <p>Lorem ipsum aksjd ajksnd askjdna sdkjnasd aksjnda skdjnas dkjasnd aksjd
                            asdiasd ais jd asidnawjdn ajnda
                                d askjdna sdkjnasd aksjnda skdjnas dkjasnd aksjd
                                asdiasd ais jd asidnawjdn ajnda
                                d askjdna sdkjnasd aksjnda skdjnas dkjasnd aksjd
                                asdiasd ais jd asidnawjdn ajnda
                                d askjdna sdkjnasd aksjnda skdjnas dkjasnd aksjd
                                asdiasd ais jd asidnawjdn ajnda d askjdna sdkjnasd aksjnda skdjnas dkjasnd aksjd
                                nas dkjasnd aksjd
                                asdiasd ais jd asidnawjdn ajndada skdjnas dkjasnd aksjd
                                asdiasd ais jd asidnawjdn ajnda
                                d askjdna sdkjnasd aksjnda skdjnas dkjasnd aksjd
                                asdiasd ais jd asidnawjdn ajnda d askjdna sdkjnasd aksjnda skdjnas dkjasnd aksjd
                                nas dkjasnd aksjd
                                asdiasd ais jd asidnawjdn ajndada skdjnas dkjasnd aksjd
                                asdiasd ais jd asidnawjdn ajnda
                                d askjdna sdkjnasd aksjnda skdjnas dkjasnd aksjd
                                asdiasd ais jd asidnawjdn ajnda d askjdna sdkjnasd aksjnda skdjnas dkjasnd aksjd
                                nas dkjasnd aksjd
                                asdiasd ais jd a
                                asdiasd ais jd a
                                sjknda sdkjsnd akjsnda skdjnsd aksjdnaoisd kjnaksnd kajs
                            </p>
                        </div>
                    </div>


                    <div class = "comment_input">
                        <form action="" method="post">
                            <input type="text" class="comment_input_content" name="title" placeholder="Type Your comment here..."
                                   required maxlength="50">
                            <button class="send_comment" name="send_comment" type=submit><i
                                        class="fa-solid fa-paper-plane"></i></button>
                        </form>
                    </div>

                    <div class = "all_comments">
                        <div class = "comment">
                            <div class = "img_user">
                                <img src="weifwe.png" alt="">
                                <h1>username</h1>
                            </div>
                            <div class = "comment_content">
                                <p>qwdkqj wndqwdnk qwdklqwdkqjwndq  wdnkqwdklqwdkq jwndqwdnk  qwdklq wd kqjwndqwd nkqw dklqwdk qjwndqw dnkqwdkl
                                    qwdkqj wndq wdn kqwd
                                    qwdkqjw ndqw dnkqwdkl
                                    qwdkqj wndqwdnk qwdklqwdkqjwndq  wdnkqwdklqwdkq jwndqwdnk  qwdklq wd kqjwndqwd nkqw dklqwdk qjwndqw dnkqwdkl
                                    qwdkqj wndq wdn kqwddklqwdkqjwndq  wdnkqwdklqwdkq jwndqwdnk  qwdklq wd kqjwndqwd nkqw dklqwdk qjwndqw dnkqwdkl
                                    qwdkqj wndq wdn kqwd
                                    qwdkqjw ndqw dnkqwdkl
                            </div>
                        </div>
                        <div class = "comment">
                            <div class = "img_user">
                                <img src="weifwe.png" alt="">
                                <h1>username</h1>
                            </div>
                            <div class = "comment_content">
                                <p>qwdkqj wndqwdnk qwdklqwdkqjwndq  wdnkqwdklqwdkq jwndqwdnk  qwdklq wd kqjwndqwd nkqw dklqwdk qjwndqw dnkqwdkl
                                    qwdkqj wndq wdn kqwd
                                    qwdkqjw ndqw dnkqwdkl
                                    qwdkqj wndqwdnk qwdklqwdkqjwndq  wdnkqwdklqwdkq jwndqwdnk  qwdklq wd kqjwndqwd nkqw dklqwdk qjwndqw dnkqwdkl
                                    qwdkqj wndq wdn kqwddklqwdkqjwndq  wdnkqwdklqwdkq jwndqwdnk  qwdklq wd kqjwndqwd nkqw dklqwdk qjwndqw dnkqwdkl
                                    qwdkqj wndq wdn kqwd
                                    qwdkqjw ndqw dnkqwdkl
                            </div>
                        </div>
                        <div class = "comment">
                            <div class = "img_user">
                                <img src="weifwe.png" alt="">
                                <h1>username</h1>
                            </div>
                            <div class = "comment_content">
                                <p>qwdkqj wndqwdnk qwdklqwdkqjwndq  wdnkqwdklqwdkq jwndqwdnk  qwdklq wd kqjwndqwd nkqw dklqwdk qjwndqw dnkqwdkl
                                    qwdkqj wndq wdn kqwd
                                    qwdkqjw ndqw dnkqwdkl
                                    qwdkqj wndqwdnk qwdklqwdkqjwndq  wdnkqwdklqwdkq jwndqwdnk  qwdklq wd kqjwndqwd nkqw dklqwdk qjwndqw dnkqwdkl
                                    qwdkqj wndq wdn kqwddklqwdkqjwndq  wdnkqwdklqwdkq jwndqwdnk  qwdklq wd kqjwndqwd nkqw dklqwdk qjwndqw dnkqwdkl
                                    qwdkqj wndq wdn kqwd
                                    qwdkqjw ndqw dnkqwdkl
                            </div>
                        </div>

                        <div class = "comment">
                            <div class = "img_user">
                                <img src="weifwe.png" alt="">
                                <h1>username</h1>
                            </div>
                            <div class = "comment_content">
                                <p>qwdkqj wndqwdnk qwdklqwdkqjwndq  wdnkqwdklqwdkq jwndqwdnk  qwdklq wd kqjwndqwd nkqw dklqwdk qjwndqw dnkqwdkl
                                    qwdkqj wndq wdn kqwd
                                    qwdkqjw ndqw dnkqwdkl
                                    qwdkqj wndqwdnk qwdklqwdkqjwndq  wdnkqwdklqwdkq jwndqwdnk  qwdklq wd kqjwndqwd nkqw dklqwdk qjwndqw dnkqwdkl
                                    qwdkqj wndq wdn kqwddklqwdkqjwndq  wdnkqwdklqwdkq jwndqwdnk  qwdklq wd kqjwndqwd nkqw dklqwdk qjwndqw dnkqwdkl
                                    qwdkqj wndq wdn kqwd
                                    qwdkqjw ndqw dnkqwdkl
                            </div>
                        </div>

                        <div class = "comment">
                            <div class = "img_user">
                                <img src="weifwe.png" alt="">
                                <h1>username</h1>
                            </div>
                            <div class = "comment_content">
                                <p>qwdkqj wndqwdnk qwdklqwdkqjwndq  wdnkqwdklqwdkq jwndqwdnk  qwdklq wd kqjwndqwd nkqw dklqwdk qjwndqw dnkqwdkl
                                    qwdkqj wndq wdn kqwd
                                    qwdkqjw ndqw dnkqwdkl
                                    qwdkqj wndqwdnk qwdklqwdkqjwndq  wdnkqwdklqwdkq jwndqwdnk  qwdklq wd kqjwndqwd nkqw dklqwdk qjwndqw dnkqwdkl
                                    qwdkqj wndq wdn kqwddklqwdkqjwndq  wdnkqwdklqwdkq jwndqwdnk  qwdklq wd kqjwndqwd nkqw dklqwdk qjwndqw dnkqwdkl
                                    qwdkqj wndq wdn kqwd
                                    qwdkqjw ndqw dnkqwdkl
                            </div>
                        </div>
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
if (isset($_POST["send_post"])) {
    if (!$_SESSION["isLogin"]) {
        echo "<script>alert('You are not logged in!');window.location.href='index.php';</script>";
        exit;
    } else {
        $feed = post_submit($_SESSION["userid"], $_POST["title"], $_POST["input_post"], $_POST["category"]);
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
