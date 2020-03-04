<?php
require("database.php");

$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = file_get_contents('camagru.sql');

$query = $db->exec($sql);

header("Location:../index.php");