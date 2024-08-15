<?php

const MYSQL_CONFIG = [
    'db_name' => 'socialhub',
    'db_host' => 'localhost',
    'db_user' => 'root',
    'db_password' => ''
];

$conn = new PDO("mysql:dbname=" . MYSQL_CONFIG['db_name'] . ';host=' . MYSQL_CONFIG['db_host'], MYSQL_CONFIG['db_user'], MYSQL_CONFIG['db_password']);