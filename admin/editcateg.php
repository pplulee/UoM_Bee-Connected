<?php
include("header.php");

if (!isset($_GET["id"]) || !isset($_GET["action"])) {
    echo '<div class="alert alert-danger" role="alert"><p>Wrong parameters</p></div>';
    echo "<script>setTimeout(\"javascript:location.href='category.php'\", 500);</script>";
    exit;
}

switch ($_GET["action"]) {
    case "delete":
        if ((mysqli_num_rows(mysqli_query($conn, "SELECT id FROM category WHERE id='{$_GET['id']}';")) == 0)) {
            echo "<div class='alert alert-danger' role='alert'>Category not exist</div>";
            exit;
        } else {
            mysqli_query($conn, "DELETE FROM category WHERE id='{$_GET['id']}'");
            echo "<script>setTimeout(\"javascript:location.href='category.php'\", 0);</script>";
        }
        break;
    case "edit":
        $result = mysqli_query($conn, "SELECT * FROM category WHERE id='{$_GET['id']}';");
        if (mysqli_num_rows($result) == 0) {
            echo '<div class="alert alert-danger" role="alert"><p>Category not found</p></div>';
            echo "<script>setTimeout(\"javascript:location.href='category.php'\", 500);</script>";
            exit;
        }
        $result = mysqli_fetch_assoc($result);
        echo "
        <form action='' method='post'>
            <div class='row'>
                <div class='col'>
                    <label>ID</label><br>
                    <input type='text' class='form-control' name='id' value='{$result['id']}' readonly>
                </div>
                <div class='col'>
                    <label>Name</label><br>
                    <input type='text' class='form-control' name='name' value='{$result['name']}' required>
                </div>
            </div>
            <div class='form-group'>
                <label>Icon</label><br>
                <input type='text' class='form-control' name='icon' value='{$result['icon']}' required>
                <label>Enable</label><br>
                <input type='text' class='form-control' name='enable' value='{$result['enable']}' required>
            </div>
            <input type='submit' name='submit' class='btn btn-primary btn-block' value='Save'>
        </form>";
        break;
    default:
        echo '<div class="alert alert-danger" role="alert"><p>Wrong parameters</p></div>';
        echo "<script>setTimeout(\"javascript:location.href='category.php'\", 500);</script>";
        exit;

}

if (isset($_POST["submit"])) {
    mysqli_query($conn, "UPDATE category SET name='{$_POST['name']}', enable='{$_POST['enable']}', icon='{$_POST["icon"]}' WHERE id='{$_GET['id']}';");
    echo "<div class='alert alert-success' role='alert'><p>Modified successfully, will return to user list soon</p></div>";
    echo "<script>setTimeout(\"javascript:location.href='category.php'\", 1000);</script>";
    exit;
}
