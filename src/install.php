<?php

if (!file_exists('db')) {
    mkdir('db');
}
if (!file_exists('db/users')) {
    file_put_contents('./db/users', null);
}
if (!file_exists('db/products')) {
    file_put_contents('./db/products', null);
    }


?>
