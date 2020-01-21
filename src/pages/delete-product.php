<?php
    $content = file_get_contents("../db/products");
    $products = unserialize($content);
    if ($_POST['product_name'] && $_POST['submit'] && $_POST['submit'] === "OK")
    {
        $flag = 0;
        foreach ($products as $key => $val)
        {

            if ($val["product_name"] == $_POST["product_name"])
            {
                $flag = 1;
                unset($products[$key]);
            }
        }
        if ($flag)
        {
            file_put_contents("../db/products", serialize($products));
            echo "<script type='text/javascript'>alert('Product successfully deleted');</script>";
            echo "<script>window.location.href = '../index.php';</script>";
            exit();
        }
        else
        {
            echo "<script type='text/javascript'>alert('Identifiant incorrect 1');</script>";
            echo "<script>window.location.href = './delete-product.html';</script>";
            exit();
        }
    }
    else
    {
        echo "<script type='text/javascript'>alert('Identifiant incorrect 2');</script>";
        echo "<script>window.location.href = './delete-product.html';</script>";
        exit();
    }
?>