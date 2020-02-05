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
                        echo "<a href=\"$logout_link\"><p>Logout</p></a>";
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
    
    <section id="content">
        <article id="photo-section">
            <div id="photo-frame">
                
            </div>
            <div id="sticker-frame">

            </div>
        </article>
        <article id="feed">
        
        </article>
    </section>
    <div class="logs">
        <p><?php print_r($_SESSION); ?></p>
        <p><?php print_r($_COOKIE); ?></p>
    </div>
    <footer>
        <p>Camagru 2020 | Made by amarc</p>
    </footer>
</body>
</html>