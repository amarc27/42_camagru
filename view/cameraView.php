<?php ob_start(); ?>

<section id="content">
    <article id="photo-section">
        <div id="photo-frame">
            <h3>Upload pictures</h3>
            <p style="font-weight:bold; text-align: center; color: #DA2C38"><?= $error ?></p>
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="file" name="file">
                <button type="submit" name="submit-upload">Upload your pictures</button>
            </form>
        </div>
        <div id="sticker-frame">
            <p>Stickers</p>
        </div>
    </article>
    <article id="feed">
        <?php 
            while($result = $data->fetch()) {
                echo "<div class='image-area'>";
                    echo "<img src='".$result['img']."' alt=''>";
                    echo "<a class='remove-image' id='".$result['id_img']."' href='camera.php?action=deletePic&id_img=".$result['id_img']."' style='display: inline;'>&#215;</a>";
                echo "</div>";
            }
        ?>
    </article>
</section>

<?php
    $content = ob_get_clean();
    $title = "Camera &#8226; Camagru";
    require('view/template.php');
?>