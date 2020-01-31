<?php

include('../../../config.php');


$randno = $_POST['randno'];

$today = date("Y-m-d H:i:s");


$target_path = "../../../uploads/documents/";

$rand = rand(1,100000);

$ext = pathinfo($_FILES['Filedata']['name'], PATHINFO_EXTENSION);

$filename =  $_FILES['Filedata']['name'];
$newfile = 'uploads/documents/'.date('Ymd').$rand.".".$ext;
$target_path = "../../../uploads/documents/".date('Ymd').$rand.".".$ext;


$filetype =  $_FILES['Filedata']['type'];
$filesize =  $_FILES['Filedata']['size'];


if(move_uploaded_file($_FILES['Filedata']['tmp_name'], $target_path)) {

    echo $success =  "The file ".  basename( $_FILES['Filedata']['name']). " has been uploaded";
}
else
{

    echo $error = "There was an error uploading the file, please try again!";

}




$insertfile  = $mysqli->query("INSERT INTO `document_files`
            (`document_name`,
             `document_location`,
             `document_size`,
             `document_type`,
             `document_id`,
             `period_uploaded`)
VALUES ('$filename',
        '$newfile',
        '$filesize',
        '$filetype',
        '$randno',
        '$today')") or die ();

echo 3;


?>


