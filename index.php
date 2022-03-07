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
<link rel="stylesheet" href="resources/css/index.css">
<div class="category">
    <h2>Category</h2>
    <div class="tab">
        <button class="tablinks" onclick="openCity(event,'Exercise')">Exercise</button>
        <button class="tablinks" onclick="openCity(event, 'Fashion')">Fashion</button>
        <button class="tablinks" onclick="openCity(event,'Food')">Food</button>
        <button class="tablinks" onclick="openCity(event,'Shopping')" id="defaultOpen">Shopping</button>
        <button class="tablinks" onclick="openCity(event,'Study')" id="defaultOpen">Study</button>
        <button class="tablinks" onclick="openCity(event,'Travel')" id="defaultOpen">Travel</button>
    </div>

    <div id="Exercise" class="tabcontent">
        <h2>Exercise</h2>
        <p> ......</p>
    </div>


    <div id="Fashion" class="tabcontent">
        <h2>Fashion</h2>
        <p>......</p>
    </div>

    <div id="Food" class="tabcontent">
        <h2>Food</h2>
        <p>......</p>
    </div>

    <div id="Shopping" class="tabcontent">
        <h2>Shopping</h2>
        <p>......</p>
    </div>

    <div id="Study" class="tabcontent">
        <h2>Study</h2>
        <p>......</p>
    </div>

    <div id="Travel" class="tabcontent">
        <h2>Travel</h2>
        <p>......</p>
    </div>


    <script>
        function openCity(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        document.getElementById("defaultOpen").click();
    </script>

</div>
</div>
<div class="trending">
    <p class="trending">Trending</p>
</div>
<div class="content">
</div>
<div class="sendingPost">
    <div class="row">
        <div class="col-25">
            <label for="country">Categories</label>
        </div>
        <div class="col-75">
            <select id="country" name="country">
                <!--<option value="Exercise">Exercise</option>
                <option value="Fashion">Fashion</option>
                <option value="Food">Food</option>
                <option value="Shopping">Shopping</option>
                <option value="Study">Study</option>
                <option value="Travel">Travel</option>!-->
                <?php

                $result = mysqli_query($conn, "SELECT name FROM category WHERE enable='1';");
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$row['name']}'>{$row['name']}</option>";
                    }
                }
                ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-25">
            <label for="subject">Post</label>
        </div>
        <div class="col-75">
            <textarea id="subject" name="subject" placeholder="Write your post" style="height:80px"></textarea>
        </div>
    </div>
    <div class="row">
        <input type="submit" value="Submit" style="width:100px">
    </div>
</div>

