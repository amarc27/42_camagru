<?php
	if ($_POST['old_product_name'] && $_POST['new_image_url'] && $_POST['new_prix'] && $_POST['new_cat_polaire'] &&
	$_POST['new_cat_tshirt'] && $_POST['new_cat_baselayer'] && $_POST['submit'] && $_POST['submit'] === "OK")
    {
        $content = file_get_contents('../db/products');
		$products = unserialize($content);
        if ($products !== false)
        {
			$flag = 0;
            foreach ($products as $key => $val)
            {
				if ($val['product_name'] === $_POST['old_product_name'])
                {
                    $flag = 1;
					$products[$key]['image_url'] = $_POST['new_image_url'];
					$products[$key]['prix'] = $_POST['new_prix'];
					$products[$key]['cat_polaire'] = $_POST['new_cat_polaire'];
					$products[$key]['cat_tshirt'] = $_POST['new_cat_tshirt'];
					$products[$key]['cat_baselayer'] = $_POST['new_cat_baselayer'];
                }
            }
            if ($flag)
            {
                file_put_contents('../db/products', serialize($products));
                echo "<script type='text/javascript'>alert('Product successfully updated');</script>";
                echo "<script>window.location.href = '../index.php';</script>";
                exit();
            }
            else
            {
                echo "<script type='text/javascript'>alert('Produit introuvable 1');</script>";
                echo "<script>window.location.href = './modify-product.html';</script>";
                exit();
            }
        }
        else
        {
            echo "<script type='text/javascript'>alert('Produit introuvable 2');</script>";
            echo "<script>window.location.href = './modify_product.html';</script>";
            exit();
        }
    }
    else
    {
        echo "<script type='text/javascript'>alert('Produit introuvable 3');</script>";
        echo "<script>window.location.href = './modify_product.html';</script>";
        exit();
    }
?>