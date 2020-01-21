<?php
    session_start();
    $_SESSION["test"] = "toto";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./main.css">
    <title>Le pote à Gonia</title>
</head>
<body>
    <nav class="header">
        <a href="./index.php"><h1 class="logo">Le pote à Gonia</h1></a>
        <ul class="navbar-right">
            <li><a href="./index.php">Home</a></li>
            <?php
                if ($_SESSION['loggued_on_user'] == "")
                {
                    echo("<li><a href='./pages/signup.html'>Signup</a></li>");
                    echo("<li><a href='./pages/signin.html'>Login</a></li>");
                }
                else
                {
                    echo("<li><a href='./pages/logout.php'>Logout</a></li>");
                    echo("<li><a href='./pages/modify.html'>Modify account</a></li>");
                    echo("<li><a href='./pages/delete-user.php'>Delete account</a></li>");
                }
            ?>
        </ul>
    </nav>
    <section class="main-window">
        <div class="categories">
            <h2>Catégories</h2>
            <ul class="categories-list">
            <li><a href="./pages/polaire.php"> 🥋 Polaires </a></li>
                <li><a href="./pages/tshirt.php"> 👕 T-shirts </a></li>
                <li> <a href="./pages/baselayer.php"> 👚 Base layers </a></li>
            </ul>
        </div>
        <div class="products">
            <ul class="products-list">
                <?php
                    $content = file_get_contents("db/products");
                    $products = unserialize($content);
                        foreach ($products as $key => $val)
                        {
                            echo '<li>';
                            echo '<img src="'.$products[$key]['image_url'].'">';
                            echo '<p class="product-name">'.$products[$key]['product_name'].'</p>';
                            echo '<p class="product-price">'.$products[$key]['prix'].'€</p>';
                            echo '</li>';
                        }
                ?>
            </ul>
        </div>
    </section>
</body>
</html>
