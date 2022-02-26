<html>
<head>
<link rel="stylesheet" href="resources/css/user-style.css">
<?php include("header.php") ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>
    <div class = "main">
        <div class="row">
            <div class="col-5">

                <img class = "user_img" src="<!-- php goes here -->" alt="">


            </div>
            <div class="col-7">

                <form action="" method="post">
                    
                    <div class="user-box">
                        <input type="text" name="username">
                        <label>Username</label>
                    </div>

                    <div class="user-box">
                        <input type="password" name="password">
                        <label>Password</label>
                    </div>
                    <div class="user-box">
                        <input type="text" name="motto">
                        <label>Motto</label>
                    </div>
                    <button name="save"  id="save" type="submit">SAVE
                    </button>
                    <button name="update" id="update" type="submit">UPDATE
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>