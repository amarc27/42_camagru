<?php
    session_start();
    if ($_POST["product_name"] && $_POST["image_url"] && $_POST["prix"] &&
    $_POST["cat_polaire"] && $_POST["cat_tshirt"] && $_POST["cat_baselayer"] && $_POST["submit"] && $_POST["submit"] === "OK")
    {
        $content = file_get_contents("../db/products");
        $products = unserialize($content);
        $flag = 0;
        if ($products !== false)
        {
            foreach ($products as $key => $value)
            {
                if ($value["id"] === $_POST["id"])
                    $flag = 1;
            }
        }
        if ($flag)
        {
            echo "<script type='text/javascript'>alert('Erreur lors de la creation du produit');</script>";
            echo "<script>window.location.href = './create-product.html';</script>";
            exit();
        }
        else
        {
            $product["product_name"] = $_POST["product_name"];
            $product["id"] = random_int(0, 100);
            $product["image_url"] = $_POST["image_url"];
            $product["prix"] = $_POST["prix"];
            $product["cat_polaire"] = $_POST["cat_polaire"];
            $product["cat_tshirt"] = $_POST["cat_tshirt"];
            $product["cat_baselayer"] = $_POST["cat_baselayer"];
            $products[] = $product;
            file_put_contents("../db/products", serialize($products));
            echo "<script type='text/javascript'>alert('Product successfully created');</script>";
            echo "<script>window.location.href = './admin.html';</script>";
            exit();
        }
    }
    else
        echo "ERROR\n";
?>
