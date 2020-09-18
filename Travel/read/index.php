<?php
//header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/dbclass.php';
include_once '../../Travel.php';

$dbclass = new DBClass();
$connection = $dbclass->getConnection();
$travel = new Travel($connection);

$stmt = $travel->read();
$count = $stmt->rowCount();

if($count > 0){


    $Atravel = array();
    $Atravel["body"] = array();
    $Atravel["count"] = $count;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $values  = array(
              "id" => $id,
              "vehicle" => $vehicle,
              "vehicle_number" => $vehicle_number,
              "v_from" => $v_from,
              "v_to" => $v_to,
              "seat" => $seat,
              "gate" => $gate,
              "v_start" => $v_start,
              "v_end" => $v_end,
              "bag_conditions" => $bag_conditions,
              "createdAt" => $createdAt,
              "updatedAt" => $updatedAt    
              );

        array_push($Atravel["body"], $values);
    }
    ?>
    <html>
    <body>
        <div>
<?php
$sorted = sortTravel($Atravel["body"]);
echo $sorted;
?>
        </div>
    </body>
    </html>
<?php

}
else {

    echo json_encode( array("body" => array(), "count" => 0));

}
function sortTravel($array){
$answer = array();
array_push($answer, $array[0]);

$last=$array[0]['v_to'];
$start=$array[0]['v_from'];
array_splice($array, 0, 1);

// The IDEA to reorder. 
// If last TO is equal to some other FROM, this item is erased from array and placed in the end of answer 
// If last FROM is equal to other TO, this item is erased from array and placed in the begin

$other = true;
$tryes = (count($array)-1);
while($other){

    for($i=(count($array)-1); $i>=0;$i--)
    {
        if($last==$array[$i]['v_from'])
        {
            $last = $array[$i]['v_to'];
            array_push($answer, $array[$i]);
            array_splice($array, $i, 1);
        }
        else if($start==$array[$i]['v_to'])
        {
            $last = $array[$i]['v_from'];
            array_unshift($answer, $array[$i]);
            array_splice($array, $i, 1);
        }
    }
    if(count($array)<1){$other=false;}
    else
    {
        $tryes -=1;
        if($tryes<1)
        {
            echo "Error: Those tickets seems to refer to more than one travel;";
            $other=false;
        }
    }
}


$final_text='<ul>';
for($i=0;$i<count($answer);$i++)
{
   $final_text .= '<li>Take the '. $answer[$i]['vehicle'].' '. $answer[$i]['vehicle_number']. ' from '. $answer[$i]['v_from']. ' to '. $answer[$i]['v_to'].'.';
   if(isset($answer[$i]['gate']))
   {
    $final_text .= ' Gate '. $answer[$i]['gate'];
   }
   if(isset($answer[$i]['seat']))
   {
    $final_text .= ' seat '. $answer[$i]['seat'].'.';
   }
   else
   {
    $final_text .= ' No seat assignment.';
   }
   if(isset($answer[$i]['bag_conditions']))
   {
    $final_text .= ' Gate '. $answer[$i]['bag_conditions'].'.';
   }
   $final_text .= '</li>';
}
$final_text .= '</ul>';
return $final_text;
}
?>