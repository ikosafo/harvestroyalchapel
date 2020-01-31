<?php

include("../../../config.php");

$email_address=mysqli_real_escape_string($mysqli,$_POST['signin_email_address']);
$pass=mysqli_real_escape_string($mysqli,$_POST['signin_password']);

$password = md5($pass);


$res=$mysqli->query("SELECT * FROM users_login WHERE 
                             (`email_address` = '$email_address' OR telephone = '$email_address') AND
                             `password` = '$password'
                             ");
$rowcount = mysqli_num_rows($res);

$getdetails = $res->fetch_assoc();
$telephone = $getdetails['telephone'];
$emailaddress = $getdetails['email_address'];
$memberid = $telephone.$emailaddress;
$branch = $getdetails['branch'];
$firstname = $getdetails['first_name'];
$lastname = $getdetails['last_name'];
$fullname = $firstname.' '.$lastname;
/*$verified = $getdetails['email_verified'];*/

ob_start();
system('ipconfig /all');
$mycom=ob_get_contents();
ob_clean();
$findme = 'physique';
$pmac = strpos($mycom, $findme);
$mac_address = substr($mycom,($pmac+33),17);


function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
        $ip_address=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
        $ip_address=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
        $ip_address=$_SERVER['REMOTE_ADDR'];
    }
    return $ip_address;

}

$ip_add = getRealIpAddr();

$today = date("Y-m-d H:i:s");



if ($rowcount == "0"){

    $mysqli->query("INSERT INTO `logs`
            (`message`,
             `logdate`,
             `emailaddress`,
             `telephone`,
             `macaddress`,
             `ipaddress`,
             `action`)
VALUES ('Email or password error after attempted login',
        '$today',
        '$email_address',
        '$telephone',
        '$mac_address',
        '$ip_add',
        'Failed')") or die(mysqli_error($mysqli));

    echo 3;

}

else {

    $mysqli->query("INSERT INTO `logs`
            (`message`,
             `logdate`,
             `emailaddress`,
             `telephone`,
             `macaddress`,
             `ipaddress`,
             `action`)
VALUES ('Logged in successfully',
        '$today',
        '$email_address',
        '$telephone',
        '$mac_address',
        '$ip_add',
        'Successful')") or die(mysqli_error($mysqli));

    $_SESSION['fullname'] = $fullname;
    $_SESSION['firstname'] = $firstname;
    $_SESSION['lastname'] = $lastname;
    $_SESSION['memberid'] = $memberid;
    $_SESSION['emailaddress'] = $email_address;
    $_SESSION['telephone'] = $telephone;
    $_SESSION['branch'] = $branch;
    $_SESSION['password'] = $pass;

    echo 1;




}










?>