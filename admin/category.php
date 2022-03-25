<?php
include("header.php");
?>
<div class="container" style="padding-top:70px;">
    <div class="col-md-12 center-block" style="float: none;">
        <div class="table-responsive">
            <form action="" method="post">
                <input type="text" name="category_name">
                <button type="submit" name="submit" class="btn btn-success">Add new category</button>
            </form>
            <?php
            if (isset($_POST["submit"])) {
                if ($_POST["category_name"] == null) {
                    echo "<div class='alert alert-danger' role='alert'>Category name can not be empty</div>";
                } else {
                    mysqli_query($conn, "INSERT INTO category (name) VALUES ('{$_POST['category_name']}');");
                }
            } ?>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Category ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Visible</th>
                </tr>
                </thead>
                <tbody>
                <?php

                $result = mysqli_query($conn, "SELECT id,name,enable FROM category;");
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr><th scope='row'>{$row['id']}</th><td>{$row['name']}</td><td>{$row['enable']}</td><td><a href='editcateg.php?action=edit&id={$row['id']}' class='btn btn-primary'>Edit</a> <a href='editcateg.php?action=delete&id={$row['id']}' class='btn btn-danger'>Delete</a></td></tr>";
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


