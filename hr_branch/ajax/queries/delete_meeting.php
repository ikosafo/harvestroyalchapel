<?php

include('../../../config.php');


$meeting_id=$_POST['i_index'];



$mysqli->query("delete from meeting where id = '$meeting_id'")
or die(mysqli_error($mysqli));


?>