<?php
session_start();

require('model/generalModel.php');
include ('config/database.php');

if(empty($_SESSION['login']))
    header('Location: login.php');

$profile = get_profile($_SESSION['login']);
$default_mail_status = verify_notification($profile['id']);

if (isset($_POST['submit-main']))
{
    $_POST['login'] = strip_tags($_POST['login']);
	$_POST['mail'] = strip_tags($_POST['mail']);
	$_POST['name'] = strip_tags($_POST['name']);
    $_POST['bio'] = strip_tags($_POST['bio']);

    $_POST['login'] = strtolower($_POST['login']);

    if ((empty($_POST['login']) || empty($_POST['mail']) || empty($_POST['name'])) && isset($_POST['submit-main']))
	    $_SESSION['profileModif'] = "Fields incomplete";

    else if (isset($_POST['login']) && isset($_POST['mail']) && isset($_POST['name']) && isset($_POST['submit-main']))
    {
        if (is_my_login($_POST['login'], $profile['login']) == false)
        {
            if (ft_login_exist($_POST['login']) == false)
            {
                edit_others($_POST['name'], $_POST['bio'], $profile['id']);
                edit_pseudo($_POST['login'], $profile['id']);
                include ('logout.php');
                header("Location: login.php");
            }
            else
                $_SESSION['profileModif'] = "This login already exists";
        }
        if (is_my_mail($_POST['mail'], $profile['mail']) == false)
        {
            if (ft_mail_exist($_POST['mail']) == false)
            {
                edit_others($_POST['name'], $_POST['bio'], $profile['id']);
                edit_mail($_POST['mail'], $profile['id'], $profile['login']);
                include ('logout.php');
                header("Location: login.php");
            }
            else
                $_SESSION['profileModif'] = "This mail address already exists";
        }
        edit_others($_POST['name'], $_POST['bio'], $profile['id']);
        header("Location: account.php");
    }
}


if (isset($_POST['submit-new-pass']))
{
    $_POST['oldPasswd'] = strip_tags($_POST['oldPasswd']);
    $_POST['newPasswd1'] = strip_tags($_POST['newPasswd1']);
    $_POST['newPasswd2'] = strip_tags($_POST['newPasswd2']);

    if ((empty($_POST['oldPasswd']) || empty($_POST['newPasswd1']) || empty($_POST['newPasswd2'])) && isset($_POST['submit-new-pass']))
	    $_SESSION['passwdModif'] = "Fields incomplete";

    else if (isset($_POST['oldPasswd']) && isset($_POST['newPasswd1']) && isset($_POST['newPasswd2']) && isset($_POST['submit-new-pass']))
    {		
        if (check_passwd($_SESSION['login'], $_POST['oldPasswd']))
        {
            if ($_POST['newPasswd1'] != $_POST['newPasswd2'])
                $_SESSION['passwdModif'] = "The new passwords are not the same";
            else
            {
                if (check_passwd($_SESSION['login'], $_POST['newPasswd1']) == true)
                {
                    $_SESSION['passwdModif'] = "The new password must be different from the old one";
                }
                else
                {
                    if (password_secure($_POST['newPasswd1']))
                    {
                        edit_password($_SESSION['login'], $_POST['newPasswd1']);
                        include('logout.php');
                        header('Location: login.php');
                    }
                }
            }
        }
        else
            $_SESSION['passwdModif'] = "Old password is incorrect";

    }
}

if (isset($_POST['submit-del-user']))
{
    $_POST['passwd'] = strip_tags($_POST['passwd']);

    if (empty($_POST['passwd']) && isset($_POST['submit-del-user']))
        $_SESSION['deleteAccount'] = "Fields incomplete";
    else if (isset($_POST['passwd']) && isset($_POST['submit-del-user']))
    {
        if (check_passwd($_SESSION['login'], $_POST['passwd']) == true)
        {
            delete_user($_SESSION['login']);
            include('logout.php');
            header('Location: index.php');
        }
        else
            $_SESSION['deleteAccount'] = "Incorrect password";
    }
}

if (isset($_POST['submit-default-mail']))
{
    if (!isset($_POST['notif']) && isset($_POST['submit-default-mail']))
        $_SESSION['receiveMailModif'] = "Choose an option, please";
    if ($_POST['notif'] == 0 && isset($_POST['submit-default-mail']))
    {
        $answer = 0;
        $default_mail_status = false;
        activate_notification($_SESSION['login'], $answer);
    }
    else
    {
        $default_mail_status = true;
        $answer = 1;
        activate_notification($_SESSION['login'], $answer);
    }
}

$profileModif = profileModif();
$passwdModif = passwdModif();
$deleteAccount = deleteAccount();
$receiveMailModif = receiveMailModif();

require('./view/modifyAccountView.php');