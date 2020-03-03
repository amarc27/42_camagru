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

	$sql = $db->prepare('SELECT * FROM picture ORDER BY date DESC LIMIT :limit OFFSET :offset');
	$sql->bindValue(':limit', $limit, PDO::PARAM_INT);
	$sql->bindValue(':offset', $offset, PDO::PARAM_INT);
	$sql->execute();
	$db = null;
	return $sql;
}

function page_number($limit) {
	$db = db_connect();
	$sql = 'SELECT * FROM picture';
	$sql = $db->prepare($sql);
	$sql->execute();

	$row = $sql->rowCount();
	$count = ceil($row / $limit);
	$db = null;
	return $count;
}

function get_my_gallery($limit, $page, $login)
{
	$db = db_connect();
	$profile = get_profile($login);
    $offset = ($page - 1) * $limit;

	$sql = $db->prepare('SELECT * FROM picture WHERE id_user = :id_user ORDER BY date DESC LIMIT :limit OFFSET :offset');
	$sql->bindValue(':limit', $limit, PDO::PARAM_INT);
	$sql->bindValue(':offset', $offset, PDO::PARAM_INT);
	$sql->bindValue(':id_user', $profile['id'], PDO::PARAM_INT);
	$sql->execute();
	$db = null;
	return $sql;
}

function my_page_number($limit, $login) {
	$db = db_connect();
	$profile = get_profile($login);
	$sql = $db->prepare('SELECT * FROM picture WHERE id_user = :id_user');
	$sql->bindValue(':id_user', $profile['id'], PDO::PARAM_INT);
	$sql->execute();

	$row = $sql->rowCount();
	$count = ceil($row / $limit);
	$db = null;
	return $count;
}

function count_photos($login) {
	$db = db_connect();
	$profile = get_profile($login);
	$sql = $db->prepare("SELECT * FROM `picture` WHERE id_user = :id_user");
	$sql->bindParam(':id_user', $profile['id'], PDO::PARAM_INT);
	$sql->execute();
	
	$row = $sql->rowCount();
	$db = NULL;
	return $row;
}

function add_like($login, $id_img) {
	$db = db_connect();
	$profile = get_profile($login);

	$sql = $db->prepare("INSERT INTO `like` (`id_user`, `id_img`, `liked`) VALUES (:id_user, :id_img, '1')");
	$sql->bindParam(':id_user', $profile['id'], PDO::PARAM_INT);
	$sql->bindParam(':id_img', $id_img, PDO::PARAM_INT);
	$sql->execute();
	$db = null;
}

function remove_like($login, $id_img) {
	$db = db_connect();
	$profile = get_profile($login);

	$sql = $db->prepare("DELETE FROM `like` WHERE id_user = :id_user AND id_img = :id_img");
	$sql->bindParam(':id_user', $profile['id'], PDO::PARAM_INT);
	$sql->bindParam(':id_img', $id_img, PDO::PARAM_INT);
	$sql->execute();
	$db = null;
}

function is_it_liked($login, $id_img) {
	$db = db_connect();
	$profile = get_profile($login);

	$sql = $db->prepare("SELECT * FROM `like` WHERE `id_img` = :id_img AND `id_user` = :id_user");
	$sql->bindParam(':id_img', $id_img, PDO::PARAM_INT);
	$sql->bindParam(':id_user', $profile['id'], PDO::PARAM_INT);
	$sql->execute();
	$data = $sql->fetch(PDO::FETCH_OBJ);
	$db = null;
	if ($data)
		return true;
	else
		return false;
}

function get_img_src($id_img) {
	$db = db_connect();
	$sql = $db->prepare("SELECT * FROM `picture` WHERE id_img = :id_img");
	$sql->bindParam(':id_img', $id_img, PDO::PARAM_INT);
	$sql->execute();
	$data = $sql->fetch(PDO::FETCH_OBJ);
	$db = null;
	if ($data == "")
		return false;
	else
		return $data->img;
}

function add_comment($login, $id_img, $comment) {
	$db = db_connect();
	$profile = get_profile($login);

	$sql = $db->prepare("INSERT INTO `comment` (`id_user`, `id_img`, `text`) VALUES (:id_user, :id_img, :text)");
	$sql->bindParam(':id_user', $profile['id'], PDO::PARAM_INT);
	$sql->bindParam(':id_img', $id_img, PDO::PARAM_INT);
	$sql->bindParam(':text', $comment, PDO::PARAM_STR);
	$sql->execute();
	$db = null;
}

function get_comments($id_img) {
    $db = db_connect();
    $sql = 'SELECT * FROM `comment` WHERE id_img = "'.$id_img.'"';
    $data = $db->query($sql);
    $db = null;
	return ($data);
}

function delete_comment($id_com) {
	delete_item('comment', 'id_com', $id_com);
}