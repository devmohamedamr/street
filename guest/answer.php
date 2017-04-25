<?php
require '../start.php';
if(!isset($_SESSION))
{
    session_start();
}
//---------------check permission -----------------------
//------------guest permission ------------------
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
    }elseif($admin)
    {
        header("LOCATION:../admin/welcome.php");
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
$ids = $_SESSION['user'][0]['id'];


require BACK . '/headerguest.html';
if(count($_POST)>0)
{
$ans  = new  quizz();
$answer =  $ans->answer($_POST);

    $total_qus=$answer['right']+$answer['wrong']+$answer['no_answer'];
    $attempt_qus=$answer['right']+$answer['wrong'];
    //to add answer for guest in db
    $test = R::dispense('test');
    $test->user_id = $ids;
    $test->r_ans = $answer['right'];
    $test->w_ans =   $answer['wrong'];
    $test->n_ans = $answer['no_answer'];
    $test->test_type = 1;
    $per=($answer['right']*100)/($total_qus);
    $test->result = $per."%";
    R::store($test);
    //-----------------------------
    require BACK . '/answer.html';
}
require BACK . '/footerguest.html';

