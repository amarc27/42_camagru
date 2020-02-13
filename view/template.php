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
</head>
<body>
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
                        echo "<a href=\"$account_link\"><p>Account</p></a>";
                        echo "<a href=\"logout.php?action=out\"><p>Logout</p></a>";
                        echo "<a href=\"$camera_link\"><p>Camera</p></a>";
                    }

                    else
                    {
                        echo "<a href=\"$signup_link\"><p>Signup</p></a>";
                        echo "<a href=\"$login_link\"><p>Login</p></a>";
                    }
                ?>
                </div>
            </nav>
    </div>
    
    <?= $content ?>

    <footer>
        <p>Camagru 2020 | Made by amarc</p>
    </footer>
</body>
</html>