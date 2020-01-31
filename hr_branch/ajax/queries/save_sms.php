<?php
include('../../../config.php');

$branch = $_SESSION['branch'];


$title=mysqli_real_escape_string($mysqli,$_POST['title']);
$message=mysqli_real_escape_string($mysqli,$_POST['message']);


$date = date('Y-m-d H:i:s');



$res= $mysqli->query("SELECT * FROM member where branch = '$branch'");


while ($record = $res->fetch_assoc()) {


    $one = substr($record['telephone'],1,3);
    $two = substr($record['telephone'],6,3);
    $three = substr($record['telephone'],-4);

    $number = $one.''.$two.''.$three;


    $num = substr("$number", 1);
    $phone = '+233' . $num;

    sendSMS($message, $phone);


}






$query = $mysqli->query("INSERT INTO `sms`
            (`group`,
             `message`,
             `date`,
             `title`,
             `branch`)
VALUES ('All Members',
        '$message',
        '$date',
        '$title',
        '$branch')")

or die(mysqli_error($mysqli));

echo 1;




?>


