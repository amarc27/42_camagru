<?php
require('./controller/controller.php');

try
{
    loadHeader();
    loadMain();
    loadFooter();
    $data = listAllUsers();
}
catch(Exception $e)
{
    echo 'Erreur : ' . $e->getMessage(). ' | ';
}
?>