<?php
$final_str = "                 s";

if (preg_match('/[\S]+/', $final_str) == 1)
    echo "Ok";
else
    echo "Pas ok du tout";
?>