<?php
session_start();

require('model/generalModel.php');
include ("config/database.php");

if ((empty($_POST['login']) || empty($_POST['passwd'])) && isset($_POST['submit']))
	$_SESSION['error'] = "Champs incomplets";
else if (isset($_POST['login']) && isset($_POST['passwd']) && isset($_POST['submit']) )
	if(check_user($_POST['login'], $_POST['passwd']))
		header('Location: ./account.php');

$error = ft_error();

require('view/loginView.php');