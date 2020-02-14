<?php

require('model/generalModel.php');
include ('config/database.php');

print_r($_GET);
$var = $_GET['action'];
echo $var;