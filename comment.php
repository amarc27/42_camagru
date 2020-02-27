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
            $img_src = get_img_src($_GET['id']);
    }
    else if (true) {
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
}

//===== ADD COMMENT =====//
if (isset($_POST['submit-comment'])) {
    add_comment($_SESSION['login'], $_GET['id'], $_POST['comment']);
}


//===== DELETE COMMENT =====//
if (!empty($_POST['delete-comment'])) {
    if (!empty($_POST['id_com']))
        delete_comment($_POST['id_com']);
}


$comments = get_comments($_GET['id']);

$error = ft_error();

require("view/commentView.php");