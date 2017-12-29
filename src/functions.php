<?php

function getDbConnection()
{
    $dns = DB_VENDOR . ':host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';char-set=' . DB_CHARSET; 
    $connection = new PDO($dns, DB_USER, DB_PASSWORD);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $connection;
}

function httpMethod() {
    return isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
}

function getParam($param = NULL)
{
    return isset($_GET[$param]) ? $_GET[$param] : NULL;
}

function postParam($param = NULL)
{
    return isset($_POST[$param]) ? $_POST[$param] : NULL;
}