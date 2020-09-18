<?php
include_once 'config/dbclass.php';
include_once 'Travel.php';


$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$traveling = new Travel($connection);
$travels = $traveling->read();

?>
<html>
    <head>
        <style>
            table
            { 
                width:80%;
                margin-left:10%;
                border: solid 1ps #333;
                border-radius:4px;
                box-shadow: 1px 0px 3px #333;
            }
            table tr td
            {
                border-bottom:solid 1px #BBB;
                margin:0;
                padding:0;
                display:table-cell;

            }
            div h2
            {
                text-align:center;
                margin-left:-25%;
            }
            .center
            {
                text-align:center;
                margin:auto;
            }
        </style>        
    </head>
    <body>
        <div>
            <h2>Travels</h2>
        </div>
        <table>
            <tr>
                <td>Vehicle</td> 
                <td>Vehicle Number</td> 
                <td>From</td> 
                <td>To</td> 
                <td>Seat</td> 
                <td>Gate</td> 
                <td>Start</td> 
                <td>End</td> 
                <td>Bag C</td> 
            </tr>
            <?php 


            while($travel = $travels->fetch(PDO::FETCH_ASSOC))
            {
                extract($travel);


            ?>
            <tr>
                <td><?=$vehicle ?></td> 
                <td><?=$vehicle_number  ?></td> 
                <td><?=$v_from    ?></td> 
                <td><?=$v_to      ?></td> 
                <td><?=$seat    ?></td> 
                <td><?=$gate    ?></td> 
                <td><?=$v_start   ?></td> 
                <td><?=$v_end     ?></td> 
                <td><?=$bag_conditions  ?></td> 
                <td>
                    <form action="./Travel/delete/index.php" method="POST">
                    <input type="hidden" name="id" value="<?=$id?>">
                        <input type="submit" value="DELETE">        
                    </form>
                </td> 
            </tr>
            <?php
            }
            ?>
            <tr>
            <td colspan="3" class="center"><a href="create.html">Criar Viagem</a></td> 
            <td colspan="4" class="center"><a href="./Travel/read">Verificar Destino</a></td> 
            <td colspan="3" class="center"><a href="./Travel/purge">Delete All</a></td> 
            </tr>
        </table>
    </body>
</html>
