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
//-----------database--------------------
$st = new users();
$students = count($st->getusers('WHERE permission = 4'));
$users = count($st->getusers('WHERE permission = 5'));
$instructor = count($st->getusers('WHERE permission = 2'));
$guest = count($st->getusers('WHERE permission = 1'));
//-----------chart info---------------
$att = new attendance();
$attendance =  $att->get();
//---------design--------------
require BACK . '/headeradmin.html';
require BACK . '/dashboard.html';
require BACK . '/footeradmin.html';