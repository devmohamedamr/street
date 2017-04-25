<?php
class student
{
    private $connection;

    //connection
    public function __construct()
    {
        $this->connection = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    }

    public function add($id,$level,$payment,$status){
        $this->connection->query("INSERT INTO `student`(id_user,level_id,payment_id,status_id) VALUES ('$id','$level','$payment','$status')");
        if($this->connection->affected_rows >0){
            return true;
        }
        return false;
    }

}