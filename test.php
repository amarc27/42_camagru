<?php

require('model/generalModel.php');
include ('config/database.php');

$redir_path = "tata.php";

echo "<script>setTimeout(\"location.href = \'$redir_path\';\",2000);</script>";
