<?php

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/dbclass.php';

include_once '../../Travel.php';

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$travel = new Travel($connection);

$travel->purge();

echo ($travel->delete())?"Remove All":"Not Deleted";
?>