<?php

include_once(__DIR__ . '/../app/config/config.constants.php');
include_once(__DIR__ . '/../app/config/config.routes.php');
include_once(__DIR__ . '/../app/lib/functions.php');
include_once(__DIR__ . '/../app/lib/database.php');

function init($routes, $dbConnection)
{
    $httpMethod = httpMethod();

    switch ($httpMethod) {
        case 'GET':
            doGet($routes, $dbConnection);
            break;

        case 'POST':
            doPost($routes, $dbConnection);
            break;

        default:
            break;
    }
}

function doGet($routes, $dbConnection)
{
    $page = getParam('p');
    $action = getParam('a');

    if ($page === NULL)
    {
        $page = DEFAULT_PAGE;
    }

    if ($action === NULL)
    {
        $action = DEFAULT_ACTION;
    }

    if (array_key_exists($page, $routes)) {
        $matched = false;
        foreach($routes as $key => $value)
        {
            if ($action === $value)
            {
                $matched = true;
                break;                
            } 
        }

        if ($matched)
        {
            $pageFile = __DIR__ . '/../app/page/' . $page . '.php';
            if (file_exists($pageFile))
            {
                include_once($pageFile);
                $action($dbConnection);
            }
        } else {
            echo 'Error 404<br>Page not found';
        }
        
    } else {
        echo 'Error 404<br>Page not found';
    }
}

function doPost($routes, $dbConnection)
{

}

$dbConnection = getDbConnection();
init($routes, $dbConnection);