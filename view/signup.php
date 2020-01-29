<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Camagru</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <div id="navbar">
            <nav>
                <div class="logo">
                    <a href="../index.php"><img src="../public/images/iconmonstr-instagram-11.svg" class="img-logo" alt="Logo"></a>
                    <hr>
                    <a href="../index.php"><p id="text-logo">Camagru</p></a>
                </div>
                <div class="search-bar">
                    <input type="text" placeholder="Rechercher">
                </div>
                <div class="log-btns">
                    <a href="./frontend/login.php"><p>Log in</p></a>
                    <a href="./frontend/signup.php"><p>Sign up</p></a>
                </div>
            </nav>
    </div>
    <section id="signup-form">
        <form action="../backend/controller.php" method="post">
            <h3>Créer un compte</h3>
            <input type="text" name="login" value="" placeholder="Pseudo" required />
            <br />
            <input type="email" name="login" value="" placeholder="Email" required />
            <br />
            <input type="text" name="login" value="" placeholder="Nom complet" required />
            <br />
            <input type="password" name="passwd" value="" placeholder="Mot de passe" required />
            <br />
            <input type="submit" name="submit" value="OK"/>
        </form>
    </section>
</body>
</html>