<?php

//header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/dbclass.php';

include_once '../../Travel.php';

$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$travel = new Travel($connection);


$data;// Allow json file to input data and POST method
if($data = json_decode(file_get_contents("php://input")))
{
    $travel->id = $data->id;
}
else
{
    $data = $_POST;
    $travel->id = $data['id'];
}
echo ($travel->delete())?"Successfully deleted":"Not Deleted";
?>

<html>
<script>
window.onload=function()
{
    setTimeout(() => {
        window.open("../../", "_self");
    }, 2000);
}
</script>
</html>