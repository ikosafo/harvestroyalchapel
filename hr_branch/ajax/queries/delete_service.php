<?php

include('../../../config.php');


$service_id=$_POST['i_index'];



$mysqli->query("delete from service where id='$service_id'")
or die(mysqli_error($mysqli));


?>