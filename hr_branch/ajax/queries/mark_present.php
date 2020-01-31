<?php

include('../../../config.php');


$id_index = mysqli_real_escape_string($mysqli, $_POST['id_index']);
$select_service = mysqli_real_escape_string($mysqli, $_POST['select_service']);

$date = date("Y-m-d H:i:s");
$branch = $_SESSION['branch'];


$mysqli->query("INSERT INTO `attendance`
            (`memberid`,
             `datereported`,
             `service`,
             `branch`)
VALUES ('$id_index',
        '$date',
        '$select_service',
        '$branch')") or die(mysqli_error($mysqli));

echo 1;


?>