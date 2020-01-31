<?php

include('../../../config.php');


$convert_id=$_POST['i_index'];



$mysqli->query("delete from `convert` where id='$convert_id'")
or die(mysqli_error($mysqli));


?>