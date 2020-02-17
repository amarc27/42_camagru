<?php ob_start(); ?>

<section id="content">
    <article id="photo-section">
        <p style="font-weight:bold; text-align: center; color: #DA2C38"><?= $error ?></p>
        <div id="photo_frame">
            <h3>Upload pictures</h3>
            <p style="font-weight:bold; text-align: center; color: #DA2C38"><?= $error ?></p>
            <form method="POST" enctype="multipart/form-data">
                <input type="file" name="file">
                <button type="submit" name="submit-upload">Upload your pictures</button>
            </form>

            <!-- Stream video via webcam -->
            <div class="video-wrap">
                <video id="video" playsinline autoplay></video>
            </div>

            <!-- Trigger canvas web API -->
            <div class="controller">
                <form method="POST" name="form" id="form">
                <textarea name="base64" id="base64" style='display:none' ></textarea>
                <button type="submit" name='submit-snapshot'>Take picture</button>
                </form>
            </div>

            <canvas id="canvas" width="640" height="480"style="display:none"></canvas>
            <div class="overview">
            <?php
            if (file_exists('public/tmp/tampon1.png') && !empty($overlay))
                echo $overlay;
            else if (file_exists('public/tmp/tampon1.png'))
                echo "<img src='public/tmp/tampon1.png' />";
            ?>
            </div>
        </div>
        <div id="sticker_frame">
        <?php 
            while($sticker = $sticker_data->fetch()) {
                echo "<div class='stickers-area'>";
                    echo "<a class='select-sticker' id='".$sticker['id_sticker']."' href='camera.php?action=putSticker&id_sticker=".$sticker['id_sticker']."' style='display: inline;'>
                            <img src='".$sticker['sticker_label']."' alt='Sticker'></a>";
                echo "</div>";
            }
        ?>
        </div>
    <button type='submit' name='submit-save'>Save</button>
    </article>
    <article id="feed">
        <?php 
            while($picture = $pic_data->fetch()) {
                echo "<div class='image-area'>";
                    echo "<img src='".$picture['img']."' alt=''>";
                    echo "<a class='remove-image' id='".$picture['id_img']."' href='camera.php?action=deletePic&id_img=".$picture['id_img']."' style='display: inline;'>&#215;</a>";
                echo "</div>";
            }
        ?>
    </article>
</section>
<script src="public/js/camera.js"></script>

<?php
    $content = ob_get_clean();
    $title = "Camera &#8226; Camagru";
    require('view/template.php');
?>