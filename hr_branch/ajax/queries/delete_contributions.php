<?php

include('../../../config.php');


$contributions_id=$_POST['i_index'];



$mysqli->query("delete from f_contributions where id='$contributions_id'")
or die(mysqli_error($mysqli));


?>    