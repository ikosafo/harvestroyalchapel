<?php

include('../../../config.php');


$mpcontributions_id=$_POST['i_index'];



$mysqli->query("delete from f_mpcontributions where id='$mpcontributions_id'")
or die(mysqli_error($mysqli));


?>