<?php

date_default_timezone_set('UTC');

$mysqli= new mysqli('localhost:3308','root','root','church_it');
if($mysqli->connect_errno){
    echo"cannot connect MYSQLI error no{$mysqli->connect_errno}:{$mysqli->connect_errno}";
    exit();
}
session_start();

$reg_root = 'http://church.local';


function lock($item){

    return base64_encode(base64_encode(base64_encode($item)));
}
function unlock($item){

    return base64_decode(base64_decode(base64_decode($item)));
}

?>


