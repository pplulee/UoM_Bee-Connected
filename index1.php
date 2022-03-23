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
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&family=Montserrat:wght@100&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/44dce3cb72.js" crossorigin="anonymous"></script>
</head>
<link rel="stylesheet" href="resources/css/index1.css">

<div class = "main">
    <div = "container">
        <div class = "row">

            <div class =  "col categories">
                <h2>Categories</h2>
                <ul class="menu-hover-fill flex flex-col items-start leading-none text-2xl uppercase space-y-4">
                    <a><li class="tablinks" onclick="openCity(event,'Exercise')"><i class="fa-regular fa-graduation-cap"></i> Study</li></a>
                    <a><li class="tablinks" onclick="openCity(event, 'Fashion')"><i class="fa-solid fa-burger"></i>  Food</li></a>
                    <a><li class="tablinks" onclick="openCity(event,'Food')"><i class="fa-solid fa-basket-shopping"></i> Shopping</li></a>
                    <a><li class="tablinks" onclick="openCity(event,'Shopping')" id="defaultOpen"><i class="fa-solid fa-shirt"></i> Fashion</li></a>
                    <a><li class="tablinks" onclick="openCity(event,'Study')" id="defaultOpen"><i class="fa-solid fa-futbol"></i> Sports</li></a>
                    <a><li class="tablinks" onclick="openCity(event,'Travel')" id="defaultOpen"><i class="fa-solid fa-compass"></i> Travel</li></a>

                </ul>
            </div>

            <div class = "col-8 content">
                <div class = "posts"></div>
                <div class = "input_area">
                        <div class = "input_text">
                            <form action="" name="categories">
                                <textarea name="input_post" id="" cols="80" rows=6 placeholder="What's on Your mind?"></textarea>
                            </form>
                        </div>
                        <div class = "choose_submit">
                            <select id="post_category" name="catlist" form="categories">
                                <option value="Study">Study</option>
                                <option value="Food">Food</option>
                                <option value="Shopping">Shopping</option>
                                <option value="Fashion">Fashion</option>
                                <option value="Sports">Sports</option>
                                <option value="Travel">Travel</option>
                            </select>
                            <button class="send_post" type = submit> <i class="fa-solid fa-paper-plane"></i></button>

                        </div>
                </div>
            </div>

            <div class = "col trending">
                <h2>Trending</h2>
            </div>

        </div>
    </div>
</div>
