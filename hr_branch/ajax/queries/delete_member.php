<?php

include('../../../config.php');


$m_id=$_POST['i_index'];



$mysqli->query("UPDATE `member`

SET 

 `status` = 'INACTIVE'
 
WHERE `id` = '$m_id'") or die(mysqli_error($mysqli));



?>