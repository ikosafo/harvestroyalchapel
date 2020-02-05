<?php

date_default_timezone_set('UTC');

/*$mysqli= new mysqli('localhost','u349494272_royal','Is0501375050','u349494272_harvestroyal');
if($mysqli->connect_errno){
    echo "Cannot connect MYSQLI error no{$mysqli->connect_errno}:{$mysqli->connect_errno}";
    exit();
}*/


$mysqli= new mysqli('localhost:3308','root','root','harvestroyal');
if($mysqli->connect_errno){
    echo"cannot connect MYSQLI error no{$mysqli->connect_errno}:{$mysqli->connect_errno}";
    exit();
}

/*$mysqli= new mysqli('localhost','u349494272_root','Is0205737464','u349494272_cvsi');
if($mysqli->connect_errno){
    echo"cannot connect MYSQLI error no{$mysqli->connect_errno}:{$mysqli->connect_errno}";
    exit();
}*/
session_start();

//$reg_root = 'http://church.local';


function lock($item){

    return base64_encode(base64_encode(base64_encode($item)));
}
function unlock($item){

    return base64_decode(base64_decode(base64_decode($item)));
}


function curl_get_contents($url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}


?>

