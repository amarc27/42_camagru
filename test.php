<?php

require('model/generalModel.php');
include ('config/database.php');

$sticker = 2;

if (true)
{
    if (get_one_sticker($sticker) !== false)
        echo "Ce sticker existe";
    else
        echo "Ce sticker n'existe pas";
}
if (true)
{
    if (get_one_sticker($sticker) !== false)
        echo "Ce sticker existe";
    else
        echo "Ce sticker n'existe pas";
}