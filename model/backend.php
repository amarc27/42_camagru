<?php

function dbConnect()
{
    try
    {
        $dsn = 'mysql:host=127.0.0.1;dbname=camagru;charset=utf8';
        $username = 'root';
        $pwd = 'tonton';

        $db = new PDO($dsn, $username, $pwd);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }
    catch(Exception $e)
    {
        die('Erreur : '. $e->getMessage());
    }
}

function getAllUsers()
{
    $db = dbConnect();

    $usersData = $db->query('SELECT * FROM users WHERE 1');

    return $usersData;
}