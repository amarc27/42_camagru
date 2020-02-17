<?php
session_start();

if(empty($_SESSION['login']))
    header('Location: login.php');

require('model/generalModel.php');
include ('config/database.php');
require('overlay.php');

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
                if ($fileSize < 500000) {
                    $fileNameNew =  '/tampon1.png';
                    $fileDestination = $filePath.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    //add_picture($_SESSION['login'], $fullPath);
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
                $overlay = put_sticker($sticker_path);
        }
        else
            $_SESSION['error'] = "You hacker, this sticker does not exist :p";
    }
}

$pic_data = get_pics($_SESSION['login']);
$sticker_data = get_stickers();

$error = ft_error();

require("view/cameraView.php");