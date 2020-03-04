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
}

//===== ADD COMMENT =====//
if (isset($_POST['submit-comment'])) {
    $str = strip_tags($_POST['comment']);
    $cleaned = trim($str);
    $final_str = preg_replace('#[\s]+#', ' ', $cleaned);
    if (preg_match('/[\S]+/', $final_str) == 1)
    {
        add_comment($_SESSION['login'], $_GET['id'], $final_str);
        notif_mail($_GET['id'], $_SESSION['login'], $final_str);
    }
    else $_SESSION['error'] = "Only commenting whitespaces is not really interesting...";
}


//===== DELETE COMMENT =====//
if (isset($_POST['delete-comment'])) {
    if (!empty($_POST['id_com']))
        delete_comment($_POST['id_com']);
}


//===== ADD LIKE =====//
if (isset($_POST['submit-like']))
    add_like($_SESSION['login'], $_GET['id']);


//===== REMOVE LIKE =====//
if (isset($_POST['submit-dislike']))
    remove_like($_SESSION['login'], $_GET['id']);


//===== DISPLAY COMMENTS =====//
if (!empty($_GET['id']) && !empty($_GET['action']))
    $comments = get_comments($_GET['id']);
else
    $_SESSION['error'] = "Wrong url, please go back to gallery";


$error = ft_error();

require("view/commentView.php");