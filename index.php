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

                <div class="posts">

                    <div class = "main_post" id = "main_post">

                       <div class = "img_name_report" id = "img_name_report">
                           <img src="" alt="">
                           <h1>Username</h1>
                           <button>
                               <p class = "text_1">!</p>
                               <p class = "text_2">Report</p>
                           </button>
                       </div>

                        <div class = "post_content" >
                            <h1> Category: Some title here</h1>
                            <p id = "post_content_p">Lorem Ipsum is simply dummy text of
                                the printing and typesetting industry.
                                Lorem Ipsum has been the industry's standard
                                dummy text ever since the 1500s, when an unknown
                                printer took a galley of type and scrambled it to
                                make a type specimen book. It has survived not only
                                five centuries, but also the leap into electronic
                                typesetting, remaining essentially unchanged. It was
                                popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with deskLorem Ipsum is simply dummy text of
                                the printing and typeaset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                            </p>

                            <button onclick="read_more()" id="readmore()">Read more</button>
                            <script>
                                let post_content = document.getElementById("post_content_p");
                                let main_post = document.getElementById("main_post");
                                let read_more_btn = document.getElementById("readmore");
                                let img_name_report = document.getElementById("img_name_report");
                                let count = 0;
                                function read_more(){
                                    if ((count%2)===0) {
                                        main_post.style.height = "100%";
                                        main_post.style.overflow = "auto";
                                        main_post.style.overflowX = "hidden";
                                        post_content.style.overflow = "visible";
                                        post_content.style.display = "unset";
                                        img_name_report.style.height = "100%";
                                        count += 1;
                                    }
                                    else{
                                        main_post.style.height = "33.3%";
                                        main_post.style.minHeight = "0%";
                                        main_post.style.overflow = "hidden";
                                        post_content.style.overflow = "hidden";
                                        post_content.style.display = "-webkit-box";
                                        post_content.style.WebkitLineClamp = "4";
                                        post_content.style.WebkitBoxOrient = "vertical";
                                        img_name_report.style.height = "87%";
                                        count += 1;
                                    }
                                }


                            </script>
                        </div>

                    </div>

                </div>

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
