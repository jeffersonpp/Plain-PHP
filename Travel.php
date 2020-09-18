<?php
class Travel{

    // Connection instance
    private $connection;

    // table columns
    public $id;
    public $vehicle;
    public $vehicle_number;
    public $v_from;
    public $v_to;
    public $seat;
    public $gate;
    public $v_start;
    public $v_end; 
    public $bag_conditions;
    public $createdAt; 
    public $updatedAt;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }


    public function create(){
	$sql = $this->connection->prepare("INSERT INTO travel (vehicle, vehicle_number, v_from, v_to, seat, gate, v_start, v_end, bag_conditions, createdAt) VALUES (:vehicle, :vehicle_number, :v_from, :v_to, :seat, :gate, :v_start, :v_end, :bag_conditions, :createdAt)");
   
   
    if( $sql->execute([
        ':vehicle' => $this->vehicle, 
        ':vehicle_number'=>$this->vehicle_number, 
        ':v_from'=>$this->v_from, 
        ':v_to'=> $this->v_to, 
        ':seat'=>$this->seat,
        ':gate'=>$this->gate,
        ':v_start'=>$this->v_start,
        ':v_end'=>$this->v_end,
        ':bag_conditions'=>$this->bag_conditions,
        ':createdAt'=>$this->createdAt
    ])
    ){
        return true;
    }
    else{
        return false;
    }
    
    }


    public function delete()
    {
        $sql = $this->connection->prepare("DELETE FROM travel WHERE id=:identification");
        if( $sql->execute([':identification' => $this->id])){
            return true;
        }else{
            return false;
        }

    }

    public function read()
    {
        $query = "SELECT * FROM Travel";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function purge()
    {
        $sql = $this->connection->prepare("DELETE FROM travel");
        if( $sql->execute())
        {
            return true;
        }
        else
        {
            return false;
        }

    }
}