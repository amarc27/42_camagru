<?php
ob_start();
?>

<script src="public/js/camera.js"></script>
<section id="content">
    <div class="camera-page">
        <h1>Camagru</h1>
        <h3>Here you can take photos and share them with your friends !</h3>
        <video id="video"></video>
        <button id="startbutton">Prendre une photo</button>
        <canvas id="canvas"></canvas>
        <img src="http://placekitten.com/g/320/261" id="photo" alt="photo">
        <!-- <video autoplay="true" id="videoElement"> -->
    </div>
</section>

<?php
    $content = ob_get_clean();
    $title = "Camera &#8226; Camagru";
    require('view/template.php');
?>