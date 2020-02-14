<?php
function add_picture($login, $file) {
    $profile = get_profile($login);
    $db = db_connect();

    $sql = "INSERT INTO picture (id_user, img) VALUES ('".$profile['id']."', '".$file."')";
    $db->query($sql);
    $db = NULL;
    return true;
}

function get_pics($login) {
	$profile = get_profile($login);
	$db = db_connect();
	$sql = 'SELECT * FROM picture WHERE id_user = "'.$profile['id'].'"';
	$data = $db->query($sql);
	return ($data);
}

function delete_picture($pic)
{
	delete_item('picture', 'id_img', $pic);
}

function delete_item($table, $field, $id)
{
	$db = db_connect();
	$sql = "DELETE  FROM ".$table."  WHERE ".$table.".".$field." = '".$id."'";
	$db->query($sql);
	$db = null;
}