<?php
include ("header.php");
?>

<div class="container" style="padding-top:70px;">
    <div class="col-md-12 center-block" style="float: none;">
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>User ID</th><th>Username</th><th>Bio</th><th>Permission</th><th>Manage</th></tr></thead>
<?php

$result = mysqli_query($conn,"SELECT userid,username,bio,permission FROM user;");
if (mysqli_num_rows($result)>0){
    while ($row = mysqli_fetch_assoc($result)){
        echo "<tr><th>{$row['userid']}</th><td>{$row['username']}</td><td>{$row['bio']}</td><td>{$row['permission']}</td><td><a href='edituser.php?action=edit&id={$row['userid']}' class='btn btn-primary'>Edit</a></td>";
    }
}
?>
        </table>
      </div>
    </div>
</div>

