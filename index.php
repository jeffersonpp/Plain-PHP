<?php

$redirect = $_SERVER['REQUEST_URI']; // You can also use $_SERVER['REDIRECT_URL'];
$URL_BASE = "routing";
$direction = str_replace("/".$URL_BASE,"",$redirect);


switch ($direction) {
    case '/'  :
    case ''   :
        require __DIR__ . '/list.php';
        break;

    case '/create' :
        require __DIR__ . '/create.html';
        break;
    default:
        require __DIR__ . '/404.php';
        break;
    }
?>