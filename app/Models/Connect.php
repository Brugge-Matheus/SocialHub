<?php

function connect(): PDO
{
    try {
        $pdo = new PDO("mysql:host=" . MYSQL_CONFIG['db_host'] . ";dbname=" . MYSQL_CONFIG['db_name'], MYSQL_CONFIG['db_user'], MYSQL_CONFIG['db_password']);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        dd($e);
    }
}
