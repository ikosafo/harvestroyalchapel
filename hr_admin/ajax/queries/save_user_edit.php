<?php

include("../../../config.php");


$user_id = mysqli_real_escape_string($mysqli,$_POST['user_id']);
$full_name = mysqli_real_escape_string($mysqli,$_POST['full_name']);
$username = mysqli_real_escape_string($mysqli,$_POST['username']);
$user_branch = mysqli_real_escape_string($mysqli,$_POST['user_branch']);

$getid = $mysqli->query("select * from branch where name = '$user_branch'");
$resid = $getid->fetch_assoc();
$user_branch_id = $resid['id'];



    $mysqli->query("UPDATE `users_admin`
SET 
  `fullname` = '$full_name',
  `username` = '$username',
  `branch` = '$user_branch_id'
  
WHERE `id` = '$user_id'")
    or die(mysqli_error($mysqli));

    echo 1;










?>