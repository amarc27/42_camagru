<?php

require('./model/backend.php');

function listAllUsers()
{
    $data = getAllUsers();
    require('./view/showAllUsers.php');
}