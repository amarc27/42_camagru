<?php ob_start(); ?>

<section id="content">
    <article id="photo-section">
        <div id="photo-frame">
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="file" name="file">
                <button type="submit" name="submit">Upload your pictures</button>
            </form>
        </div>
        <div id="sticker-frame">
            <p>Stickers</p>
        </div>
    </article>
    <article id="feed">
        <?php 
            while($result = $data->fetch()) {
                echo "<img src='".$result['img']."' alt=''>";
            }
        ?>
    </article>
</section>

<?php
    $content = ob_get_clean();
    $title = "Camera &#8226; Camagru";
    require('view/template.php');
?>