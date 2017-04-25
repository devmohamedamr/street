<?php
if(!isset($_SESSION))
{
    session_start();
}
class Data
{
    /**
     * @param $number
     * @param $fb
     * @return bool
     * duplicate check before adding into database
     */
    public function unique($number,$fb)
    {

        $sql = "SELECT * FROM users WHERE  number = '$number' OR fb= '$fb'";
        $rows = R::getAll($sql);
        $data = R::convertToBeans('data',$rows);

        return $data;
    }
}