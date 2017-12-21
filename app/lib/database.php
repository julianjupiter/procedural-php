<?php

function getDbConnection()
{
    $dns = 'mysql:host=localhost;port=3306;dbname=simplephp;char-set=utf-8'; 
    $connection = new PDO($dns, 'root', 'admin');
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $connection;
}