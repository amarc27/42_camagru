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
	{
		return false;
	}
	else
	{
		$_SESSION[$notif_type] = "Ce nom d'utilisateur existe d&eacute;&agrave;.";
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
	{
		return false;
	}
	else
	{
		$_SESSION[$notif_type] = "Cette adresse mail existe d&eacute;&agrave;.";
		return true;
	}
}
function ft_user_new($login, $mail, $name, $pass)
{
	$db = db_connect();
	
	$login = htmlspecialchars($login);
	$mail = htmlspecialchars($mail);
	$name = htmlspecialchars($name);
	$pass = htmlspecialchars($pass);
	
	$activation_key = md5(microtime(TRUE)*100000);
	$sql = $db->prepare("INSERT INTO user (login, mail, name, pass, active, activation_key) VALUES (:login, :mail, :name, '1', '0', '".$activation_key."')");
	$sql->bindParam("login", $login, PDO::PARAM_STR);
	$sql->bindParam("mail", $mail, PDO::PARAM_STR);
	$sql->bindParam("name", $name, PDO::PARAM_STR);
	$sql->execute();
	$db = null;
	ft_mod_pass($login, $pass);
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
	disable_account($_SESSION['login']);
	$db = null;
	ft_activation_mail($login, $mail, $activation_key);
}

function ft_activation_mail($login, $mail, $activation_key)
{
	$subject = "📥 Camagru : activez votre compte"."\n";
	$link = "http://".$_SERVER['HTTP_HOST']."/camagru/";
	$link .='activate.php?log='.urlencode($login).'&key='.urlencode($activation_key);

	$message = "Bienvenue sur Camagru !"."\n\n";
	$message .="Pour activer votre compte veuillez cliquer sur le lien ci-dessous :"."\n\n";
	$message .= "--> ".$link;
	if (!(mail($mail, $subject, $message)))
	{
		$_SESSION['error'] = "Une erreur s&#39;est produite lors de l&#39;envoi du mail de confirmation.<br/> Veuillez recommencer la proc&eacute;dure";
	}
}

function ft_mod_pass($login, $new_pass)
{
	$db = db_connect();
	$passwd = hasher($new_pass);
	$sql = $db->prepare("UPDATE user SET pass=:new WHERE login=:login");
	$sql->bindParam(":new", $passwd, PDO::PARAM_STR);
	$sql->bindParam(":login", $login, PDO::PARAM_STR);
	$sql->execute();
	$db = null;
	$_SESSION['error'] = "Mot de passe modifi&eacute;";
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

function check_user($login, $passwd)
{
	$db = db_connect();

	$profile = get_profile($login);

	$sql = $db->prepare('SELECT * FROM user WHERE login = :login');
	$sql->bindParam(':login', $login, PDO::PARAM_STR);
	$sql->execute();
	$data = $sql->fetch();

	if ($data == "")
	{
		$_SESSION['error'] = "Ce compte n'existe pas";
		$db = null;
		return false;
	}
	else if (password_verify($passwd, $data['pass']) == false)
	{
		$_SESSION['error'] = "Mot de passe incorrect";
		$db = null;
		return false;
	}
	else if ($data['active'] === '0')
	{
		$_SESSION['error'] = "Le compte n'a pas été activé, regardez vos mails !";
		$db = null;
		return false;
	}
	else
	{
		$_SESSION['login'] = $login;
		$_SESSION['mail'] = $profile['mail'];
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