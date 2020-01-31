<?php

include('../../../config.php');


$min_id=$_POST['i_index'];



$mysqli->query("delete from ministry where id='$min_id'")
or die(mysqli_error($mysqli));


?>