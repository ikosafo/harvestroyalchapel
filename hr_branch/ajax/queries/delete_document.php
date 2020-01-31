<?php

include('../../../config.php');


$document_id=$_POST['i_index'];

$query = $mysqli->query("select * from `document_files` where document_id = '$document_id'");
$res = $query->fetch_assoc();
$filename2 =  $res['document_location'];

$use = substr($filename2,strpos($filename2,"/")+1);

unlink("../../../uploads/".$use);




$mysqli->query("delete from document where document_id ='$document_id'")
or die(mysqli_error($mysqli));


?>