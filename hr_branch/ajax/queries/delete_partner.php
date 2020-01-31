<?php

include('../../../config.php');


$partner_id=$_POST['i_index'];



$mysqli->query("delete from `f_partners` where id='$partner_id'")
or die(mysqli_error($mysqli));


?>