<?php
    $srcDIR = "http://".$_SERVER['HTTP_HOST']."/camagru";
    $account_link = $srcDIR."/account.php";
    $signup_link = $srcDIR."/signup.php";
    $login_link = $srcDIR."/login.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Camagru</title>
    <link rel="stylesheet" href="./public/css/style.css">
    <link rel="shortcut icon" href="./public/images/insta.ico" type="image/x-icon">
</head>
<body>
    <?php print_r($_SESSION); ?>
    <div id="navbar">
            <nav>
                <div class="logo">
                    <img src="./public/images/iconmonstr-instagram-11.svg" class="img-logo" alt="Logo">
                    <hr>
                    <p id="text-logo"><a href=<?php echo $srcDIR."/index.php" ?>>Camagru</a></p>
                </div>
                <div class="search-bar">
                    <input type="text" placeholder="Rechercher">
                </div>
                <div class="log-btns">
                <?php
                if ($_SESSION['logged_in'] == true)
                {
                    echo "<a href=\"$account_link\"><p>Account</p></a>";
                    echo "<a href=\"javascript:void(0)\" onClick=\"logout()\"><p>Logout</p></a>";
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
    <script src="./public/js/logout.js"></script>
</body>
</html>