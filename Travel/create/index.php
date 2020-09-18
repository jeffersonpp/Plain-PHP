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

$data;// Allow json file to input data
if($data = json_decode(file_get_contents("php://input")))
{
$travel->vehicle = $data->vehicle;
$travel->vehicle_number = $data->vehicle_number;
$travel->v_from = $data->v_from;
$travel->v_to = $data->v_to;
$travel->seat = $data->seat;
$travel->gate = $data->gate;
$travel->v_start = date('Y-m-d H:i:s', strtotime($data->v_start));
$travel->v_end = date('Y-m-d H:i:s', strtotime($data->v_end));
$travel->bag_conditions = $data->bag_conditions;
$travel->createdAt = date('Y-m-d H:i:s');
}
else
{
$data = $_POST;
$travel->vehicle = $data['vehicle'];
$travel->vehicle_number = $data['vehicle_number'];
$travel->v_from = $data['v_from'];
$travel->v_to = $data['v_to'];
$travel->seat = $data['seat'];
$travel->gate = $data['gate'];
$travel->v_start = date('Y-m-d H:i:s', strtotime($data['v_start']));
$travel->v_end = date('Y-m-d H:i:s', strtotime($data['v_end']));
$travel->bag_conditions = $data['bag_conditions'];
$travel->createdAt = date('Y-m-d H:i:s');
}


if($travel->create()){
    echo '{';
        echo '"message": "Travel was created."';
    echo '}';
}
else{
    echo '{';
        echo '"message": "Unable to create travel."';
    echo '}';
}
?>