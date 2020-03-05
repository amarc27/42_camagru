<?php
require("database.php");

try {
    $db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $db->query(file_get_contents('camagru.sql'));
    header("Location:../index.php");
}
catch (PDOException $e) {
	echo "Connection failed: ".$e->getMessage();
}
