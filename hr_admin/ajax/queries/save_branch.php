<?php

include("../../../config.php");

$branch_name=mysqli_real_escape_string($mysqli,$_POST['branch_name']);
$branch_code=mysqli_real_escape_string($mysqli,$_POST['branch_code']);
$branch_location=mysqli_real_escape_string($mysqli,$_POST['branch_location']);

$res=$mysqli->query("select * from branch where `name` = '$branch_name'");
$rowcount = mysqli_num_rows($res);


if ($rowcount == "0"){



    $mysqli->query("INSERT INTO `branch`
            (`name`,
             `location`,
             `code`)
VALUES ('$branch_name',
        '$branch_location',
        '$branch_code')")
    or die(mysqli_error($mysqli));

    echo 1;

}

else {


    echo 2;

}










?>