<?php
    session_start();
    $srcDIR = "http://".$_SERVER['HTTP_HOST']."/camagru";
    $account_link = $srcDIR."/account.php";
    $signup_link = $srcDIR."/signup.php";
    $login_link = $srcDIR."/login.php";
    $logout_link = $srcDIR."/logout.php";

    require('./view/indexView.php');
