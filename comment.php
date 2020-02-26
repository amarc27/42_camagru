<?php
session_start();

if(empty($_SESSION['login']))
    header('Location: login.php');

require('model/generalModel.php');
include ('config/database.php');

//===== GET PIC INFOS =====//
if (isset($_GET['action']))
{
    if (($_GET['action'] === 'comment') && !empty($_GET['action']) && !empty($_GET['id']))
    {
        if (get_img_src($_GET['id']) === false)
            $_SESSION['error'] = "You hacker, this id does not exist";
        else
        {
            $img_src = get_img_src($_GET['id']);
            $nb_like = count_like($_GET['id']);
        }
    }
}


//===== NEW COMMENT =====//
if (isset($_POST['submit-comment'])) {
    add_comment($_SESSION['login'], $_GET['id'], $_POST['comment']);
}

$error = ft_error();

require("view/commentView.php");