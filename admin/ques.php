<?php
require '../start.php';
if(!isset($_SESSION))
{
    session_start();
}
//------------admin permission ------------------
if(!check())
{
    header("LOCATION:../login.php");
}elseif(check())
{
    $guest = $_SESSION['user'][0]['permission'] ==1;
    $instructor = $_SESSION['user'][0]['permission'] ==2;
    $admin = $_SESSION['user'][0]['permission'] ==3;
    $student = $_SESSION['user'][0]['permission'] ==4;
    $users = $_SESSION['user'][0]['permission'] ==5;

    if($instructor)
    {
        header("LOCATION:../instructor/welcome.php");
    }elseif($guest)
    {
        header("LOCATION:../guest/welcome.php");
    }elseif($student)
    {
        header("LOCATION:../student/welcome.php");
    }elseif($users)
    {
        header("LOCATION:../users/welcome.php");
    }

}
//------------view data by session--------
$name = $_SESSION['user'][0]['firstname'];
$photo = $_SESSION['user'][0]['photo'];
$date = $_SESSION['user'][0]['date'];
//------------------------------validation--------------------------
$validation = new \Hispanic\Validation();

$rules  = array(
    'ques'=>'required',
    'chone'=>'required',
    'chtwo'=>'required',
    'chthree'=>'required',
    'select'=>'required',
);
$validation->server($rules);
$errors = null;
$success = '';
//--------------------------end validations--------------------------------
if(count($_POST)>0) {

    //------------validation-----------
    if (!$validation->isValid()) {
        $errors = $validation->getErrors();
    }
    else{

            //---------store in db-----------
            $data = R::dispense('questions');
            $data->qus = $_POST['ques'];
            $data->ans1 = $_POST['chone'];
            $data->ans2 = $_POST['chtwo'];
            $data->ans3 = $_POST['chthree'];
            $data->answer = $_POST['answer'];
            $data->cat_id = $_POST['select'];
            $data->test_type = $_POST['general'];
            R::store($data);
            $success = 'add success';
            //-------------end store------
            //header('LOCATION:ques.php');
        }
}

$data = R::findAll('qus_cat');
$questions = R::findAll('questions');
$time = R::findAll('test_type');
//----------end db--------
//---------design--------------
require BACK . '/headeradmin.html';
require BACK.'/ques.html';
require BACK . '/footeradmin.html';