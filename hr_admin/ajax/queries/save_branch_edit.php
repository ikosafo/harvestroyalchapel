<?php

include("../../../config.php");


$branch_name=mysqli_real_escape_string($mysqli,$_POST['branch_name']);
$branch_code=mysqli_real_escape_string($mysqli,$_POST['branch_code']);
$branch_location=mysqli_real_escape_string($mysqli,$_POST['branch_location']);
$branch_id=mysqli_real_escape_string($mysqli,$_POST['branch_id']);



    $mysqli->query("UPDATE `branch`
SET 
  `name` = '$branch_name',
  `location` = '$branch_location',
  `code` = '$branch_code'
  
WHERE `id` = '$branch_id'")

    or die(mysqli_error($mysqli));

    echo 1;












?>