<?php

function ft_login_exist($login)
{
	$db = db_connect();
	
	$sql = $db->prepare("SELECT * FROM `user` WHERE `login`=:login");
	$sql->bindParam(":login", $login, PDO::PARAM_STR);
	$sql->execute();
	$data = $sql->fetch(PDO::FETCH_OBJ);
	$db = null;
	if ($data == "")
		return false;
	else
		return true;
}

function ft_mail_exist($mail)
{
	$db = db_connect();
	$sql = $db->prepare("SELECT * FROM user WHERE mail=:mail");
	$sql->bindParam("mail", $mail, PDO::PARAM_STR);
	$sql->execute();
	$data = $sql->fetch(PDO::FETCH_OBJ);
	$db = null;
	if ($data == "")
		return false;
	else
		return true;
}

function is_my_login($login_test, $login)
{
	$db = db_connect();

	$sql = $db->prepare("SELECT * FROM `user` WHERE `login` = '$login'");
	$sql->bindParam(":login", $login, PDO::PARAM_STR);
	$sql->execute();
	$data = $sql->fetch(PDO::FETCH_OBJ);
	$db = null;

	if ($data->login == $login_test)
		return true;
	else
		return false;
}

function is_my_mail($mail_test, $mail)
{
	$db = db_connect();
	
	$sql = $db->prepare("SELECT * FROM `user` WHERE `mail`=:mail");
	$sql->bindParam("mail", $mail, PDO::PARAM_STR);
	$sql->execute();
	$data = $sql->fetch(PDO::FETCH_OBJ);
	$db = null;
	if ($data->mail == $mail_test)
		return true;
	else
		return false;
}

/* AJOUT CESAR POUR MODIFY ACCOUNT */
function edit_pseudo($new_login, $user_id)
{
	$db = db_connect();
	$new_login = htmlspecialchars($new_login);
	$sql = $db->prepare("UPDATE user SET login = :new_login WHERE id = :id");
	$sql->bindParam(":new_login", $new_login, PDO::PARAM_STR);
	$sql->bindParam(":id", $user_id, PDO::PARAM_INT);
	$sql->execute();
	$db = NULL;
}

function edit_mail($new_mail, $user_id, $login)
{
	$db = db_connect();
	$activation_key = md5(microtime(TRUE)*100000);
	$new_mail = htmlspecialchars($new_mail);
	$sql = $db->prepare("UPDATE user SET mail = :new_mail, activation_key = :activation_key WHERE id = :id");
	$sql->bindParam(":new_mail", $new_mail, PDO::PARAM_STR);
	$sql->bindParam(":activation_key", $activation_key, PDO::PARAM_STR);
	$sql->bindParam(":id", $user_id, PDO::PARAM_INT);
	$sql->execute();
	$db = NULL;
	disable_account($login);
	ft_activation_mail($login, $new_mail, $activation_key);
}

function edit_others($new_fullname, $new_bio, $id)
{
	$db = db_connect();
	$new_fullname = htmlspecialchars($new_fullname);
	$new_bio = htmlspecialchars($new_bio);
	$sql = $db->prepare("UPDATE user SET name = :new_fullname, bio = :new_bio WHERE id = :id");
	$sql->bindParam(":new_fullname", $new_fullname, PDO::PARAM_STR);
	$sql->bindParam(":new_bio", $new_bio, PDO::PARAM_STR);
	$sql->bindParam(":id", $id, PDO::PARAM_INT);
	$sql->execute();
	$db = NULL;
}

/***************************************/

function mail_in_db($mail)
{
	$db = db_connect();
	$sql = $db->prepare("SELECT * FROM user WHERE mail=:mail");
	$sql->bindParam("mail", $mail, PDO::PARAM_STR);
	$sql->execute();
	$data = $sql->fetch(PDO::FETCH_OBJ);
	$db = null;
	if ($data == "")
		return false;
	else
		return true;
}

