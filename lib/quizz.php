<?php
if(!isset($_SESSION))
{
    session_start();
}
class quizz
{
    private $connection;

    //connection
    public function __construct()
    {
        $this->connection = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    }

    public function answer($data)
    {
        //$ans = implode("", $data);
        $right = 0;
        $wrong = 0;
        $no_answer = 0;
        $questions = R::findAll('questions');
        foreach($questions as $qust)
            if ($qust->answer == $_POST[$qust->id]) {
                $right++;
            } elseif ($_POST[$qust->id] == "no_attempt") {
                $no_answer++;
            } else {
                $wrong++;
            }
        $array = array();
        $array['right'] = $right;
        $array['wrong'] = $wrong;
        $array['no_answer'] = $no_answer;
        return $array;
    }
    public function get($extra = '')
    {
        $result = $this->connection->query("SELECT * FROM `test` $extra ");
        if ($result->num_rows > 0) {

            $products = array();
            while ($row = $result->fetch_assoc()) {

                $products[] = $row;
            }
            return $products;
        }
        return null;
    }
    public function gettest($extra = '')
    {
        $result = $this->connection->query("SELECT * FROM `test` $extra ");
        if ($result->num_rows > 0) {

            $products = array();
            while ($row = $result->fetch_assoc()) {

                $products[] = $row;
            }
            return $products;
        }
        return null;
    }


    public function time($id)
    {
        $result = $this->connection->query("SELECT * FROM `test_type` where id = '$id' ");
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