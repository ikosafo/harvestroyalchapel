<?php

include('../../../config.php');

$visitor_name = mysqli_real_escape_string($mysqli, $_POST['visitor_name']);
$visitor_telephone = mysqli_real_escape_string($mysqli, $_POST['visitor_telephone']);
$visitor_service = mysqli_real_escape_string($mysqli, $_POST['visitor_service']);

$date = date("Y-m-d H:i:s");
$branch = $_SESSION['branch'];


$mysqli->query("INSERT INTO `attendance`
            (`memberid`,
             `datereported`,
             `service`,
             `telephone`,
             `branch`)
VALUES ('$visitor_name',
        '$date',
        '$visitor_service',
        '$visitor_telephone',
        '$branch')") or die(mysqli_error($mysqli));

echo 1;


?>