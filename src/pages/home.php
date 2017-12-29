<?php

define('HOME', 'home/');

function index()
{
    $pageName = 'Home';

    include_once(TEMPLATES . HOME . 'index.php');
}