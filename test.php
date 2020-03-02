<?php
session_start();
require('model/generalModel.php');
include ('config/database.php');

if (is_it_liked('toto', '32') == false)
{
    add_like($_SESSION['login'], $_GET['id']);
}
else
{
    echo "COEUR PLEIN";
}
        
?>