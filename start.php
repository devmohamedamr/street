<?php
//-------------root-----------------
define('ROOT',dirname(__FILE__));
define('ADMIN',ROOT.'/admin');
define('GUEST',ROOT.'/guest');
define('INSTRUCTOR',ROOT.'/instructor');
define('STUDENTS',ROOT.'/student');
define('DESIGN',ROOT.'/design');
define('BACK',DESIGN.'/back');
define('FRONT',DESIGN.'/front');
define('LIB',ROOT.'/lib');
//-------------files------------------
require LIB.'/rb.php';
require LIB.'/Validation.php';
require LIB.'/function.php';
require LIB.'/upload.class.php';
require LIB.'/data.php';
require LIB.'/users.php';
require LIB.'/quizz.php';
require LIB.'/student.php';
require LIB.'/attendance.php';
require LIB.'/translate/translate.php';
//--------------------database config ---------------
define('DB_TYPE','mysql');
define('DB_NAME','street');
define('DB_USER','root');
define('DB_PASS','');
define('DB_HOST','localhost');
//---------------database connection -----------------
R::setup(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS); //for both mysql or mariaDB
//R::debug( TRUE );
