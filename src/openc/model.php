<?php
function getPosts()
{
    try
    {
        $db = new PDO('mysql:host=127.0.0.1;dbname=test;charset=utf8', 'root', 'tonton');
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }

    $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');

    return $req;
}
