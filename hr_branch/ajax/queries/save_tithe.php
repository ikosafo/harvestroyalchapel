<?php

include('../../../config.php');


$date_paid = mysqli_real_escape_string($mysqli, $_POST['date_paid']);
$memberid = mysqli_real_escape_string($mysqli, $_POST['memberid']);
$year_month = mysqli_real_escape_string($mysqli, $_POST['year_month']);
$week = mysqli_real_escape_string($mysqli, $_POST['week']);
$payment_mode = mysqli_real_escape_string($mysqli, $_POST['payment_mode']);
$amount = mysqli_real_escape_string($mysqli, $_POST['amount']);
$branch = $_SESSION['branch'];

$period = date("Y-m-d H:i:s");


    $mysqli->query("INSERT INTO `f_tithe`
            (`memberid`,
             `year_month`,
             `week`,
             `date_paid`,
             `payment_mode`,
             `amount`,
             `branch`,
             `period`)
VALUES ('$memberid',
        '$year_month',
        '$week',
        '$date_paid',
        '$payment_mode',
        '$amount',
        '$branch',
        '$period')")
    or die(mysqli_error($mysqli));

    echo 1;



?>