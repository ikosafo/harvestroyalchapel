<?php

include('../../../config.php');


$key_id=$_POST['i_index'];



$mysqli->query("delete from mnotify where id='$key_id'")
or die(mysqli_error($mysqli));


?>