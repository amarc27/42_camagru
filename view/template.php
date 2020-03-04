<?php
    $srcDIR = "http://".$_SERVER['HTTP_HOST']."/camagru";
    $account_link = $srcDIR."/account.php";
    $signup_link = $srcDIR."/signup.php";
    $login_link = $srcDIR."/login.php";
    $logout_link = $srcDIR."/logout.php";
    $camera_link = $srcDIR."/camera.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="./public/css/style.css">
    <link rel="shortcut icon" href="./public/images/insta.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div class="loader"></div>
    <div id='gradient-line'></div>
    <div id="navbar">
            <nav>
                <div class="logo">
                    <img src="./public/images/insta-logo.svg" class="img-logo" alt="Logo">
                    <hr>
                    <p id="text-logo"><a href=<?php echo $srcDIR."/index.php" ?>>Camagru</a></p>
                </div>
                <div class="log-btns">
                <?php
                    if (!empty($_SESSION['login']))
                    {
                        echo "<a href=\"$camera_link\"><img class='nav-btn' src='public/images/camera2.png' alt='Camera button'></a>";
                        echo "<a href=\"$account_link\"><img class='nav-btn' class='profile-pic' src='public/images/account.png' alt='Account button'></a>";
                        echo "<a href=\"logout.php?action=out\"><img class='nav-btn' src='public/images/logout.png' alt='Logout button'></a>";
                    }

                    else
                    {
                        echo "<a href=\"$signup_link\"><img class='nav-btn' src='public/images/signup.png' alt='Signup button'></a>";
                        echo "<a href=\"$login_link\"><img class='nav-btn' src='public/images/login.png' alt='Login button'></a>";
                    }
                ?>
                </div>
            </nav>
    </div>
    
    <?= $content ?>

    <!-- <footer>
        <p>Camagru 2020 | Made by amarc & cecourt</p>
    </footer> -->
    <script type='text/javascript' src="public/js/loader.js"></script>
</body>
</html>