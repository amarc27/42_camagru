<?php
require('./controller/controller.php');
// require('controller/controller.php');

try
{
    $data = listAllUsers();
}
catch(Exception $e)
{
    echo 'Erreur : ' . $e->getMessage(). ' | ';
}
?>