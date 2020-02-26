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
                        echo "<a href=\"$camera_link\"><p>Camera</p></a>";
                        echo "<a href=\"$account_link\"><p>Account</p></a>";
                        echo "<a href=\"logout.php?action=out\"><p>Logout</p></a>";
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
        <p style="font-weight:bold; color: #DA2C38; text-align: center"><?= $error ?></p>
        <div class="pagination">
            <?php
                if ($page > 1)
                    echo "<a href='?page=".($page - 1)."'>Page précédente</a>";
                if ($page < $page_number)
                    echo "<a href='?page=".($page + 1)."'>Page suivante</a>";
            ?>
        </div>
        <article id="gallery">
            <?php
                while($pic = $all_pics->fetch()) {
                    echo "<div class='image-area'>";
                        echo "<a href='comment.php?action=comment&id=".$pic['id_img']."'><img src='".$pic['img']."' alt=''></a>";
                        echo "</br><a href=index.php?action=likeUp&id=".($pic['id_img']).">Like : ". count_like($pic['id_img']) ."</a>";
                        echo "<a href=''> | Comment</a>";
                        echo " | id : ".$pic['id_img'];
                    echo "</div>";
                }
            ?>
        </article>
    </section>
    <footer>
        <p>Camagru 2020 | Made by amarc</p>
    </footer>
</body>
</html>