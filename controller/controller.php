<?php

require('./model/backend.php');


function loadHeader()
{
    require('./view/header.php');
}

function listAllUsers()
{
    $data = getAllUsers();
    require('./view/showAllUsers.php');
}