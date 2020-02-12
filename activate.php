<?php
session_start();

require('model/generalModel.php');
require ('config/database.php');

$profile = get_profile($_GET['log']);

$u_time = $_GET['time'];
$current_time = time();

if ($profile['active'] == 1)
    $_SESSION['error'] = "Account already activated";
else if ($profile == "" || $profile['activation_key'] != $_GET['key'] || ($current_time - $u_time > 900))
    $_SESSION['error'] = "Link not valid aymore. Please repeat operation";
else
{
    $_SESSION['error'] = "Account activated !";
    activate_account($_GET['log']);
}

$error = ft_error();
require('view/activationView.php');