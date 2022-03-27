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
