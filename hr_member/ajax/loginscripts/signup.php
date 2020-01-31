<?php

include("../../../config.php");


$first_name=mysqli_real_escape_string($mysqli,$_POST['first_name']);
$last_name=mysqli_real_escape_string($mysqli,$_POST['last_name']);
$email_address=mysqli_real_escape_string($mysqli,$_POST['email_address']);
$branch=mysqli_real_escape_string($mysqli,$_POST['branch']);
$telephone=mysqli_real_escape_string($mysqli,$_POST['telephone']);
$pass=mysqli_real_escape_string($mysqli,$_POST['password']);
$password = md5($pass);

$full_name = $first_name.' '.$last_name;

/*$n_link = md5(md5($first_name."".$last_name."".$email_address."".$password));
$v_link = rand(1,100000000).$n_link.rand(1,100000000);*/

$res=$mysqli->query("SELECT * FROM users_login WHERE `email_address` = '$email_address'
                           OR `telephone` = '$telephone'");
$getdetails = $res->fetch_assoc();
$rowcount = mysqli_num_rows($res);



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


/*$subject = 'AHPC Email Verification';

$message = "Dear $full_name, <p>Thank you for signing up with <b>Allied Health
Professions Council.</b>. Please click on the activation link 
<a href='$reg_root/email_validating.php?vid=$v_link&email=$email_address'>HERE</a> to verify your 
email address.</p>
<p>Thank you.</p>
";*/


if ($rowcount == "0"){

    $mysqli->query("INSERT INTO `users_login`
            (`first_name`,
             `last_name`,
             `email_address`,
             `branch`,
             `password`,
             `telephone`,
             `period`)
VALUES ('$first_name',
        '$last_name',
        '$email_address',
        '$branch',
        '$password',
        '$telephone',
        '$today')") or die(mysqli_error($mysqli));





    $mysqli->query("INSERT INTO `logs`
            (`message`,
             `logdate`,
             `emailaddress`,
             `telephone`,
             `macaddress`,
             `ipaddress`,
             `action`)
VALUES ('Created an account',
        '$today',
        '$email_address',
        '$telephone',
        '$mac_address',
        '$ip_add',
        'Successful')") or die(mysqli_error($mysqli));

    echo 1;

    //SendEmail::compose($email_address,$subject,$message);


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
VALUES ('Email  or telephone already exist after attempted account creation',
        '$today',
        '$email_address',
        '$telephone',
        '$mac_address',
        '$ip_add',
        'Failed')") or die(mysqli_error($mysqli));

    echo 2;


}










?>