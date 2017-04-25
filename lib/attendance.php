<?php
if(!isset($_SESSION))
{
    session_start();
}
class attendance
{
    private $connection;

    //connection
    public function __construct()
    {
        $this->connection = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    }
    public function get()
    {
        $result = $this->connection->query("SELECT month, number FROM attendance ORDER BY month");
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