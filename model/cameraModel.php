<?php
function get_pics($login) {
    $profile = get_profile($login);
    $db = db_connect();
    $sql = 'SELECT * FROM picture WHERE id_user = "'.$profile['id'].'" ORDER BY date DESC';
    $data = $db->query($sql);
    $db = null;
    return ($data);
}

function add_picture($login, $fileToUpload) {
    $profile = get_profile($login);
    $db = db_connect();

    $sql = "INSERT INTO picture (id_user, img) VALUES ('".$profile['id']."', '".$fileToUpload."')";
    $db->query($sql);
	$db = NULL;
	return true;
}

function delete_picture($pic)
{
	delete_item('picture', 'id_img', $pic);
}

function get_stickers()
{
	$db = db_connect();
	$sql = 'SELECT * FROM `sticker` WHERE 1';
	$data = $db->query($sql);
	$db = null;
	return ($data);
}

function get_one_sticker($sticker)
{
	$db = db_connect();
	$sql = $db->prepare('SELECT * FROM `sticker` WHERE id_sticker = :id');
	$sql->bindParam(':id', $sticker, PDO::PARAM_INT);
	$sql->execute();
	$data = $sql->fetch(PDO::FETCH_OBJ);
	$db = null;
	if ($data == "")
		return false;
	else
		return ($data->img_sticker);
}