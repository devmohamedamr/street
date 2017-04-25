<?php

class users
{
    private $connection;

    //connection
    public function __construct()
    {
        $this->connection = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    }

    public function getusers($extra = '')
    {
        $result = $this->connection->query("SELECT * FROM `users` $extra ");
        if ($result->num_rows > 0) {

            $products = array();
            while ($row = $result->fetch_assoc()) {

                $products[] = $row;
            }
            return $products;
        }
        return null;
    }

    public function userlevel()
    {
        $result = $this->connection->query("SELECT * ,users.firstname, level.level_name ,student.payment_id FROM `student`
INNER JOIN users on student.id_user = users.id
INNER JOIN level on student.level_id = level.id
INNER JOIN payment on student.payment_id = payment.id");
        if ($result->num_rows > 0) {

            $products = array();
            while ($row = $result->fetch_assoc()) {

                $products[] = $row;
            }
            return $products;
        }
        return null;
    }
}