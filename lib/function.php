<?php

//-------------------check permission ------------

function check(){
    return (isset($_SESSION['user']))? true :false;
}

//------------date format --------------

function con2mysql($date) {

    $date = explode("-",$date);
    if ($date[0]<=9) { $date[0]="0".$date[0]; }
    if ($date[1]<=9) { $date[1]="0".$date[1]; }
    $date = array($date[2], $date[1], $date[0]);

    return $n_date=implode("-", $date);
}

//---------------- PASSWORD HASH --------------------------------

function hashing($password)
{
   return sha1('Academy&$@&'.md5(')(street25468'.$password.'english*#$%6!'));
}
