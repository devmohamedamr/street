<?php
if(!isset($_SESSION))
{
    session_start();
}
session_destroy();
//----------------logout -----------
header('LOCATION:login.php');