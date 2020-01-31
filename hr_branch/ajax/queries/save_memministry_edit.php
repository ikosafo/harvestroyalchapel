<?php

include('../../../config.php');


$memberid = mysqli_real_escape_string($mysqli, $_POST['member_id']);
$mem_department = mysqli_real_escape_string($mysqli, $_POST['mem_department']);
$mem_ministry = mysqli_real_escape_string($mysqli, $_POST['mem_ministry']);
$mem_cell = mysqli_real_escape_string($mysqli, $_POST['mem_cell']);


$getidd = $mysqli->query("select * from department where department_name = '$mem_department'");
$residd = $getidd->fetch_assoc();
$deptid = $residd['id'];

if ($mem_department == "None"){
    $deptid = 'None';
}




$getidm = $mysqli->query("select * from ministry where ministry_name = '$mem_ministry'");
$residm = $getidm->fetch_assoc();
$memid = $residm['id'];

if ($mem_ministry == "None"){
    $memid = 'None';
}




$getidc = $mysqli->query("select * from cell where cell_name = '$mem_cell'");
$residc = $getidc->fetch_assoc();
$cellid = $residc['id'];

if ($mem_cell == "None"){
    $cellid = 'None';
}







$datetime = date("Y-m-d H:i:s");



$mysqli->query("UPDATE `member`

SET 

  `department` = '$deptid',
  `ministry` = '$memid',
  `cell` = '$cellid'
  
WHERE `memberid` = '$memberid'") or die(mysqli_error($mysqli));



echo 1;



?>