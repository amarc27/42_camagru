<?php
require('model/generalModel.php');
include ("config/database.php");

$login = "toto";
$mail = "noltuteltu@enayu.com";
$name = "Tototo42";
$pass = "Tototo42";

ft_user_new($login, $mail, $name, $pass);
