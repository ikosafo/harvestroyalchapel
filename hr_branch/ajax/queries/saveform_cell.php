<?php

include('../../../config.php');


$cell_name = mysqli_real_escape_string($mysqli, $_POST['cell_name']);
$cell_id = mysqli_real_escape_string($mysqli, $_POST['cell_id']);
$branch = $_SESSION['branch'];


$chk = $mysqli->query("select * from cell where cell_id = '$cell_id'");

$count = mysqli_num_rows($chk);

$ct = mysqli_num_rows($mysqli->query("select * from cell where cell_name = '$cell_name' AND branch = '$branch'"));


if ($count == "0") {

    if ($ct == "0") {


        $mysqli->query("INSERT INTO `cell`
            (`cell_name`,
             `cell_id`,
             `branch`)
VALUES ('$cell_name',
        '$cell_id',
        '$branch'
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

        $mysqli->query(" UPDATE `cell`
SET 
  `cell_name` = '$cell_name'
  
WHERE `cell_id` = '$cell_id'") or die(mysqli_error($mysqli));

        echo 3;

    }

    else {

        echo 4;
    }

}
?>