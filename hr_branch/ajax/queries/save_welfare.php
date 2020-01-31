<?php

include('../../../config.php');


$date_paid = mysqli_real_escape_string($mysqli, $_POST['date_paid']);
$memberid = mysqli_real_escape_string($mysqli, $_POST['memberid']);
$year_month = mysqli_real_escape_string($mysqli, $_POST['year_month']);
$amount = mysqli_real_escape_string($mysqli, $_POST['amount']);
$branch = $_SESSION['branch'];

$period = date("Y-m-d H:i:s");


$mysqli->query("INSERT INTO `f_welfare`
            (`memberid`,
             `year_month`,
             `date_paid`,
             `amount`,
             `branch`,
             `period`)
VALUES ('$memberid',
        '$year_month',
        '$date_paid',
        '$amount',
        '$branch',
        '$period')")
or die(mysqli_error($mysqli));

echo 1;



?>