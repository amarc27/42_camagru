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
		echo 'Connection error: ' . $e->getMessage();
	}
}

function get_profile($login)
{
	$db = db_connect();
	$sql = $db->prepare("SELECT * FROM user WHERE login = :login");
    $sql->bindParam(":login", $login, PDO::PARAM_STR);
	$sql->execute();
	$res = $sql->fetch();
	$db = null;
	return $res; 
}

function hasher($passwd)
{
	return password_hash($passwd, PASSWORD_DEFAULT);
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

function lightModif()
{
	if(isset($_SESSION['lightModif']))
	{
		$tmp = $_SESSION['lightModif'];
		$_SESSION['lightModif'] = NULL;
		return $tmp;
	}
	else
		return "";
}

function password_secure($password)
{

	$error = "";
	if( strlen($password) < 8 ) 
		$error.= " too short ";
		
	if( !preg_match("#[0-9]+#", $password) )
		$error.= "| without numbers ";
		
	if( !preg_match("#[a-z]+#", $password) ) 
		$error.= "| without lowercase letters ";
		
	if( !preg_match("#[A-Z]+#", $password) ) 
		$error.= "| without uppercase letters ";
	
	if (!empty($error))
	{
		$_SESSION['error'] = "Password : ".$error;
		return false;
	}

	else
		return true;
}

function redir($redir_path)
{
    echo "<script>setTimeout(\"location.href = \'$redir_path\';\",2000);</script>";
}


/* GALLERY */

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