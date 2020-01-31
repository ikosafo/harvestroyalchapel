<?php

include('../../../config.php');


$worker_id=$_POST['i_index'];



$mysqli->query("delete from church_worker where id='$worker_id'")
or die(mysqli_error($mysqli));


?>