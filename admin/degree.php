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
$id = (isset($_GET['id']))? (int)$_GET['id'] : 0;
//------------------------------------------------
$test = new quizz();
$result =  $test->get("WHERE user_id = $id");
$levels = R::findAll('level');
$payment = R::findAll('payment');

//------------view data by session--------
$name = $_SESSION['user'][0]['firstname'];
$photo = $_SESSION['user'][0]['photo'];
$date = $_SESSION['user'][0]['date'];
//---------design--------------
require BACK . '/headeradmin.html';
require BACK.'/degree.html';
require BACK . '/footeradmin.html';