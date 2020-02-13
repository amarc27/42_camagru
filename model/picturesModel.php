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

	// $sql = $db->prepare("SELECT * FROM picture WHERE id_user = :id");
	//$sql->bindParam(":id", $profile['id'], PDO::PARAM_INT);

	$sql = 'SELECT * FROM picture WHERE id_user = "'.$profile['id'].'"';
	$data = $db->query($sql);
	return ($data);
}