<?php
//===== TRANSFER IMAGE FROM JS TO PHP =====//
// baseFromJavascript will be the javascript base64 string retrieved of some way (async or post submited)
$baseFromJavascript = $_POST['base64']; // $_POST['base64']; //your data in base64 'data:image/png....';
// We need to remove the 'data:image/png;base64,'
$base_to_php = explode(',', $baseFromJavascript);
// the 2nd item in the base_to_php array contains the content of the image
$data = base64_decode($base_to_php[1]);

// here you can detect if type is png or jpg if you want
//$filepath = '/public/tmp/image.png'; // or image.jpg

// Save the image in a defined path
if (!file_exists('public/tmp')) {
    mkdir('public/tmp', 0777, true);
}

$filePath = 'public/tmp';

if (file_exists($filePath))
{
    file_put_contents($filePath.'/tampon1.png',$data);
} else
{
    touch($filePath.'/tampon2.png');
    file_put_contents($filePath,$data);
}

//===== SUPERPOSITION =====//
$sticker_to_paste='./public/stickers/mask.png';
$orign_photo='./public/tmp/tampon1.png';

// $im = imagecreatefrompng($orign_photo);
// $condicion = GetImageSize($sticker_to_paste); // image format?
// print_r($condicion);

// if($condicion[2] == 1) //gif
// $im2 = imagecreatefromgif('$sticker_to_paste');
// if($condicion[2] == 2) //jpg
// $im2 = imagecreatefromjpeg('$sticker_to_paste');
// if($condicion[2] == 3) //png
$im = imagecreatefrompng($orign_photo);
$sticker = imagecreatefrompng($sticker_to_paste);


header('Content-Type: image/png');

// STACK OVERFLOW //
// ob_start();
// imagepng($im);
// $output = ob_get_contents();
// ob_end_clean();

imagecopy($im, $sticker, 0, 0, 0, 0, 640, 480);
imagepng($im);

imagedestroy($im);
imagedestroy($sticker);