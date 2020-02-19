<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="./test.php" method="post" enctype="multipart/form-data">

    <input type="file" name="image"><br>
    <input type="submit" value="Upload">
</form>
</body>
</html>

<?php

    // // *** Include the class
    // include("resize-class.php");

    // // *** 1) Initialise / load image
    // $resizeObj = new resize('test-photos/unsplash.jpg');

    // // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
    // $resizeObj -> resizeImage(640, 480, 'crop');

    // // *** 3) Save image
    // $resizeObj -> saveImage('test-photos/sample-resizeda.png', 0);

    require_once("resize-class.php");

    $form_field = "image";
    $upload_path = "./images/";

    //assume uploading a jpeg image file.
    //This can be determined by file type while uploading and here we do not care about the image since it's not a big deal here.
    $image_name = uniqid().".png";
    $width = 640;
    $height = 480;

    //Create an object of 'Image' class and call to 'upload_image' function which we are going to use here for our process.
    $imgObj = new Image();
    $upload = $imgObj->upload_image($form_field, $upload_path, $image_name, $width, $height);

    if($upload)
    {
        echo "Successfully uploaded the image.<br>";
        ?>
        <img src="./images/<?php echo $image_name; ?>">
        <?php
    }
    else
    {
        echo "Image uploading was failed.";
    }

?>
