<?php

include('../../../config.php');


$firstfruit_id=$_POST['i_index'];



$mysqli->query("delete from f_firstfruit where id='$firstfruit_id'")
or die(mysqli_error($mysqli));


?>