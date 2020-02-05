<?php
session_start();

require('model/generalModel.php');
include ('config/database.php');

$profile = get_profile($_SESSION['login']);

require('./view/accountView.php');