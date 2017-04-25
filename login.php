<?php
if(!isset($_SESSION))
{
    session_start();
}
require 'start.php';

//-----------------check---------
if(check()) {
    $guest = $_SESSION['user'][0]['permission'] ==1;
    $instructor = $_SESSION['user'][0]['permission'] ==2;
    $admin = $_SESSION['user'][0]['permission'] ==3;
    $student = $_SESSION['user'][0]['permission'] ==4;
    $users = $_SESSION['user'][0]['permission'] ==5;
    if($guest)
    {
        header("LOCATION:guest/welcome.php");
    }elseif($instructor)
    {
        header("LOCATION:instructor/welcome.php");
    }elseif($admin)
    {
        header("LOCATION:admin/welcome.php");
    }elseif($student)
    {
        header("LOCATION:student/welcome.php");
    }elseif($users)
    {
        header("LOCATION:users/welcome.php");
    }
}
//print_r($_SESSION['user']);

//-------------validation-------------------
$validation = new \Hispanic\Validation();

$rules  = array(
    'phone'=>'required',
    'password'=>'required',
);
$validation->server($rules);
//-------------------------------------
$errors = null;

if(count($_POST)>0) {
    if (!$validation->isValid()) {
        $errors = $validation->getErrors();
    } else {
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        //-------------hash password-------------
        $hash = hashing($password);
        //----------end hash-------------------
        $data = R::getAll("SELECT * FROM users WHERE number='$phone' AND password = '$hash'");
        if ($data && count($data) > 0) {
            $_SESSION['user'] = $data;
           $permission = $_SESSION['user'][0]['permission'];

            if($permission == 1) {
                header("LOCATION:guest/start.php");
            } elseif ($permission == 2) {
                header("LOCATION:instructor/welcome.php");
            } elseif ($permission == 3) {
                header("LOCATION:Admin/welcome.php");
            } elseif($permission == 4) {
                header("LOCATION:student/welcome.php");
            } elseif($permission == 5) {
                header("LOCATION:users/welcome.php");
            }
        }

    }
}
//-----------------view design-------------------
require BACK.'/login.html';
