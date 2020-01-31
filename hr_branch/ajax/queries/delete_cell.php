<?php

include('../../../config.php');


$cell_id=$_POST['i_index'];



$mysqli->query("delete from cell where id='$cell_id'")
or die(mysqli_error($mysqli));


?>