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
	$header = 'MIME-Version: 1.0'."\n".'Content-type: text/plain'."\n"."From: Camagru@contact.com"."\n";
	$subject = "Camagru : activez votre compte"."\n";
	$link = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
	$link = str_replace("subscription.php", "", $link);
	$link .='activation.php?log='.urlencode($login).'&key='.urlencode($activation_key);

	$message = "Bienvenue sur Camagru"."\n\n";
	$message .="Pour activer votre compte veuillez cliquer sur le lien ci dessous."."\n\n";
	$message .= $link;
	$message .="\n\n"."---------------"."\n";
	$message .="Ceci est un mail automatique, Merci de ne pas y répondre.";
	if (!(mail($mail, $subject, $message)))
	{
		$_SESSION['error'] = "Une erreur s&#39;est produite lors de l&#39;envoi du mail de confirmation.<br/> Veuillez recommencer la proc&eacute;dure";
	}
}

function ft_mod_pass($login, $new_pass)
{
	$db = db_connect();
	$profile = get_profile($login);
	$passwd = ft_hash($profile['id'], $new_pass);
	$sql = $db->prepare("UPDATE user SET pass=:new WHERE login=:login");
	$sql->bindParam(":new", $passwd, PDO::PARAM_STR);
	$sql->bindParam(":login", $login, PDO::PARAM_STR);
	$sql->execute();
	$db = null;
	$_SESSION['error'] = "Mot de passe modifi&eacute;";
}