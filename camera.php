<?php
session_start();

if(empty($_SESSION['login']))
    header('Location: login.php');

require('model/generalModel.php');
include ('config/database.php');
require('overlay.php');
require('resize-class.php');

$filePath = 'public/tmp';

if (isset($_POST['submit-snapshot'])) {
    $baseFromJavascript = $_POST['base64'];
    $base_to_php = explode(',', $baseFromJavascript);

    $data = base64_decode($base_to_php[1]);
    if (!file_exists($filePath)) {
        mkdir($filePath, 0777, true);
    }
    if (file_exists($filePath))
        file_put_contents($filePath.'/tampon1.png',$data);
}

//===== UPLOAD PHOTO =====//
if (isset($_POST['submit-upload'])) {
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (!file_exists($filePath)) {
        mkdir($filePath, 0777, true);
    }
    // else {
    //     unlink('public/picture/'.$_SESSION['login']);
    // }

    if (file_exists($filePath)) {
        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 500000000) {
                    $form_field = "file";
                    $upload_path = "./public/tmp/";
                
                    $image_name = "tampon1.png";
                    $width = 640;
                    $height = 480;
                
                    $imgObj = new Image();
                    $upload = $imgObj->upload_image($form_field, $upload_path, $image_name, $width, $height);
                } else {
                    $_SESSION["error"] = "File too big ! (allowed : 500mb max)";
                }
            } else {
                $_SESSION["error"] = "Not a valid file (allowed : jpg, jpeg, png)";
            }
        } else {
            $_SESSION["error"] = "Not a valid file (allowed : jpg, jpeg, png)";
        }
    }
}

//===== DELETE PIC OR ADD STICKER =====//
if (isset($_GET['action']))
{
    if ((!empty($_GET['action'] === 'deletePic') && (!empty($_GET['id_img']))))
    {
        delete_picture($_GET['id_img']);
        header('Location: camera.php');
    }
    else if ((!empty($_GET['action'] === 'putSticker') && (!empty($_GET['id_sticker']))))
    {
        if (get_one_sticker($_GET['id_sticker']) !== false)
        {
            $sticker_path = get_one_sticker($_GET['id_sticker']);
            if (!file_exists('public/tmp/tampon1.png'))
                $_SESSION['error'] = 'Please take a picture before';
            else
            {
                $data = put_sticker($sticker_path);
                $overlay = $data['output'];           
            }
        }
        else
            $_SESSION['error'] = "You hacker, this sticker does not exist ;(";
    }
}

//===== SAVE PHOTO =====//
if (isset($_POST['submit-save']))
{
    if ((!empty($_GET['action'] === 'putSticker') && (!empty($_GET['id_sticker']))))
    {
        if (get_one_sticker($_GET['id_sticker']) !== false)
        {
            if (file_exists('public/tmp/tampon1.png'))
            {
                $sticker_path = get_one_sticker($_GET['id_sticker']);
                $array = put_sticker($sticker_path);
                $encoded_image = $array['image'];

                $base_to_php = $encoded_image;
                $bin = base64_decode($base_to_php);
                $picturesPath = 'public/picture/'.$_SESSION['login'];
                if (!file_exists($picturesPath))
                    mkdir($picturesPath, 0777, true);
                $i = 1;
                while (file_exists($picturesPath.'/'.$_SESSION['login'].'('.$i.')'.'.png'))
                    $i++;
                if (file_exists($picturesPath))
                    file_put_contents($picturesPath.'/'.$_SESSION['login'].'('.$i.')'.'.png', $bin);
                add_picture($_SESSION['login'], $picturesPath.'/'.$_SESSION['login'].'('.$i.')'.'.png');
            }
            else {
                $_SESSION['error'] = 'Take a photo before';
            }
        }
        else {
            $_SESSION['error'] = 'You hacker, this sticker does not exist ;(';
        }
    }
    else {
        $_SESSION['error'] = 'Merci de sélectionner un sticker';
    }
}

$pic_data = get_pics($_SESSION['login']);
$sticker_data = get_stickers();

$error = ft_error();

require("view/cameraView.php");