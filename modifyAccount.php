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

    if ((empty($_POST['login']) || empty($_POST['mail']) || empty($_POST['name']) || empty($_POST['bio'])) && isset($_POST['submit-main']))
	    $_SESSION['lightModif'] = "Champs incomplets";

    else if (isset($_POST['login']) && isset($_POST['mail']) && isset($_POST['name']) && isset($_POST['bio']) && isset($_POST['submit-main']))
    {		
        if (!ft_login_exist($_POST['login'], 'lightModif') && !ft_mail_exist($_POST['mail'], 'lightModif'))
        {
            if (there_are_spaces($_POST['login']) || there_are_spaces($_POST['mail']))
                $_SESSION['lightModif'] = "Merci de ne pas mettre d'espaces dans le login et mail";
            else if (preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $_POST['mail']) == false)
                $_SESSION['lightModif'] = "Adresse e-mail non valide";
            else 
            {
                if ($_POST['mail'] == $_SESSION['mail'])
                {
                    edit_user($_POST['login'], $_POST['mail'], $_POST['name'], $_POST['bio']);
                    include('logout.php');
                    header('Location: login.php');
                }
                else
                {
                    edit_user_activate($_POST['login'], $_POST['mail'], $_POST['name'], $_POST['bio']);
                    include('logout.php');
                    header('Location: login.php');
                }

            }
        }
        else
            $_SESSION['lightModif'] = "Ce compte existe deja";

    }
}

if (isset($_POST['submit-new-pass']))
{
    $_POST['oldPasswd'] = strip_tags($_POST['oldPasswd']);
    $_POST['newPasswd1'] = strip_tags($_POST['newPasswd1']);
    $_POST['newPasswd2'] = strip_tags($_POST['newPasswd2']);

    if ((empty($_POST['oldPasswd']) || empty($_POST['newPasswd1']) || empty($_POST['newPasswd2'])) && isset($_POST['submit-new-pass']))
	    $_SESSION['error'] = "Champs incomplets";

    else if (isset($_POST['oldPasswd']) && isset($_POST['newPasswd1']) && isset($_POST['newPasswd2']) && isset($_POST['submit-new-pass']))
    {		
        if (check_old_passwd($_SESSION['login'], $_POST['oldPasswd']))
        {
            if ($_POST['newPasswd1'] != $_POST['newPasswd2'])
                $_SESSION['error'] = "Les nouveaux mots de passe ne sont pas identiques";
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
        else
            $_SESSION['error'] = "L'ancien mot de passe est incorrect";

    }
}

$error = ft_error();
$lightModif = lightModif();

require('./view/modifyAccountView.php');