function ft_user_new($login, $mail, $name, $pass)
{
	$db = db_connect();
	
	$login = htmlspecialchars($login);
	$mail = htmlspecialchars($mail);
	$name = htmlspecialchars($name);
	$pass = htmlspecialchars($pass);

	$login = strtolower($login);
	
	$activation_key = md5(microtime(TRUE)*100000);
	$sql = $db->prepare("INSERT INTO user (login, mail, name, pass, active, activation_key) VALUES (:login, :mail, :name, '1', '0', '".$activation_key."')");
	$sql->bindParam("login", $login, PDO::PARAM_STR);
	$sql->bindParam("mail", $mail, PDO::PARAM_STR);
	$sql->bindParam("name", $name, PDO::PARAM_STR);
	$sql->execute();
	$db = null;
	edit_password($login, $pass);
	ft_activation_mail($login, $mail, $activation_key);
}

function check_passwd($login, $new_pass)
{
	$profile = get_profile($login);
	$new_pass = htmlspecialchars($new_pass);
	if (password_verify($new_pass, $profile['pass']) == true)
		return true;
	else
		return false;
}

function ft_activation_mail($login, $mail, $activation_key)
{
	$current_time = time();
	$subject = "📥 Camagru : activate your account"."\n";
	$link = "http://".$_SERVER['HTTP_HOST']."/camagru/";
	$link .='activate.php?log='.urlencode($login).'&key='.urlencode($activation_key).'&time='.urlencode($current_time);

	$message = "Welcome on Camagru !"."\n\n";
	$message .="To activate your account, please click <a href='$link' target='_blank'><strong>here</strong></a>";
	if (!(mail($mail, $subject, $message)))
	{
		$_SESSION['error'] = "An error occured when sending the email, please try again";
	}
}

function edit_password($login, $new_pass)
{
	$db = db_connect();
	$passwd = hasher($new_pass);
	$sql = $db->prepare("UPDATE user SET pass=:new WHERE login=:login");
	$sql->bindParam(":new", $passwd, PDO::PARAM_STR);
	$sql->bindParam(":login", $login, PDO::PARAM_STR);
	$sql->execute();
	$db = null;
	$_SESSION['error'] = "Password modified";
}

function activate_account($login)
{
	$db = db_connect();
	$sql = $db->prepare("UPDATE user SET active = '1' WHERE login = :login");
	$sql->bindParam(":login", $login, PDO::PARAM_STR);
	$sql->execute();
	$db = null;
	$key = md5(microtime(TRUE)*100000);
	modify_profile($login, 'activation_key', $key);
}

function disable_account($login)
{
	$db = db_connect();
	$sql = $db->prepare("UPDATE user SET active = '0' WHERE login = :login");
	$sql->bindParam(":login", $login, PDO::PARAM_STR);
	$sql->execute();
	$db = null;
}

function modify_profile($login, $field, $value)
{
	$db = db_connect();

	$login = htmlspecialchars($login);
	$value = htmlspecialchars($value);

	$sql = $db->prepare("UPDATE user SET ".$field."=:value WHERE login=:login");
	$sql->bindParam(":login", $login, PDO::PARAM_STR);
	$sql->bindParam(":value", $value, PDO::PARAM_STR);
	$sql->execute();
	$db = null;
	return true;
}

function delete_user($login)
{
	$login = htmlspecialchars($login);

	$db = db_connect();
	$sql = $db->prepare('DELETE FROM user WHERE login = :login');
	$sql->bindParam(":login", $login, PDO::PARAM_STR);
	$sql->execute();
	$db = null;
}

