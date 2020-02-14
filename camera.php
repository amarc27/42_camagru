<?php
session_start();

require('model/generalModel.php');
include ('config/database.php');

if (isset($_POST['submit'])) {
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if(!file_exists('public/picture/'.$_SESSION['login'])) {
        mkdir('public/picture/'.$_SESSION['login'], 0777, true);
    }
    // else {
    //     unlink('public/picture/'.$_SESSION['login']);
    // }

    if (file_exists('public/picture/'.$_SESSION['login'])) {
        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 500000) {
                    $i = 1;
                    while (file_exists('public/picture/'.$_SESSION['login']."/"."$fileExt[0](".$i.").".$fileActualExt))
                        $i++;
                    $fileNameNew =  $fileExt[0]."(".$i.").".$fileActualExt;
                    $fileDestination = 'public/picture/'.$_SESSION['login']."/".$fileNameNew;
                    $fullPath = "./".$fileDestination;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    add_picture($_SESSION['login'], $fullPath);
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

}

$data = get_pics($_SESSION['login']);

require("view/cameraView.php");