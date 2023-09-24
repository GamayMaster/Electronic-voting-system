<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    switch($_SERVER['REQUEST_URI'])
    {
        case '/':
        case '/home':
            require_once(__DIR__ . '/home.php');
            break;
        case '/admin':
            require_once(__DIR__ . '/admin_panel/login.php');
            break;
        default:
            require_once(__DIR__ . '/notFound.php');
            break;
    }
}

?>