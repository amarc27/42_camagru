<?php

include ('userModel.php');

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