<?php

require('./model/backend.php');


function loadHeader()
{
    
}

function listAllUsers()
{
    $data = getAllUsers();
    require('./view/showAllUsers.php');
}