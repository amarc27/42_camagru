<?php

function ft_login_exist($login, $notif_type)
{
	$db = db_connect();
	
	$sql = $db->prepare("SELECT * FROM `user` WHERE `login`=:login");
	$sql->bindParam("login", $login, PDO::PARAM_STR);
	$sql->execute();
	$data = $sql->fetch(PDO::FETCH_OBJ);
	$db = null;
	if ($data == "")
		return false;
	else if ($login == $_SESSION['login'])
		return false;
	else if ($login == $data->login)
	{
		$_SESSION[$notif_type] = "This login already exists";
		return true;
	}
}

function ft_mail_exist($mail, $notif_type)
{
	$db = db_connect();
	$sql = $db->prepare("SELECT * FROM user WHERE mail=:mail");
	$sql->bindParam("mail", $mail, PDO::PARAM_STR);
	$sql->execute();
	$data = $sql->fetch(PDO::FETCH_OBJ);
	$db = null;
	if ($data == "")
		return false;
	else if ($mail == $_SESSION['mail'])
		return false;
	else
	{
		$_SESSION[$notif_type] = "This email already exists";
		return true;
	}
}

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

function edit_user($login, $mail, $name, $bio)
{
	$db = db_connect();

	$profile = get_profile($_SESSION['login']);
	
	$login = htmlspecialchars($login);
	$mail = htmlspecialchars($mail);
	$name = htmlspecialchars($name);
	$bio = htmlspecialchars($bio);
	
	// $sql = $db->prepare("UPDATE user SET login = :login, mail = :mail, name = :name, bio = :bio WHERE id = :id");
	$sql = $db->prepare('UPDATE user SET login = :login, mail = :mail, name = :name, bio = :bio WHERE id = :id');
	$sql->bindParam(":login", $login, PDO::PARAM_STR);
	$sql->bindParam(":mail", $mail, PDO::PARAM_STR);
	$sql->bindParam(":name", $name, PDO::PARAM_STR);
	$sql->bindParam(":bio", $bio, PDO::PARAM_STR);
	$sql->bindParam(":id", $profile['id'], PDO::PARAM_INT);
	$sql->execute();
	$db = null;
}

function edit_user_activate($login, $mail, $name, $bio)
{
	$db = db_connect();
	
	$profile = get_profile($_SESSION['login']);
	
	$login = htmlspecialchars($login);
	$mail = htmlspecialchars($mail);
	$name = htmlspecialchars($name);
	$bio = htmlspecialchars($bio);
	
	$activation_key = md5(microtime(TRUE)*100000);
	$sql = $db->prepare("UPDATE user SET login = :login, mail = :mail, name = :name, bio = :bio, activation_key = :activation_key WHERE id = :id");
	$sql->bindParam("login", $login, PDO::PARAM_STR);
	$sql->bindParam("mail", $mail, PDO::PARAM_STR);
	$sql->bindParam("name", $name, PDO::PARAM_STR);
	$sql->bindParam(":bio", $bio, PDO::PARAM_STR);
	$sql->bindParam(":activation_key", $activation_key, PDO::PARAM_STR);
	$sql->bindParam(":id", $profile['id'], PDO::PARAM_INT);
	$sql->execute();
	$db = null;
	disable_account($_SESSION['login']);
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
	$message .="To activate your account, please click on the link below :"."\n\n";
	$message .= $link;
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
	$message .="to reset your password, please click on the link below :"."\n\n";
	$message .= $link;
	if (!(mail($mail, $subject, $message)))
	{
		$_SESSION['error'] = "An error occured when sending the email, please try again";
	}
}

/* NOTIFICATION MAIL BY CESAR */
function activate_notification($login, $answer) {
	$db = db_connect();
	$sql = $db->prepare("UPDATE `user` SET `default_mail` = '$answer' WHERE `login` = '$login' ");
	$sql->bindParam(":login", $login, PDO::PARAM_STR);
	$sql->bindParam(':default_mail', $answer, PDO::PARAM_INT);
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
	if ($data->default_mail == 1)
		return true;
	return false;
}

function notif_mail($id) {

	$db = db_connect();
	$sql = $db->prepare("SELECT * FROM `picture` WHERE `id_img` = '$id';");
	$sql->bindParam(':id_img', $id, PDO::PARAM_INT);
	$sql->execute();
	$data = $sql->fetch(PDO::FETCH_OBJ);
	$id_author = $data->id_user;
	$db = null;
	if (verify_notification($id_author) == true)
	{
		$db = db_connect();
		$sql = $db->prepare("SELECT * FROM `user` WHERE `id` = '$id_author' ");
		$sql->bindParam(':id', $id_author, PDO::PARAM_INT);
		$sql->execute();
		$data = $sql->fetch(PDO::FETCH_OBJ);
		$mail = $data->mail;
		$db = null;
		$subject = "📥 Camagru : you received a comment"."\n";
		$link = "http://".$_SERVER['HTTP_HOST']."/camagru/"."account";
		$message = "Somebody commented one of your photos";
		mail($mail, $subject, $message);
	}
}