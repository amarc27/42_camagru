<?php
session_start();

require('model/generalModel.php');
require ('config/database.php');

$profile = get_profile($_GET['log']);

if ($profile['active'] == 1)
    $_SESSION['error'] = "Compte déjà activé";
else if ($profile == "" || $profile['activation_key'] != $_GET['key'])
    $_SESSION['error'] = "Lien d'activation non valide";
else
{
    $_SESSION['error'] = "Compte bien activé !";
    activate_account($_GET['log']);
}

$error = ft_error();
require('view/activationView.php');