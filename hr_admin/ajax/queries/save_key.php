<?php

include('../../../config.php');


$mnotify_key = mysqli_real_escape_string($mysqli, $_POST['mnotify_key']);
$key_id = mysqli_real_escape_string($mysqli, $_POST['key_id']);
$branch = 'Admin';


$chk = $mysqli->query("select * from mnotify where branch = '$branch'");

$count = mysqli_num_rows($chk);

$ct = mysqli_num_rows($mysqli->query("select * from mnotify where mnotify_key = '$mnotify_key'"));


if ($count == "0") {

    if ($ct == "0") {


        $mysqli->query("INSERT INTO `mnotify`
            (`mnotify_key`,
             `key_id`,
             `branch`)
VALUES ('$mnotify_key',
        '$key_id',
        '$branch'
        )")
        or die(mysqli_error($mysqli));

        echo 1;

    }

    else {

        echo 2;
    }


}

else {

    if ($ct == "0") {

        $mysqli->query(" UPDATE `mnotify`
SET 
  `mnotify_key` = '$mnotify_key'
  
WHERE `key_id` = '$key_id'") or die(mysqli_error($mysqli));

        echo 3;

    }

    else {

        echo 4;
    }

}
?>