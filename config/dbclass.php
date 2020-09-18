<?php
class DBClass {

    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "TESTE_DATABASE";
    private $connection = null;

    // get the database connection
    public function getConnection(){

//        $this->connection = null;

        try{
            $this->connection = new PDO("mysql:host=" . $this->host.";", $this->username, $this->password);
            if ($this->connection->connect_error) {
                die("Connection failed: " . $this->connection->connect_error);
            }
            $this->connection ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $create_query = "CREATE DATABASE IF NOT EXISTS ". $this->database;
            if($this->connection->exec($create_query))
            {
            }
            else
            {
                die("DB NOT Created: " . $this->connection->error);
            }

            $this->connection->exec("use ".$this->database);
            $this->connection->exec("set names utf8");

        }catch(PDOException $exception){
            echo "Error: " . $exception->getMessage();
        }
        return $this->connection;
    }
}
?>