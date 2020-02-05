<?php

function ft_login_exist($login)
{
	$db = db_connect();
	
	$sql = $db->prepare("SELECT * FROM `user` WHERE `login`=:login");
	$sql->bindParam("login", $login, PDO::PARAM_STR);
	$sql->execute();
	$data = $sql->fetch(PDO::FETCH_OBJ);
	$db = null;
	if ($data == "")
		return false;
	else
	{
		$_SESSION['error'] = "Ce nom d'utilisateur existe d&eacute;&agrave;.";
		return true;
	}
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
	{
		$_SESSION['error'] = "Cette adresse mail existe d&eacute;&agrave;.";
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

function ft_activation_mail($login, $mail, $activation_key)
{
	// $header = 'MIME-Version: 1.0'."\n".'Content-type: text/plain'."\n"."From: Camagru@contact.com"."\n";
	$subject = "📥 Camagru : activez votre compte"."\n";
	$link = "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
	$link = str_replace("signup.php", "", $link);
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
		$_SESSION['error'] = "Le compte n'a pas été activé";
		$db = null;
		return false;
	}
	else
	{
		$_SESSION['login'] = $login;
		$db = null;
		return true;
	}
}