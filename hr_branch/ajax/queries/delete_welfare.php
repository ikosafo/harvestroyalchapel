<?php

include('../../../config.php');


$welfare_id=$_POST['i_index'];



$mysqli->query("delete from f_welfare where id='$welfare_id'")
or die(mysqli_error($mysqli));


?>