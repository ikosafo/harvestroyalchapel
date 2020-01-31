<?php

include('../../../config.php');


$department_name = mysqli_real_escape_string($mysqli, $_POST['department_name']);
$department_id = mysqli_real_escape_string($mysqli, $_POST['department_id']);
//$branch = $_SESSION['branch'];


$chk = $mysqli->query("select * from department where department_id = '$department_id'");

$count = mysqli_num_rows($chk);

$ct = mysqli_num_rows($mysqli->query("select * from department where department_name = '$department_name'"));


if ($count == "0") {

    if ($ct == "0") {


        $mysqli->query("INSERT INTO `department`
            (`department_name`,
             `department_id`)
VALUES ('$department_name',
        '$department_id'
        )")
        or die(mysqli_error($mysqli));

        echo 1;

    }

    else {

        echo 2;
    }


}

else {

    if ($ct == "0") {

        $mysqli->query(" UPDATE `department`
SET 
  `department_name` = '$department_name'
  
WHERE `department_id` = '$department_id'") or die(mysqli_error($mysqli));

        echo 3;

    }

    else {

        echo 4;
    }

}
?>