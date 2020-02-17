<?php
//===== SUPERPOSITION =====//
function put_sticker($sticker_path)
{
    $sticker_to_paste = $sticker_path;
    $orig_photo = './public/tmp/tampon1.png';

    // $im = imagecreatefrompng($orig_photo);
    // $condicion = GetImageSize($sticker_to_paste); // image format?
    // print_r($condicion);

    // if($condicion[2] == 1) //gif
    // $im2 = imagecreatefromgif('$sticker_to_paste');
    // if($condicion[2] == 2) //jpg
    // $im2 = imagecreatefromjpeg('$sticker_to_paste');
    // if($condicion[2] == 3) //png
    $im = imagecreatefrompng($orig_photo);
    $sticker = imagecreatefrompng($sticker_to_paste);


    // header('Content-Type: image/png');

    // STACK OVERFLOW //
    imagecopy($im, $sticker, 0, 0, 0, 0, 640, 480);

    ob_start();
    imagepng($im);
    $image = ob_get_contents();
    ob_end_clean();
    $output = '<img src="data:image/png;base64,'.base64_encode($image).'" />';
    
    imagedestroy($im);
    imagedestroy($sticker);
    return $output;
}