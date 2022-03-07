<?php
include("header.php");
/*if (!$_SESSION["isLogin"]) {
    echo "<div class=\"alert alert-warning\" role=\"alert\"><p>You are not logged in yet\n</p></div>";
    echo "<a href=\"login.php\"><button type=\"button\" class=\"btn btn-primary\">Go to Login</button></a>";
    exit;
} else {
    echo "If you see this message, it means you are logged in\n";
}
if (isset($_GET["logout"])) {
    logout();
}*/
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
        <p> Londonis the capital city of England.</p>
    </div>


    <div id="Fashion" class="tabcontent">
        <h2>Fashion</h2>
        <p>Tokyo is the capital of Japan.</p>
    </div>

    <div id="Food" class="tabcontent">
        <h2>Food</h2>
        <p>Paris is the capital of France.</p>
    </div>

    <div id="Shopping" class="tabcontent">
        <h2>Shopping</h2>
        <p>London is the capital city of England.</p>
    </div>

    <div id="Study" class="tabcontent">
        <h2>Study</h2>
        <p>London is the capital city of England.</p>
    </div>

    <div id="Travel" class="tabcontent">
        <h2>Travel</h2>
        <p>London is the capital city of England.</p>
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
<div class="trending"></div>