<?php

include_once 'dbclass.php';
try 
{
  $dbclass = new DBClass();

  $connection = $dbclass->getConnection();
  $sql = file_get_contents("create_tables.sql"); 
  $connection->exec($sql);
  echo "All Done!";
}
catch(PDOException $e)
{
    echo $e->getMessage();
}