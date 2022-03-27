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
                                            <mark><a href='post.php?id={$row["pid"]}' style='text-decoration:none; color=none'>{$row["title"]}</a></mark>
                                            <small>{$row["view"]}</small>
                                        </li>";
                    }
                }
                ?>
            </ol>
        </div>
    </div>
</div>