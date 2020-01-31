<?php

include('../../../config.php');


$memberid = mysqli_real_escape_string($mysqli, $_POST['memberid']);
$branch = $_SESSION['branch'];



$chk = $mysqli->query("select * from church_worker where memberid = '$memberid'");

if (mysqli_num_rows($chk) == "1") {
    echo 2;
}

else {

    $mysqli->query("INSERT INTO `church_worker`
            (
            `memberid`,
            `branch`
            )
            
VALUES (
          '$memberid',
          '$branch'
          )")

    or die(mysqli_error($mysqli));

    echo 1;

}


?>