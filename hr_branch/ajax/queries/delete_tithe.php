<?php

include('../../../config.php');


$tithe_id=$_POST['i_index'];



$mysqli->query("delete from f_tithe where id='$tithe_id'")
or die(mysqli_error($mysqli));


?>