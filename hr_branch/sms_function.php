<?php

function sendSMS($message, $phone)
{

    $branch = $_SESSION['branch'];

    $getkey = $mysqli->query("select * from mnotify where branch = '$branch' LIMIT 1");
    $reskey = $getkey->fetch_assoc();

    $keyval = $reskey['mnotify_key'];

    $sender = $_POST['title'];
    $key = $keyval;
    $url = "http://bulk.mnotify.net/smsapi?key=" . $key . "&to=" . $phone . "&msg=" . urlencode($message) . "&sender_id=" . $sender;
    $response = file_get_contents($url);
}




?>