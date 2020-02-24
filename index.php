<?php
    session_start();

    $srcDIR = "http://".$_SERVER['HTTP_HOST']."/camagru";
    $account_link = $srcDIR."/account.php";
    $signup_link = $srcDIR."/signup.php";
    $login_link = $srcDIR."/login.php";
    $logout_link = $srcDIR."/logout.php";
    $camera_link = $srcDIR."/camera.php";

    require('model/generalModel.php');
    include ('config/database.php');

    $all_pics = get_all_pics();

    require('./view/indexView.php');
