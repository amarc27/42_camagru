<?php
    print_r($_POST);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <textarea name="comment" placeholder="Write a comment" required autofocus ></textarea>
        <input type="hidden" name="id_com" value='31'>
        <input id='31' type="submit" name="submit-comment" value="Add comment">
    </form>
</body>
</html>