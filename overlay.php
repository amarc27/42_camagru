<?php
//===== SUPERPOSITION =====//
function put_sticker($sticker_path)
{
    $sticker_to_paste = $sticker_path;
    $orig_photo = './public/tmp/tampon1.png';

    $condicion = GetImageSize($orig_photo); // image format?

    if($condicion[2] == 1) //gif
        $im = imagecreatefromgif($orig_photo);
    if($condicion[2] == 2) //jpg
        $im = imagecreatefromjpeg($orig_photo);
    if($condicion[2] == 3) //png
        $im = imagecreatefrompng($orig_photo);

    $sticker = imagecreatefrompng($sticker_to_paste);

    imagecopy($im, $sticker, 0, 0, 0, 0, 640, 480);

    ob_start();
    imagepng($im);
    $image = ob_get_contents();
    ob_end_clean();
    
    $ret_array['output'] = '<img src="data:image/png;base64,'.base64_encode($image).'" />';
    $ret_array['image'] = base64_encode($image);
    imagedestroy($im);
    imagedestroy($sticker);
    return $ret_array;
}