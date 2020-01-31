<?php

include ('userModel.php');

function db_connect() 
{
	global $DB_DSN, $DB_USER, $DB_PASSWORD;

	try 
	{
		$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $db;
	}
	catch (PDOException $e) {
		echo 'Erreur de connection: ' . $e->getMessage();
	}
}

function get_profile($login)
{
	$db = db_connect();
	$sql = $db->prepare("SELECT * FROM user WHERE login = :login");
    $sql->bindParam("login", $login, PDO::PARAM_STR);
	$sql->execute();
	$res = $sql->fetch();
	$db = null;
	return $res; 
}

function ft_hash($id, $passwd)
{
	return password_hash($passwd, PASSWORD_BCRYPT);
	// return hash('sha256', $id).hash('whirlpool', $passwd);
}

function ft_error()
{
	if(isset($_SESSION['error']))
	{
		$tmp = $_SESSION['error'];
		$_SESSION['error'] = NULL;
		return $tmp;
	}
	else
		return "";
}

function password_secure($password)
{

	$error = "";
	if( strlen($password) < 8 ) 
		$error.= " trop court ";
		
	if( !preg_match("#[0-9]+#", $password) )
		$error.= "ne contenant pas de chiffre ";
		
	if( !preg_match("#[a-z]+#", $password) ) 
		$error.= "sans minuscule ";
		
	if( !preg_match("#[A-Z]+#", $password) ) 
		$error.= "sans majuscule ";
	
	if (!empty($error))
	{
		$_SESSION['error'] = "Mot de passe ".$error;
		return false;
	}

	else
		return true;
}