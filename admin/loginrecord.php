<?php
include("header.php");
?>
<title>Login Record</title>
<div class="container" style="padding-top:70px;">
    <div class="col-md-12 center-block" style="float: none;">
        <div class="table-responsive">
            <div class="alert alert-success" role="alert">
                Only the last 25 logins will be displayed.
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Record ID</th>
                    <th scope="col">User ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">IP</th>
                    <th scope="col">Time</th>
                    <th scope="col">Status</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $result = mysqli_query($conn, "SELECT user.userid,user.username,user_login.id,user_login.ip,user_login.datetime,user_login.type FROM user, user_login WHERE user.userid=user_login.userid ORDER BY user_login.id desc LIMIT 25;");
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr><th scope='row'>{$row['id']}</th><td>{$row['userid']}</td><td>{$row['username']}</td><td>{$row['ip']}</td><td>{$row['datetime']}</td><td>{$row['type']}</td></tr>";
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

