<?php
session_start();

require('model/generalModel.php');
include ('config/database.php');

if(empty($_SESSION['login']))
    header('Location: login.php');
    
$nb_photos = count_photos($_SESSION['login']);
$limit = 9;

if (empty($_GET['page'])) {
    $_GET['page'] = 1;
    $page = 1;
}
else if ($_GET['page'] <= 0)
{
    $_GET['page'] = 1;
    $page = 1;
}
else if ($_GET['page'] > floor($nb_photos / 9))
{
    $_GET['page'] = 1;
    $page = 1;
}
else
    $page = $_GET['page'];

$my_page_number = my_page_number($limit, $_SESSION['login']);

$profile = get_profile($_SESSION['login']);
$my_pics = get_my_gallery($limit, $page, $_SESSION['login']);

$error = ft_error();

require('./view/accountView.php');