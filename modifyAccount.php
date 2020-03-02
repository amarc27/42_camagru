<?php
session_start();

require('model/generalModel.php');
include ('config/database.php');

if(empty($_SESSION['login']))
    header('Location: login.php');

$profile = get_profile($_SESSION['login']);

if (isset($_POST['submit-main']))
{
    $_POST['login'] = strip_tags($_POST['login']);
	$_POST['mail'] = strip_tags($_POST['mail']);
	$_POST['name'] = strip_tags($_POST['name']);
    $_POST['bio'] = strip_tags($_POST['bio']);

    if ((empty($_POST['login']) || empty($_POST['mail']) || empty($_POST['name'])) && isset($_POST['submit-main']))
	    $_SESSION['lightModif'] = "Fields incomplete";

    else if (isset($_POST['login']) && isset($_POST['mail']) && isset($_POST['name']) && isset($_POST['submit-main']))
    {		
        if (!ft_login_exist($_POST['login'], 'lightModif') && !ft_mail_exist($_POST['mail'], 'lightModif'))
        {
            if (there_are_spaces($_POST['login']) || there_are_spaces($_POST['mail']))
                $_SESSION['lightModif'] = "No spaces in login or mail";
            else if (preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $_POST['mail']) == false)
                $_SESSION['lightModif'] = "Email address is not valid";
            else 
            {
                if ($_POST['mail'] == $_SESSION['mail'])
                {
                    edit_user($_POST['login'], $_POST['mail'], $_POST['name'], $_POST['bio']);
                    redir('account.php');
                    $_SESSION['lightModif'] = "User modified";
                }
                else
                {
                    edit_user_activate($_POST['login'], $_POST['mail'], $_POST['name'], $_POST['bio']);
                    include('logout.php');
                    redir('login.php');
                    $_SESSION['lightModif'] = "Activation mail sent";
                }

            }
        }
        else
            $_SESSION['lightModif'] = "This account already exists";

    }
}

if (isset($_POST['submit-new-pass']))
{
    $_POST['oldPasswd'] = strip_tags($_POST['oldPasswd']);
    $_POST['newPasswd1'] = strip_tags($_POST['newPasswd1']);
    $_POST['newPasswd2'] = strip_tags($_POST['newPasswd2']);

    if ((empty($_POST['oldPasswd']) || empty($_POST['newPasswd1']) || empty($_POST['newPasswd2'])) && isset($_POST['submit-new-pass']))
	    $_SESSION['error'] = "Fields incomplete";

    else if (isset($_POST['oldPasswd']) && isset($_POST['newPasswd1']) && isset($_POST['newPasswd2']) && isset($_POST['submit-new-pass']))
    {		
        if (check_passwd($_SESSION['login'], $_POST['oldPasswd']))
        {
            if ($_POST['newPasswd1'] != $_POST['newPasswd2'])
                $_SESSION['error'] = "The new passwords are not the same";
            else
            {
                if (check_passwd($_SESSION['login'], $_POST['newPasswd1']) == true)
                {
                    $_SESSION['error'] = "The new password must be different from the old one";
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
            $_SESSION['error'] = "Old password is incorrect";

    }
}

if (isset($_POST['submit-del-user']))
{
    $_POST['passwd'] = strip_tags($_POST['passwd']);

    if (empty($_POST['passwd']) && isset($_POST['submit-del-user']))
        $_SESSION['error'] = "Fields incomplete";
    else if (isset($_POST['passwd']) && isset($_POST['submit-del-user']))
    {
        if (check_passwd($_SESSION['login'], $_POST['passwd']) == true)
        {
            delete_user($_SESSION['login']);
            include('logout.php');
            header('Location: index.php');
        }
        else
            $_SESSION['error'] = "Incorrect password";
    }
}

if (isset($_POST['submit-default-mail']))
{
    if (empty($_POST['notif']) && isset($_POST['submit-default-mail']))
        $_SESSION['error'] = "Choose an option, please";
    if ($_POST['notif'] == 0 && isset($_POST['submit-default-mail']))
    {
        $answer = 0;
        activate_notification($_SESSION['login'], $answer);
    }
    else
    {
        $answer = 1;
        activate_notification($_SESSION['login'], $answer);
    }
}



$error = ft_error();
$lightModif = lightModif();

require('./view/modifyAccountView.php');