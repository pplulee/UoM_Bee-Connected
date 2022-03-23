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
        <script src="https://kit.fontawesome.com/44dce3cb72.js" crossorigin="anonymous"></script>
        <script src="resources/js/read_more.js"></script>
    </head>
    <link rel="stylesheet" href="resources/css/index.css">

    <div class="main">
        <div class = "container-fluid">
        <div class="row">
            <div class="col categories">
                <h2>Categories</h2>
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
                            $result = mysqli_query($conn, "SELECT * FROM post WHERE hide ='0' ORDER BY pid asc;");
                            while ($row = mysqli_fetch_assoc($result)) {
                                $userid = $row["author"];
                                $username = get_name_by_id($userid);
                                $userpic = getprofilepic($userid);
                                echo "
                               
                                    <div class='main_post' id='main_post'>
                                        <div class = 'img_name_report' id = 'img_name_report'>
                                            <img src='$userpic'>
                                            <h1>$username</h1>
                                            <button>
                                                <p class = 'text_1'>!</p>
                                                <p class = 'text_2'>Report</p>
                                            </button>
                                        </div>
                                        <div class = 'post_content' >
                                            <h1>[{$row["category"]}]{$row["title"]}</h1>
                                            <p id = 'post_content_p'>{$row["content"]}</p>
                                            <button onclick='read_more()' id='readmore()'>Read more</button>
                                        </div>
                                    </div>
                                ";
                            }
                    ?>
                </div>
                <div class="input_area">
                    <form action="" name="categories" method="post">
                        <div class="input_text">
                            <input type="text" class="post_title" name="title" placeholder="Your title goes here"
                                   required>
                            <textarea name="input_post" id="post_self" cols="80" rows=4
                                      placeholder="What's on Your mind?" required></textarea>
                        </div>
                        <div class="choose_submit">
                            <select id="post_category" name="catlist" form="categories">
                                <?php
                                $result = mysqli_query($conn, "SELECT name FROM category WHERE enable='1';");
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='{$row['name']}'>{$row['name']}</option>";
                                    }
                                }
                                ?>
                            </select>
                            <input type="hidden" id="select_content" name="select_content"/>
                            <button class="send_post" name="send_post" type=submit><i
                                        class="fa-solid fa-paper-plane"></i></button>
                            <button class="send_post" name="send_post" type=submit><i class="fa-solid fa-paperclip"></i></button>

                        </div>
                    </form>
                </div>
            </div>

            <div class="col trending">
                <h2>Trending</h2>
            </div>

        </div>
    </div>
<?php
if (isset($_POST["send_post"])) {
    $feed = post_submit($_SESSION["userid"], $_POST["title"], $_POST["input_post"], $_POST["select_content"]);
    echo "<script>alert('{$feed[1]}');window.location.href='./index.php';</script>";
}
