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

$page = (!empty($_GET['page']) ? $_GET['page'] : 1);

$all_pics = get_gallery($limit, $page);
$page_number = page_number($limit);

if (isset($_GET['action']))
{
    if (empty($_SESSION['login'])) {
        $_SESSION['error'] = "You need to be logged in";
    }
    else
    {
        if ((!empty($_GET['action'])) && ($_GET['action'] == 'likeUp') && (!empty($_GET['id'])))
        {
            is_it_liked($_SESSION['login'], $_GET['id']);
            header('Location: index.php');
        }
    }
}

$error = ft_error();

require('./view/indexView.php');
