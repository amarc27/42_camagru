<?php
session_start();

require('model/generalModel.php');
include ('config/database.php');

if(!empty($_SESSION['login']))
    header('Location: login.php');

$profile = get_profile($_GET['log']);
$u_time = $_GET['time'];
$current_time = time();

if ($profile == "" || ($profile['activation_key'] != $_GET['key']) || ($current_time - $u_time > 900))
{
    $_SESSION['error'] = "Link not valid aymore. Please repeat operation";
}
else
{
    if ((empty($_POST['newPasswd1']) || empty($_POST['newPasswd2'])) && isset($_POST['submit-new-pass']))
	    $_SESSION['error'] = "Champs incomplets";

    else if (isset($_POST['newPasswd1']) && isset($_POST['newPasswd2']) && isset($_POST['submit-new-pass']))
    {		
        if (there_are_spaces($_POST['newPasswd1']) || there_are_spaces($_POST['newPasswd2']))
            $_SESSION['error'] = "No spaces allowed";
        else if ($_POST['newPasswd1'] != $_POST['newPasswd2'])
            $_SESSION['error'] = "Passwords are not the same";
        else if (check_passwd($profile['login'], $_POST['newPasswd1']) == true)
            $_SESSION['error'] = "You need to enter a new password";
        else 
        {
            if (password_secure($_POST['newPasswd1']))
            {
                edit_password($profile['login'], $_POST['newPasswd1']);
                header('Location: login.php');
            }
        }
    }
}

$error = ft_error();
require('view/resetPasswdView.php');