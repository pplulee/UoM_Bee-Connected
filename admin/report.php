<?php
include("header.php");
if (isset($_GET["action"])) {
    if (!isset($_GET["rid"]) or $_GET["rid"] == "") {
        echo "Error: No report ID specified.";
    }
    switch ($_GET["action"]) {
        case "ignore":
        {
            $pid = mysqli_fetch_assoc(mysqli_query($conn, "SELECT pid FROM report WHERE reportid={$_GET["rid"]};"))['pid'];
            mysqli_query($conn, "UPDATE report SET solved=1 WHERE reportid='{$_GET["rid"]}' OR pid='$pid';");
            echo "<script>window.location.href='report.php';</script>";
            break;
        }
        case "deletepost":
        {
            $pid = mysqli_fetch_assoc(mysqli_query($conn, "SELECT pid FROM report WHERE reportid={$_GET["rid"]}"))['pid'];
            mysqli_query($conn, "UPDATE report SET solved=1 WHERE reportid='{$_GET["rid"]}' OR pid='$pid';");
            mysqli_query($conn, "UPDATE post SET hide=1 WHERE pid='$pid';");
            echo "<script>window.location.href='report.php';</script>";
            break;
        }
        case "banuser":
        {
            $uid = mysqli_fetch_assoc(mysqli_query($conn, "SELECT report.reportid,report.pid,user.userid,post.author,post.pid FROM report,user,post WHERE report.reportid={$_GET["rid"]} AND report.pid=post.pid AND post.author=user.userid;"))['author'];
            mysqli_query($conn, "UPDATE post SET hide=1 WHERE author='$uid';");
            mysqli_query($conn, "UPDATE user SET permission=0 WHERE user.userid='$uid';");
            $pid = mysqli_fetch_assoc(mysqli_query($conn, "SELECT pid FROM report WHERE reportid={$_GET["rid"]};"))['pid'];
            mysqli_query($conn, "UPDATE report SET solved=1 WHERE reportid='{$_GET["rid"]}' OR pid='$pid';");
            echo "<script>window.location.href='report.php';</script>";
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
                    <th scope="col">Operation</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $result = mysqli_query($conn, "SELECT report.reportid, report.pid, post.pid, post.title, post.content, report.comment FROM report,post WHERE report.pid=post.pid AND solved=0 ORDER BY report.reportid desc;");
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        if (strlen($row['content']) > 50) {
                            $row['content'] = substr($row['content'], 0, 50) . "...";
                        }
                        if (strlen($row['title']) > 20) {
                            $row['title'] = substr($row['title'], 0, 20) . "...";
                        }
                        echo "<tr><th scope='row'>{$row['reportid']}</th><td>{$row['title']}</td><td>{$row['content']}</td><td>{$row['comment']}</td><td><a href='report.php?action=ignore&rid={$row['reportid']}' class='btn btn-success'>Ignore</a> <a href='report.php?action=deletepost&rid={$row['reportid']}' class='btn btn-warning'>Delete Post</a> <a href='report.php?action=banuser&rid={$row['reportid']}' class='btn btn-danger'>Ban user</a></td><tr>";
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