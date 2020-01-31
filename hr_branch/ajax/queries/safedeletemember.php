<?php

include ('../../../config.php');

$lid = $_GET['memberid'];
$memberid = unlock($lid);


$mysqli->query("UPDATE `member`

SET 

 `status` = 'INACTIVE'
 
WHERE `memberid` = '$memberid'") or die(mysqli_error($mysqli));



echo 1;


header("location:../../view_member.php");


?>