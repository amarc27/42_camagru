<?php
require("model/generalModel.php");

// $toto = 'amarc';

// if (ft_login_exist($toto))
//     echo "This login already exists";
// else
//     echo "This login does not exists";

$filename = './config/database.php';

if (file_exists($filename)) {
    echo "Le fichier $filename existe.";
} else {
    echo "Le fichier $filename n'existe pas.";
}