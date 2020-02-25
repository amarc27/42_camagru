<?php

function get_all_pics() {
    $db = db_connect();
    $sql = 'SELECT * FROM `picture` WHERE 1 ORDER BY date DESC';
    $data = $db->query($sql);
    $db = null;
    return ($data);
}

function get_gallery($limit, $page)
{
	$db = db_connect();
    $offset = ($page - 1) * $limit;

	$sql = $db->prepare('SELECT * FROM picture ORDER BY UNIX_TIMESTAMP(date) DESC LIMIT :limite OFFSET :debut');
	$sql->bindValue(':limit', $limit, PDO::PARAM_INT);
	$sql->bindValue(':offset', $offset, PDO::PARAM_INT);
	$sql->execute();
	$db = null;
	return $sql;
}
