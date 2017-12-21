<?php

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