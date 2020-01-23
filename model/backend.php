<?php

function dbConnect()
{
    $db = null;
    $dsn = 'mysql:host=127.0.0.1;dbname=camagru;charset=utf8';
    $username = 'root';
    $pwd = 'tonton';

    $db = new PDO($dsn, $username, $pwd);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($db != null)
    {
        return $db;
    }
    else
        throw new Exception('Echec de la connexion a la base de donnees');
}

function getAllUsers()
{
    if (($db = dbConnect()) == false)
        throw new Exception('dbConnectOk');
    elseif (($req = $db->query('SELECT * FROM users WHERE 1')) == false)
        throw new Exception("Here 2");
    return $req;
}