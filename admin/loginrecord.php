<?php
include("header.php");
?>

<div class="container" style="padding-top:70px;">
    <div class="col-md-12 center-block" style="float: none;">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Record ID</th>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>IP</th>
                    <th>Time</th>
                    <th>Status</th>
                </tr>
                </thead>
                <?php

                $result = mysqli_query($conn, "SELECT user.userid,user.username,user_login.id,user_login.ip,user_login.datetime,user_login.type FROM user, user_login WHERE user.userid=user_login.userid;");
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr><th>{$row['id']}</th><td>{$row['userid']}</td><td>{$row['username']}</td><td>{$row['ip']}</td><td>{$row['datetime']}</td><td>{$row['type']}</td></tr>";
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>

