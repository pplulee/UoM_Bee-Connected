<?php
include "header.php";
if (isset($_GET["action"])) {
    switch ($_GET["action"]) {
        case "delete":
        {
            if (!$_SESSION["isLogin"]) {
                echo "<script>alert('You are not logged in!');window.location.href='index.php';</script>";
                exit;
            } else if (!isset($_GET["type"]) || !isset($_GET["id"]) || $_GET["id"] == "" || !is_numeric($_GET["id"])) {
                echo "<script>alert('Invalid operation');window.location.href='index.php';</script>";
                exit;
            } else {
                switch ($_GET["type"]) {
                    case "post":
                    {
                        $feed = post_delete($_GET["id"], $_SESSION["userid"]);
                        echo "<script>alert('{$feed[1]}');window.location.href='index.php';</script>";
                        break;
                    }
                    case "comment":
                    {
                        $feed = comment_delete($_GET["id"], $_SESSION["userid"]);
                        echo "<script>alert('{$feed[1]}');window.location.href='index.php';</script>";
                        break;
                    }
                    default:
                    {
                        echo "<script>alert('Invalid operation');window.location.href='index.php';</script>";
                        exit;
                    }
                }

            }
            break;
        }
        case "logout":
        {
            logout();
            break;
        }
        case "post_submit":
        {
            if (!$_SESSION["isLogin"]) {
                echo "<script>alert('You are not logged in!');window.location.href='index.php';</script>";
                exit;
            } else {
                if ((file_exists($_FILES["post_pic"]["tmp_name"])) or (is_uploaded_file($_FILES["post_pic"]["tmp_name"]))) {
                    # have image
                    if (check_image_valid($_FILES["post_pic"], 10240000)) {
                        if ($_FILES["post_pic"]["error"] > 0) {
                            echo "Upload Error:" . $_FILES["post_pic"]["error"] . "<br>";
                        } else {
                            $temp = explode(".", $_FILES["post_pic"]["name"]);
                            $extension = end($temp);
                            $filename = substr(md5(time()), 5, 32) . "." . $extension;
                            upload_image($_FILES["post_pic"]["tmp_name"], "data/image_post/", "{$filename}");
                            $feed = post_submit($_SESSION["userid"], $_POST["title"], $_POST["input_post"], $_POST["category"], $filename);
                        }
                    }
                } else {
                    # no image
                    $feed = post_submit($_SESSION["userid"], $_POST["title"], $_POST["input_post"], $_POST["category"]);
                }
                echo "<script>alert('{$feed[1]}');window.location.href='index.php';</script>";
            }
            break;
        }
        case "comment_submit":
        {
            if (!$_SESSION["isLogin"]) {
                echo "<script>alert('You are not logged in!');window.location.href='index.php';</script>";
                exit;
            } else {
                $feed = reply($_POST["pid"], $_POST["comment"]);
                echo "<script>alert('{$feed[1]}');window.location.href='post.php?pid={$_POST["pid"]}';</script>";
            }
            break;
        }
        case "report_submit":
        {
            if (!$_SESSION["isLogin"]) {
                echo "<script>alert('You are not logged in!');window.location.href='index.php';</script>";
            } else {
                $feed = post_report($_SESSION["userid"], $_POST["type"], $_POST["id"], $_POST["report_reason"]);
                if ($feed[0] == "success") {
                    echo "<script>alert('Report sent successfully!');window.location.href='index.php';</script>";
                } else {
                    echo "<script>alert('{$feed[1]}');window.location.href='index.php';</script>";
                }
            }
            break;
        }
        default:
        {
            echo "<script>alert('Invalid operation');window.location.href='index.php';</script>";
            exit;
        }
    }
}
echo "<script>window.location.href='index.php';</script>";
