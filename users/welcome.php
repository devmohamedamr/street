<?php
require '../start.php';
if(!isset($_SESSION))
{
    session_start();
}
//------------users permission ------------------
if(!check())
{
    header("LOCATION:../login.php");
}elseif(check())
{
    $guest = $_SESSION['user'][0]['permission'] ==1;
    $instructor = $_SESSION['user'][0]['permission'] ==2;
    $admin = $_SESSION['user'][0]['permission'] ==3;
    $student = $_SESSION['user'][0]['permission'] ==4;

    if($admin)
    {
        header("LOCATION:../admin/welcome.php");
    }elseif($guest)
    {
        header("LOCATION:../guest/welcome.php");
    }elseif($instructor)
    {
        header("LOCATION:../instructor/welcome.php");
    }elseif($student)
    {
        header("LOCATION:../instructor/welcome.php");
    }
}