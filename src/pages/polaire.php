<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../main.css">
    <title>Le pote à Gonia</title>
</head>
<body>
    <nav class="header">
        <a href="../index.php"><h1 class="logo">Le pote à Gonia</h1></a>
        <ul class="navbar-right">
            <li><a href="../index.php">Home</a></li>
            <li><a href="./signup.html">Signup</a></li>
            <li><a href="./signin.html">Login</a></li>
            <li><a href="./logout.php">Logout</a></li>
            <li><a href="./modify.html">Modify account</a></li>
        </ul>
    </nav>
    <section class="main-window">
        <div class="categories">
            <h2>Catégories</h2>
            <ul class="categories-list">
                <li><a href="./polaire.php"> 🥋 Polaires </a></li>
                <li><a href="./tshirt.php"> 👕 T-shirts </a></li>
                <li> <a href="./baselayer.php"> 👚 Base layers </a></li>
            </ul>
        </div>
        <div class="products">
            <ul class="products-list">
                <?php
                    $content = file_get_contents("../db/products");
                    $products = unserialize($content);
                    foreach ($products as $key => $val)
                    {
                        if ($products[$key]['cat_polaire'] == "oui") {
                            echo '<li>';
                            echo '<img src="'.$products[$key]['image_url'].'">';
                            echo '<p class="product-name">'.$products[$key]['product_name'].'</p>';
                            echo '<p class="product-price">'.$products[$key]['prix'].'€</p>';
                            echo '</li>';
                        }
                    }
                ?>
            </ul>
        </div>
    </section>
    <script src="https://cdn.iconmonstr.com/1.3.0/css/iconmonstr-iconic-font.min.css"></script>
</body>
</html>
