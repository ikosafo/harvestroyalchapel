<?php

include('../../../config.php');


$meetingname = mysqli_real_escape_string($mysqli, $_POST['meetingname']);
$meetingperiod = mysqli_real_escape_string($mysqli, $_POST['meetingperiod']);
$men = mysqli_real_escape_string($mysqli, $_POST['men']);
$women = mysqli_real_escape_string($mysqli, $_POST['women']);
$guys = mysqli_real_escape_string($mysqli, $_POST['guys']);
$ladies = mysqli_real_escape_string($mysqli, $_POST['ladies']);
$children = mysqli_real_escape_string($mysqli, $_POST['children']);
$offering = mysqli_real_escape_string($mysqli, $_POST['offering']);
$total = $men + $women + $guys + $ladies + $children;
$branch = $_SESSION['branch'];

$periodstarted = substr($meetingperiod,0,16);
$periodclosed = substr($meetingperiod,20);

$period = date("Y-m-d H:i:s");


$mysqli->query("INSERT INTO `meeting`
            (`meetingname`,
             `men`,
             `women`,
             `ladies`,
             `guys`,
             `children`,
             `total`,
             `offering`,
             `branch`,
             `period`,
             `periodstarted`,
             `periodclosed`)
VALUES ('$meetingname',
        '$men',
        '$women',
        '$ladies',
        '$guys',
        '$children',
        '$total',
        '$offering',
        '$branch',
        '$period',
        '$periodstarted',
        '$periodclosed')")
or die(mysqli_error($mysqli));

echo 1;


?>