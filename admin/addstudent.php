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
$levels = R::findAll('level');
$payment = R::findAll('payment');

if(count($_POST)>0)
{
    //-------------store new student -------------
     $id = $_POST['id'];
     $level = $_POST['level'];
     $pay = $_POST['payment'];
    $student = new student();
    $student->add($id,$level,$pay,1);
    //------------update permissions -------------
    $s = R::load('users',$_POST['id']);
    $s->permission = 4;
    R::store($s);

    header("LOCATION:students.php");
}