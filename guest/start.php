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

require BACK . '/headerguest.html';
require BACK . '/gueststart.html';
require BACK . '/footerguest.html';
