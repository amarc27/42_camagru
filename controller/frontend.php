<?php
require('../model/backend.php');

function listAllUsers()
{
    $users = getAllUsers();
    require('../view/showAllUsers.php');
}