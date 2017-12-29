<?php

include_once(__DIR__ . '/../src/config.php');
include_once(__DIR__ . '/../src/functions.php');

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
        foreach($routes[$page] as $value)
        {
            if ($action === $value)
            {
                
                $matched = true;
                break;                
            } 
        }

        if ($matched)
        {
            $pageFile = PAGE . $page . '.php';
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
        foreach($routes[$page] as $value)
        {
            if ($action === $value)
            {
                
                $matched = true;
                break;                
            } 
        }

        if ($matched)
        {
            $pageFile = PAGE . $page . '.php';
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

$dbConnection = getDbConnection();

init($routes, $dbConnection);