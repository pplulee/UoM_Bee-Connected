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
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&family=Montserrat:wght@100&display=swap"
              rel="stylesheet">
        <script src="https://kit.fontawesome.com/44dce3cb72.js" crossorigin="anonymous"></script>
    </head>
    <link rel="stylesheet" href="resources/css/index.css">

    <div class="main">
        <div class = "container-fluid">
        <div class="row">

            <div class="col categories">
                <h2>Categories</h2>
                <ul class="menu-hover-fill flex flex-col items-start leading-none text-2xl uppercase space-y-4">
                    <a>
                        <li class="tablinks" onclick="openCity(event,'Exercise')"><i
                                    class="fa-regular fa-graduation-cap"></i> Study
                        </li>
                    </a>
                    <a>
                        <li class="tablinks" onclick="openCity(event, 'Fashion')"><i class="fa-solid fa-burger"></i>
                            Food
                        </li>
                    </a>
                    <a>
                        <li class="tablinks" onclick="openCity(event,'Food')"><i
                                    class="fa-solid fa-basket-shopping"></i>
                            Shopping
                        </li>
                    </a>
                    <a>
                        <li class="tablinks" onclick="openCity(event,'Shopping')" id="defaultOpen"><i
                                    class="fa-solid fa-shirt"></i> Fashion
                        </li>
                    </a>
                    <a>
                        <li class="tablinks" onclick="openCity(event,'Study')" id="defaultOpen"><i
                                    class="fa-solid fa-futbol"></i> Sports
                        </li>
                    </a>
                    <a>
                        <li class="tablinks" onclick="openCity(event,'Travel')" id="defaultOpen"><i
                                    class="fa-solid fa-compass"></i> Travel
                        </li>
                    </a>

                </ul>
            </div>

            <div class="col-8 content">
                <div class="posts"></div>
                <div class="input_area">
                    <form action="" name="categories" method="post">
                        <div class="input_text">
                            <input type="text" class = "post_title" name="title" placeholder="Your title goes here" required>
                            <textarea name="input_post" id="post_self" cols="80" rows=4
                                      placeholder="What's on Your mind?" required></textarea>
                        </div>
                        <div class="choose_submit">
                            <select id="post_category" name="catlist" form="categories">
                                <?php
                                $result = mysqli_query($conn, "SELECT name FROM category WHERE enable='1';");
                                echo mysqli_num_rows($result);
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
