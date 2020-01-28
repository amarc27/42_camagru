<?php

require('./backend/db.php');

function listAllUsers()
{
    $data = getAllUsers();
    require('./frontend/showAllUsers.php');
}