<?php

include('../../../config.php');


$visitor_id=$_POST['i_index'];



$mysqli->query("delete from `visitor` where id='$visitor_id'")
or die(mysqli_error($mysqli));


?>