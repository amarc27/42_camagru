<?php
session_start();

require('model/generalModel.php');
include ('config/database.php');

if(!empty($_SESSION['login']))
    header('Location: login.php');

if (isset($_POST['submit-reset-passwd']))
{
    $_POST['mail'] = strip_tags($_POST['mail']);

    if (empty($_POST['mail']) && isset($_POST['submit-reset-passwd']))
        $_SESSION['error'] = "Champs incomplets";

    else if (isset($_POST['mail']) && isset($_POST['submit-reset-passwd']))
    {		
        if (mail_in_db($_POST['mail']) == true)
        {
            if (there_are_spaces($_POST['mail']))
                $_SESSION['error'] = "Merci de ne pas mettre d'espaces dans le mail";
            else if (preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $_POST['mail']) == false)
                $_SESSION['error'] = "Adresse e-mail non valide";
            else 
            {
                send_password_reset_mail($_POST['mail']);
                $_SESSION['error'] = "Mail to reset password sent";
            }
        }
        else
            $_SESSION['error'] = "This mail does not exist";

    }
}


$error = ft_error();
require('view/forgotPasswdView.php');