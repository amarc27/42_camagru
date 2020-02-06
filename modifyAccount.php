<?php
session_start();

require('model/generalModel.php');
include ('config/database.php');

if(empty($_SESSION['login']))
    header('Location: login.php');

$profile = get_profile($_SESSION['login']);

require('./view/modifyAccountView.php');