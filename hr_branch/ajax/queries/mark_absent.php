<?php

include('../../../config.php');


$id_index = mysqli_real_escape_string($mysqli, $_POST['id_index']);
$select_service = mysqli_real_escape_string($mysqli, $_POST['select_service']);

$date = date("Y-m-d H:i:s");
$branch = $_SESSION['branch'];


$mysqli->query("DELETE
FROM `attendance`
WHERE `memberid` = '$id_index' AND service = '$select_service'") or die(mysqli_error($mysqli));

echo 1;


?>