<?php
require 'start.php';
if(!isset($_SESSION))
{
    session_start();
}
//---------------------check permissions --------------
if(check())
{
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
//------------------------end permission----------------
//------------------------------validation--------------------------
$validation = new \Hispanic\Validation();

$rules  = array(
    'fname'=>'required|min_length:2|max_length:50|name',
    'lname'=>'required|min_length:2|max_length:50|name',
    'date'=>'required',
    'phone'=>'required',
    'facebook'=>'required',
    'date'=>"required|date:Y-m-d",
    'city'=>'required|min_length:4|max_length:100',
    'address'=>'required|min_length:4|max_length:150',
    'password'=>'required|between:6-30',
    'rpassword'=>'required|equalsTo:password',
);
$validation->server($rules);
$errors = null;
//--------------------------end validations--------------------------------
if(count($_POST)>0)
{
    //--------unique class
    $un = new Data();
    $phone = $_POST['phone'];
    $fb = $_POST['facebook'];
    //------------validation-----------
    if (!$validation->isValid())
    {
        $errors = $validation->getErrors();
      /**
       * unique function
       * duplicate check before adding into database
       * */
    }elseif(empty($un->unique($phone,$fb)))
    {
        //---------password hash ------
        $password = $_POST['password'];
        $hash = hashing($password);
        //---------store in db-----------
        $data = R::dispense('users');
        $data->firstname = $_POST['fname'];
        $data->lastname = $_POST['lname'];
        $data->date = $_POST['date'];
        $data->email = $_POST['email'];
        $data->number = $_POST['phone'];
        $data->fb = $_POST['facebook'];
        $data->city = $_POST['city'];
        $data->address = $_POST['address'];
        $data->password = $hash;
        $data->permission = 1;
        $data->photo = "user.png";
        R::store($data);
        //-------------end store------
        header('LOCATION:login.php');
    }
    //---------store data in session
    $_SESSION['first'] = $_POST['fname'];
    $_SESSION['last'] = $_POST['lname'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['date'] = $_POST['date'];
    $_SESSION['phone'] = $_POST['phone'];
    $_SESSION['facebook'] = $_POST['facebook'];
    $_SESSION['city'] = $_POST['city'];
    $_SESSION['address'] = $_POST['address'];
    //--------end ----------------------
}

//------------------view all data-------------------
require BACK . '/register.html';