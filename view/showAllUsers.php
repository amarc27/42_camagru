<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Camagru</title>
</head>
<body>
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
</body>
</html>