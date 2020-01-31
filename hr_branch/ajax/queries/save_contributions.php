<?php

include('../../../config.php');


$date_paid = mysqli_real_escape_string($mysqli, $_POST['date_paid']);
$memberid = mysqli_real_escape_string($mysqli, $_POST['memberid']);
$purpose = mysqli_real_escape_string($mysqli, $_POST['purpose']);
$amount = mysqli_real_escape_string($mysqli, $_POST['amount']);
$branch = $_SESSION['branch'];

$period = date("Y-m-d H:i:s");


$mysqli->query("INSERT INTO `f_contributions`
            (`memberid`,
             `purpose`,
             `date_paid`,
             `amount`,
             `branch`,
             `period`)
VALUES ('$memberid',
        '$purpose',
        '$date_paid',
        '$amount',
        '$branch',
        '$period')")
or die(mysqli_error($mysqli));

echo 1;



?>