<?php

include('../../../config.php');

$service_name = mysqli_real_escape_string($mysqli, $_POST['service_name']);
$start_time = mysqli_real_escape_string($mysqli, $_POST['start_time']);
$end_time = mysqli_real_escape_string($mysqli, $_POST['end_time']);
$service_period = mysqli_real_escape_string($mysqli, $_POST['service_period']);
$branch = $_SESSION['branch'];

$period = date("Y-m-d H:i:s");


    $mysqli->query("INSERT INTO `service`
            (`service_name`,
             `start_period`,
             `end_period`,
             `service_period`,
             `branch`,
             `period`)
VALUES ('$service_name',
        '$start_time',
        '$end_time',
        '$service_period',
        '$branch',
        '$period')")
    or die(mysqli_error($mysqli));

    echo 1;


?>