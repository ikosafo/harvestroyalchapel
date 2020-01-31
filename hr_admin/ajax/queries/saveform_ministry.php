<?php

include('../../../config.php');


$ministry_name = mysqli_real_escape_string($mysqli, $_POST['ministry_name']);
$ministry_id = mysqli_real_escape_string($mysqli, $_POST['ministry_id']);
//$branch = $_SESSION['branch'];


$chk = $mysqli->query("select * from ministry where ministry_id = '$ministry_id'");

$count = mysqli_num_rows($chk);

$ct = mysqli_num_rows($mysqli->query("select * from ministry where ministry_name = '$ministry_name'"));


if ($count == "0") {

    if ($ct == "0") {


        $mysqli->query("INSERT INTO `ministry`
            (`ministry_name`,
             `ministry_id`)
VALUES ('$ministry_name',
        '$ministry_id'
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

        $mysqli->query(" UPDATE `ministry`
SET 
  `ministry_name` = '$ministry_name'
  
WHERE `ministry_id` = '$ministry_id'") or die(mysqli_error($mysqli));

        echo 3;

    }

    else {

        echo 4;
    }

}
?>