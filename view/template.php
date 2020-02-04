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
                    <img src="./public/images/iconmonstr-instagram-11.svg" class="img-logo" alt="Logo">
                    <hr>
                    <p id="text-logo">Camagru</p>
                </div>
                <div class="search-bar">
                    <input type="text" placeholder="Rechercher">
                </div>
                <div class="log-btns">
                    <a href="http://localhost:8080/camagru/view/login.php"><p>Log in</p></a>
                    <a href="http://localhost:8080/camagru/subscription.php"><p>Sign up</p></a>
                </div>
            </nav>
    </div>
    
    <?= $content ?>

    <footer>
        <p>Camagru 2020 | Made by amarc</p>
    </footer>
</body>
</html>