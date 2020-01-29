<?php

require('./backend/database.php');

function getAllUsers()
{
    if (($db = dbConnect()) == false)
    throw new Exception('dbConnectOk');
    elseif (($req = $db->query('SELECT * FROM users WHERE 1')) == false)
    throw new Exception("Here 2");
    return $req;
}

$data = getAllUsers();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Camagru</title>
    <link rel="stylesheet" href="./public/css/style.css">
</head>
<body>
    <section id="navbar">
        <nav>
            <div class="logo">
                <img src="./public/images/iconmonstr-instagram-11.svg" class="img-logo" alt="Logo">
                <hr>
                <p id="text-logo">Camagru</p>
            </div>
            <div class="search-bar">
                <input type="text" placeholder="Rechercher">
            </div>
            <div class="logs-btns">
                <p>Sign in</p>
                <p>Sign up</p>
            </div>
        </nav>
    </section>
    <section>
        <h1>Welcome to the Camagru project !</h1>
        <h4>This is the beginning of a whole new world</h4>
        <ul>
            <?php while($user = $data->fetch())
            {
            ?>
                <p>
                    Pseudo : <?= htmlspecialchars($user["pseudo"]) ?><br>
                    Name : <?= htmlspecialchars($user["name"]) ?><br>
                    Email : <?= htmlspecialchars($user["mail"]) ?><br>
                    Date d'inscription : <?= htmlspecialchars($user["inscription_date"]) ?><br>
                </p>
            <?php
            }
            $data->closeCursor();
            ?>
        </ul>
    </section>
</body>
</html>












DA REAL ONE


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
            <div class="logs-btns">
                <p>Log in</p>
                <p>Sign up</p>
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