function check_user($login, $passwd)
{
	$db = db_connect();

	$sql = $db->prepare('SELECT * FROM user WHERE login = :login');
	$sql->bindParam(':login', $login, PDO::PARAM_STR);
	$sql->execute();
	$data = $sql->fetch();

	if ($data == "")
	{
		$_SESSION['error'] = "This account does not exist";
		$db = null;
		return false;
	}
	else if (password_verify($passwd, $data['pass']) == false)
	{
		$_SESSION['error'] = "Incorrect password";
		$db = null;
		return false;
	}
	else if ($data['active'] === '0')
	{
		$_SESSION['error'] = "This account has not been activated, please check your emails !";
		$db = null;
		return false;
	}
	else
	{
		$_SESSION['login'] = $login;
		$_SESSION['mail'] = $data['mail'];
		$db = null;
		return true;
	}
}

function there_are_spaces($str)
{
	if (preg_match('/(\t|\s|\n|\v|\f|\r|\0)+/', $str) == true)
		return true;
	else
		return false;
}

function send_password_reset_mail($mail)
{
	$mail = strip_tags($mail);

	$db = db_connect();
	$sql = $db->prepare('SELECT * FROM user WHERE mail = :mail');
	$sql->bindParam(':mail', $mail, PDO::PARAM_STR);
	$sql->execute();
	$data = $sql->fetch(PDO::FETCH_OBJ);
	$login = $data->login;
	$db = null;

	$key = md5(microtime(TRUE)*100000);
	modify_profile($login, 'activation_key', $key);
	reset_mail($login, $mail, $key);	
}

function reset_mail($login, $mail, $key)
{
	$current_time = time();
	$subject = "📥 Camagru : Reset your password"."\n";
	$link = "http://".$_SERVER['HTTP_HOST']."/camagru/";
	$link .='resetPasswd.php?log='.urlencode($login).'&key='.urlencode($key).'&time='.urlencode($current_time);

	$message = "Welcome on Camagru !"."\n\n";
	$message .="to reset your password, please click <a href='$link' target='_blank'>here</a>";
	if (!(mail($mail, $subject, $message)))
	{
		$_SESSION['error'] = "An error occured when sending the email, please try again";
	}
}

/* NOTIFICATION MAIL BY CESAR */
function activate_notification($login, $answer) {
	$db = db_connect();
	$sql = $db->prepare("UPDATE `user` SET `receive_mail` = '$answer' WHERE `login` = '$login' ");
	$sql->bindParam(":login", $login, PDO::PARAM_STR);
	$sql->bindParam(':receive_mail', $answer, PDO::PARAM_INT);
	$sql->execute();
	$db = NULL;
}

function verify_notification($id_login) {
	$db = db_connect();
	$sql = $db->prepare("SELECT * FROM `user` WHERE `id` = '$id_login' ");
	$sql->bindParam(":id", $id_login, PDO::PARAM_INT);
	$sql->execute();
	$data = $sql->fetch(PDO::FETCH_OBJ);
	$db = null;
	if ($data->receive_mail == 1)
		return true;
	return false;
}

function notif_mail($id, $writer, $comment) {
	$db = db_connect();
	$sql = $db->prepare("SELECT * FROM `picture` WHERE `id_img` = :id_img;");
	$sql->bindParam(':id_img', $id, PDO::PARAM_INT);
	$sql->execute();
	$data = $sql->fetch(PDO::FETCH_OBJ);
	$id_author = $data->id_user;
	$db = null;
	if (verify_notification($id_author) == true)
	{
		$db = db_connect();
		$sql = $db->prepare("SELECT * FROM `user` WHERE `id` = :id ");
		$sql->bindParam(':id', $id_author, PDO::PARAM_INT);
		$sql->execute();
		$data = $sql->fetch(PDO::FETCH_OBJ);
		$mail = $data->mail;
		$db = null;
		$subject = "📥 Camagru : you received a comment"."\n";
		$link = "http://".$_SERVER['HTTP_HOST']."/camagru/"."comment.php?action=comment&id=$id";
		$message = $writer." commented one of your <a href='$link' target='_blank'>photos</a> : \"".$comment."\".";
		mail($mail, $subject, $message);
	}
}