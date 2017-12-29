<?php

define('APPLICATION_NAME', 'Procedural PHP');

// Database
define('DB_VENDOR', 'mysql');
define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_NAME', 'proceduralphp');
define('DB_CHARSET', 'utf-8');
define('DB_USER', 'root');
define('DB_PASSWORD', 'admin123');

define('DEFAULT_PAGE', 'home');
define('DEFAULT_ACTION', 'index');
define('PAGE', __DIR__ . '/../src/pages/');
define('TEMPLATES', __DIR__ . '/../templates/');

// Routes
$routes = [
    DEFAULT_PAGE => [ 
        DEFAULT_ACTION
    ],
    'student' => [
        DEFAULT_ACTION,
        'add',
        'update',
        'edit',
        'view',
        'delete'
    ]
];