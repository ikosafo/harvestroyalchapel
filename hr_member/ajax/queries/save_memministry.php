<?php

include('../../config.php');


$memberid = mysqli_real_escape_string($mysqli, $_POST['member_id']);
$mem_department = mysqli_real_escape_string($mysqli, $_POST['mem_department']);
$mem_ministry = mysqli_real_escape_string($mysqli, $_POST['mem_ministry']);
$mem_cell = mysqli_real_escape_string($mysqli, $_POST['mem_cell']);


$datetime = date("Y-m-d H:i:s");



$mysqli->query("UPDATE `member`

SET 

  `department` = '$mem_department',
  `ministry` = '$mem_ministry',
  `cell` = '$mem_cell'
  
WHERE `memberid` = '$memberid'") or die(mysqli_error($mysqli));



echo 1;



?>