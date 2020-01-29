<?php
session_start();

require('model/generalModel.php');
include ("config/database.php");

if (isset($_POST['submit']))
{
    $_POST['login'] = strip_tags($_POST['login']);
	$_POST['mail'] = strip_tags($_POST['mail']);
	$_POST['name'] = strip_tags($_POST['name']);
	$_POST['passwd'] = strip_tags($_POST['passwd']);
	$_POST['passwd2'] = strip_tags($_POST['passwd2']);
}

if ((empty($_POST['login']) || empty($_POST['mail']) || empty($_POST['name']) || empty($_POST['passwd']) || empty($_POST['passwd2'])) && isset($_POST['submit']))
    $_SESSION['error'] = "Champs incomplets";


$error = ft_error();

print_r($_SESSION);

require('./view/signupView.php');