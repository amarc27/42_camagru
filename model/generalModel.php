<?php
include ('userModel.php');
include ('cameraModel.php');
include ('galleryModel.php');


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

function get_profile($login) {
	$db = db_connect();
	$sql = $db->prepare("SELECT * FROM user WHERE login = :login");
    $sql->bindParam(":login", $login, PDO::PARAM_STR);
	$sql->execute();
	$res = $sql->fetch();
	$db = null;
	return $res; 
}

function get_profile_from_id($id_user) {
	$db = db_connect();
	$sql = $db->prepare("SELECT * FROM user WHERE id = :id_user");
    $sql->bindParam(":id_user", $id_user, PDO::PARAM_STR);
	$sql->execute();
	$data = $sql->fetch();
	$db = null;
	return $data; 
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

function profileModif()
{
	if(isset($_SESSION['profileModif']))
	{
		$tmp = $_SESSION['profileModif'];
		$_SESSION['profileModif'] = NULL;
		return $tmp;
	}
	else
		return "";
}

function passwdModif()
{
	if(isset($_SESSION['passwdModif']))
	{
		$tmp = $_SESSION['passwdModif'];
		$_SESSION['passwdModif'] = NULL;
		return $tmp;
	}
	else
		return "";
}

function deleteAccount()
{
	if(isset($_SESSION['deleteAccount']))
	{
		$tmp = $_SESSION['deleteAccount'];
		$_SESSION['deleteAccount'] = NULL;
		return $tmp;
	}
	else
		return "";
}

function receiveMailModif()
{
	if(isset($_SESSION['receiveMailModif']))
	{
		$tmp = $_SESSION['receiveMailModif'];
		$_SESSION['receiveMailModif'] = NULL;
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

function delete_item($table, $field, $id)
{
	$db = db_connect();
	$sql = "DELETE FROM ".$table."  WHERE ".$table.".".$field." = '".$id."'";
	$db->query($sql);
	$db = null;
}