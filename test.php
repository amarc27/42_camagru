<?php
$str = 'foobarbaz';

if (preg_match('/(\t|\s|\n|\v|\f|\r|\0)+/', $str) == true)
    echo "machine invalide";
else
    echo "good work boys";