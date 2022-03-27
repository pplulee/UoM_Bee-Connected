<?php
include("header.php");
if (isset($_GET["action"])) {
    if (!isset($_GET["rid"]) or $_GET["rid"] == "") {
        echo "Error: No report ID specified.";
    }
    $type = get_report_type($_GET["rid"]);
    switch ($_GET["action"]) {
        case "ignore":
        {
            switch ($type) {
                case "post":
                {
                    $pid = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM report WHERE reportid={$_GET["rid"]};"))['id'];
                    mysqli_query($conn, "UPDATE report SET solved=1 WHERE type='post' AND reportid='{$_GET["rid"]}' OR id='$pid';");
                    echo "<script>window.location.href='report.php';</script>";
                    break;
                }
                case "comment":
                {
                    $cid = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM report WHERE reportid={$_GET["rid"]};"))['id'];
                    mysqli_query($conn, "UPDATE report SET solved=1 WHERE type='comment' AND reportid='{$_GET["rid"]}' OR id='$cid';");
                    echo "<script>window.location.href='report.php';</script>";
                    break;
                }
            }
            break;
        }
        case "deletepost":
        {
            switch ($type) {
                case "post":
                {
                    $pid = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM report WHERE reportid={$_GET["rid"]}"))['id'];
                    mysqli_query($conn, "UPDATE report SET solved=1 WHERE type='post' AND reportid='{$_GET["rid"]}' OR id='{$pid}';");
                    mysqli_query($conn, "UPDATE post SET hide=1 WHERE pid='$pid';");
                    echo "<script>window.location.href='report.php';</script>";
                    break;
                }
                case "comment":
                {
                    $cid = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM report WHERE reportid={$_GET["rid"]};"))['id'];
                    mysqli_query($conn, "UPDATE report SET solved=1 WHERE type='comment' AND reportid='{$_GET["rid"]}' OR id='{$cid}';");
                    mysqli_query($conn, "UPDATE reply SET visible=0 WHERE rid='$cid';");
                    echo "<script>window.location.href='report.php';</script>";
                    break;
                }
            }
            break;
        }
        case "banuser":
        {
            switch ($type) {
                case "post":
                {
                    $pid = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM report WHERE reportid={$_GET["rid"]};"))['id'];
                    $uid = mysqli_fetch_assoc(mysqli_query($conn, "SELECT author FROM post WHERE pid={$pid};"))['author'];
                    mysqli_query($conn, "UPDATE post SET hide=1 WHERE author='$uid';");
                    mysqli_query($conn, "UPDATE reply SET visible=0 WHERE user='$uid';");
                    mysqli_query($conn, "UPDATE user SET permission=0 WHERE user.userid='$uid';");
                    mysqli_query($conn, "UPDATE report SET solved=1 WHERE type='comment' AND reportid='{$_GET["rid"]}' OR id='{$pid}';");
                    echo "<script>window.location.href='report.php';</script>";
                    break;
                }
                case "comment":
                {
                    $cid = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM report WHERE reportid={$_GET["rid"]};"))['id'];
                    $uid = mysqli_fetch_assoc(mysqli_query($conn, "SELECT userid FROM reply WHERE rid={$cid};"))['userid'];
                    mysqli_query($conn, "UPDATE post SET hide=1 WHERE author='$uid';");
                    mysqli_query($conn, "UPDATE reply SET visible=0 WHERE user='$uid';");
                    mysqli_query($conn, "UPDATE user SET permission=0 WHERE user.userid='$uid';");
                    mysqli_query($conn, "UPDATE report SET solved=1 WHERE type='comment' AND reportid='{$_GET["rid"]}' OR id='{$cid}';");
                }
            }
            break;

        }
        default:
        {
            echo "Error: Invalid action";
            break;
        }
    }
}
?>

<title>Report</title>
<div class="container" style="padding-top:70px;">
    <div class="col-md-12 center-block" style="float: none;">
        <div class="table-responsive">
            <table class="table table-striped">
                <div class="alert alert-warning" role="alert">
                    The operation of report will work on all report with same post ID.<br>
                    Ignore: Mark all report with same post ID as resolved.<br>
                    Delete: Delete all report with same post ID and ignore all same post ID.<br>
                    Ban User: Hide all posts of that user and ban the user.
                </div>
                <thead>
                <tr>
                    <th scope="col">Report ID</th>
                    <th scope="col">Post Title</th>
                    <th scope="col">Post Content</th>
                    <th scope="col">Report reason</th>
                    <th scope="col">Date</th>
                    <th scope="col">Operation</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $result = mysqli_query($conn, "SELECT reportid, type, id, userid, reason, date FROM report WHERE solved=0 ORDER BY reportid desc;");
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        switch ($row["type"]) {
                            case "post":
                            {
                                $result2 = mysqli_query($conn, "SELECT pid, title, content FROM post WHERE pid={$row["id"]} AND hide=0;");
                                $row2 = mysqli_fetch_assoc($result2);
                                if (strlen($row2['title']) > 20) {
                                    $row2['title'] = substr($row2['title'], 0, 20) . "...";
                                }
                                if (strlen($row2['content']) > 50) {
                                    $row2['content'] = substr($row2['content'], 0, 50) . "...";
                                }
                                echo "<tr><td>{$row["reportid"]}</td>";
                                echo "<td><a href='../post.php?pid={$row2["pid"]}'>{$row2["title"]}</a></td>";
                                echo "<td>{$row2["content"]}</td>";
                                echo "<td>{$row["reason"]}</td>";
                                echo "<td>{$row["date"]}</td>";
                                echo "<td><a href='report.php?action=ignore&rid={$row['reportid']}' class='btn btn-success'>Ignore</a> ";
                                echo "<a href='report.php?action=deletepost&rid={$row['reportid']}' class='btn btn-warning'>Delete </a> ";
                                echo "<a href='report.php?action=banuser&rid={$row['reportid']}' class='btn btn-danger'>Ban user</a></td></tr>";
                                break;
                            }
                            case "comment":
                            {
                                $result2 = mysqli_query($conn, "SELECT rid, user_id, content FROM reply WHERE rid={$row["id"]} AND visible=1;");
                                $row2 = mysqli_fetch_assoc($result2);
                                $title = "Comment";
                                if (strlen($row2['content']) > 50) {
                                    $row2['content'] = substr($row2['content'], 0, 50) . "...";
                                }
                                echo "<tr><td>{$row["reportid"]}</td>";
                                echo "<td>{$title}</td>";
                                echo "<td>{$row2["content"]}</td>";
                                echo "<td>{$row["reason"]}</td>";
                                echo "<td>{$row["date"]}</td>";
                                echo "<td><a href='report.php?action=ignore&rid={$row['reportid']}' class='btn btn-success'>Ignore</a> ";
                                echo "<a href='report.php?action=deletepost&rid={$row['reportid']}' class='btn btn-warning'>Delete </a> ";
                                echo "<a href='report.php?action=banuser&rid={$row['reportid']}' class='btn btn-danger'>Ban user</a></td></tr>";
                                break;
                            }
                        }
                    }
                } else {
                    echo "<tr><td colspan='5'>No report</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>