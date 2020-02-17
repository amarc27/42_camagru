<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form> 
    <div class="myCam">
        <input type="checkbox" id="photo" name="photo" value="photo">
        <label for="photo">Take Photo</label>
    </div>
    <div class="mySticks">
        <input type="checkbox" id="stick1" name="stick1" value="stick1">
        <img src="public/stickers/42Label.png" />
        <input type="checkbox" id="stick2" name="stick2" value="stick2">
        <img src="public/stickers/42Label.png" />

    </div>
    <div>
        <?php
            echo "<img src='public/tmp/tampon1.png' />"
        ?>
    </div>
    </form>

</body>
</html> 