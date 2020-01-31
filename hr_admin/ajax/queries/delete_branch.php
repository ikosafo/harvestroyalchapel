<?php
include("../../../config.php");

$br_id=$_POST['theindex'];

$mysqli->query("delete from branch where id='$br_id'") or die(mysqli_error($mysqli));


echo 1;
?>