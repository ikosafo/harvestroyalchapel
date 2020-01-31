<?php

include('../../../config.php');

$document_title = mysqli_real_escape_string($mysqli, $_POST['document_title']);
$document_description = mysqli_real_escape_string($mysqli, $_POST['document_description']);
$document_id = mysqli_real_escape_string($mysqli, $_POST['document_id']);
$branch = $_SESSION['branch'];


$chk = $mysqli->query("select * from document where document_id = '$document_id'");

$count = mysqli_num_rows($chk);


if ($count == "0") {


    $mysqli->query("INSERT INTO `document`
            (`document_title`,
             `document_description`,
             `document_id`,
             `branch`)
VALUES ('$document_title',
        '$document_description',
        '$document_id',
        '$branch'
        )")
    or die(mysqli_error($mysqli));

        echo 1;


}

else {

        echo 2;

}
?>