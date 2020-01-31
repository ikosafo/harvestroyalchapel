<?php

include('../../../config.php');


$full_name = mysqli_real_escape_string($mysqli, $_POST['full_name']);
$telephone = mysqli_real_escape_string($mysqli, $_POST['telephone']);
$denomination = mysqli_real_escape_string($mysqli, $_POST['denomination']);

$branch = $_SESSION['branch'];


$period = date("Y-m-d H:i:s");


$ct = mysqli_num_rows($mysqli->query("select * from `f_partners` where telephone = '$telephone' 
                                            AND branch = '$branch'"));


if ($ct == "0") {


    $mysqli->query("INSERT INTO `f_partners`
            (`full_name`,
             `telephone`,
             `denomination`,
             `period`,
             `branch`)
VALUES ('$full_name',
        '$telephone',
        '$denomination',
        '$period',
        '$branch')")
    or die(mysqli_error($mysqli));

    echo 1;

} else {

    echo 2;
}


?>