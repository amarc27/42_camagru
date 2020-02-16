<?php ob_start(); ?>

<section id="content">
    <article id="photo-section">
        <div id="photo_frame">
            <!-- <h3>Upload pictures</h3>
            <p style="font-weight:bold; text-align: center; color: #DA2C38"><?= $error ?></p>
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="file" name="file">
                <button type="submit" name="submit-upload">Upload your pictures</button>
            </form> -->
            <!-- Stream video via webcam -->
            <div class="video-wrap">
                <video id="video" playsinline autoplay></video>
            </div>

            <!-- Trigger canvas web API -->
            <div class="controller">
                <button id="snap">Capture</button>
            </div>

            <!-- Webcam video snapshot -->
            <canvas id="canvas" width="640" height="480"></canvas>

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