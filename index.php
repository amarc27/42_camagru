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

$limit = 9;
$page_number = page_number($limit);

if (empty($_GET['page']))
    $_GET['page'] = 1;
else if ($_GET['page'] <= 0)
    $_GET['page'] = 1;
else if ($_GET['page'] > $page_number)
    $_GET['page'] = 1;
else
    $page = $_GET['page'];

$page = (!empty($_GET['page']) ? $_GET['page'] : 1);

$all_pics = get_gallery($limit, $page);

$error = ft_error();

require('./view/indexView.php');
