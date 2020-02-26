<?php ob_start(); ?>

<section id="content">
    <p style="font-weight:bold; color: #DA2C38; text-align: center"><?= $error ?></p>
    <?php
        if (isset($img_src) && isset($nb_like))
        {
        ?>
            <img src="<?=$img_src?>" alt="assembly_photo">
            <div class="picture_infos">
            <p>Likes: <?=$nb_like?></p>
            <form class="subscription-form" action="" method="post">
                <textarea name="comment" id="" cols="30" rows="10"></textarea>
                <input type="submit" name="submit-comment" value="Add comment">
            </form>
        </div>
    <?php 
        }
    ?>
</section>

<?php
    $content = ob_get_clean();
    $title = "Comment photo &#8226; Camagru";
    require('view/template.php');
?>