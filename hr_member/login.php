<?php include ('../config.php');

session_destroy();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Church Admin System | /Christ Vision Sanctuary Int</title>
    <!-- ================== GOOGLE FONTS ==================-->
    <link href="https@fonts.googleapis.com/css@family=Poppins_3A300,400,500" rel="stylesheet">
    <!-- ======================= GLOBAL VENDOR STYLES ========================-->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.css">
    <link rel="stylesheet" href="assets/vendor/metismenu/dist/metisMenu.css">
    <link rel="stylesheet" href="assets/vendor/switchery-npm/index.css">
    <link rel="stylesheet" href="assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <!-- ======================= LINE AWESOME ICONS ===========================-->
    <link rel="stylesheet" href="assets/css/icons/line-awesome.min.css">
    <link rel="stylesheet" href="assets/css/icons/simple-line-icons.css">
    <!-- ======================= DRIP ICONS ===================================-->
    <link rel="stylesheet" href="assets/css/icons/dripicons.min.css">
    <!-- ======================= MATERIAL DESIGN ICONIC FONTS =================-->
    <link rel="stylesheet" href="assets/css/icons/material-design-iconic-font.min.css">
    <!-- ======================= PAGE VENDOR STYLES ===========================-->
    <link rel="stylesheet" href="assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <!-- ======================= GLOBAL COMMON STYLES ============================-->
    <link rel="stylesheet" href="assets/css/common/main.bundle.css">
    <!-- ======================= LAYOUT TYPE ===========================-->
    <link rel="stylesheet" href="assets/css/layouts/vertical/core/main.css">
    <!-- ======================= MENU TYPE ===========================-->
    <link rel="stylesheet" href="assets/css/layouts/vertical/menu-type/default.css">
    <!-- ======================= THEME COLOR STYLES ===========================-->
    <link rel="stylesheet" href="assets/css/layouts/vertical/themes/theme-j.css">

    <link rel="stylesheet" href="assets/vendor/sweetalert/sweetalert.css">

    <link rel="stylesheet" href="assets/uploadify/uploadifive.css">

    <link rel="stylesheet" href="assets/css/selectize.css">

    <link rel="stylesheet" href="assets/css/countrySelect.css">

    <link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/bootstrap-datepicker.min.css">

    <link rel="stylesheet" href="assets/vendor/bootstrap-daterangepicker/daterangepicker.css">



    <style>
        ::-webkit-scrollbar {
            width: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .notifyjs-bootstrap-base {
            font-weight: lighter !important;
            font-size: small;
        }

    </style>
</head>

<style>
    .sign-in-form {
        margin:0.1% auto !important;
    }

    .notifyjs-bootstrap-base {
        font-weight: lighter !important;
    }
</style>


<script>
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>

<body>

<div class="container">

    <hr/>

    <div class="row">
        <div class="col-md-6 col-sm-12">
        </div>

        <div class="col-md-6 col-sm-12">
            <a href="../">
                <button class="btn btn-success btn-floating"
                        style="float: right"><i class="icon-globe"></i> Go back
                </button>
            </a>

        </div>
    </div>


    <form class="sign-in-form" autocomplete="off">
        <div id="error_loc"></div>
        <div class="card">


            <div class="card-body" id="signin_form">
                <a href="#." class="brand text-center d-block m-b-20">
                    <img src="assets/img/logo.jpg" alt="AHPC Logo" style="width: 30%"/>
                </a>
                <h5 class="sign-in-heading text-center m-b-20">Sign in to update your information</h5>
                <div class="form-group">
                    <label for="inputPassword" class="sr-only">Email Address/Telephone</label>
                    <input type="text" id="signin_email_address" class="form-control"
                           placeholder="Email Address/Telephone" required="">
                </div>

                <div class="form-group">
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" id="signin_password" class="form-control" placeholder="Password" required="">
                </div>
                <div class="checkbox m-b-10 m-t-20">
                    <div class="custom-control custom-checkbox checkbox-primary form-check">
                        <!--<input type="checkbox" class="custom-control-input" id="stateCheck1" checked="">
                        <label class="custom-control-label" for="stateCheck1">	Remember me</label>-->
                    </div>
                   <!-- <a href="reset_password.php" class="float-right">Forgot Password?</a>-->
                </div>


                <div style="text-align:center;">
                    <button id="login_btn"
                            class="btn btn-primary btn-rounded
                                            btn-floating" type="button">Sign In
                    </button>

                    <hr/>


                    <a href="#.">
                        <button type="button" class="btn btn-sm btn-secondary  btn-floating btn-outline"
                                id="signup_button">
                            Not having an account, sign up
                        </button>
                    </a>
                </div>

            </div>


            <div class="card-body" id="signup_form" style="display: none;">
                <a href="#." class="brand text-center d-block m-b-20">
                    <img src="assets/img/logo.jpg" alt="AHPC Logo" style="width: 30%"/>
                </a>
                <h5 class="sign-in-heading text-center m-b-20">Sign up for online registration</h5>
                <div class="form-group">
                    <label for="inputPassword" class="sr-only">First Name</label>
                    <input type="text" id="signup_first_name" class="form-control" placeholder="First Name" required="">
                </div>

                <div class="form-group">
                    <label for="inputPassword" class="sr-only">Last Name</label>
                    <input type="text" id="signup_last_name" class="form-control" placeholder="Last Name" required="">
                </div>

                <div class="form-group">
                    <label for="inputPassword" class="sr-only">Email Address</label>
                    <input type="text" id="signup_email_address" class="form-control" placeholder="Email Address" required="">
                </div>

                <div class="form-group">
                    <label for="inputPassword" class="sr-only">Telephone</label>
                    <input type="text" id="signup_phone_number" onkeypress="return isNumber(event)"
                           class="form-control" placeholder="Phone Number" required="">
                </div>

                <div class="form-group">
                    <label for="inputPassword" class="sr-only">Branch</label>

                    <select id="branch" style="width: 100%">

                        <option value="">Select Branch</option>

                        <?php
                        $getd = $mysqli->query("select * from branch ORDER BY name");
                        while ($resd = $getd->fetch_assoc()){?>
                            <option value="<?php echo $resd['id'] ?>"><?php echo $resd['name'] ?></option>
                        <?php } ?>


                    </select>
                </div>


                <div class="form-group">
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" id="signup_password" class="form-control" placeholder="Password" required="">
                </div>

                <div class="form-group">
                    <label for="inputPassword" class="sr-only">Confirm Password</label>
                    <input type="password" id="signup_confirm_password" class="form-control" placeholder="Confirm Password" required="">
                </div>

                <div style="text-align:center;">
                    <button id="signup_btn"
                            class="btn btn-primary btn-rounded
                                            btn-floating" type="button">Sign Up
                    </button>

                    <hr/>


                    <a href="#.">
                        <button type="button" class="btn btn-sm btn-secondary  btn-floating btn-outline"
                                id="signin_button">
                            Having an account, sign in
                        </button>
                    </a>
                </div>

            </div>


        </div>
    </form>
</div>

<!-- ================== GLOBAL VENDOR SCRIPTS ==================-->
<script src="assets/vendor/modernizr/modernizr.custom.js"></script>
<script src="assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/js-storage/js.storage.js"></script>
<script src="assets/vendor/js-cookie/src/js.cookie.js"></script>
<script src="assets/vendor/pace/pace.js"></script>
<script src="assets/vendor/metismenu/dist/metisMenu.js"></script>
<script src="assets/vendor/switchery-npm/index.js"></script>
<script src="assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
<!-- ================== PAGE LEVEL VENDOR SCRIPTS ==================-->
<script src="assets/vendor/countup.js/dist/countUp.min.js"></script>
<script src="assets/vendor/chart.js/dist/Chart.bundle.min.js"></script>
<script src="assets/vendor/flot/jquery.flot.js"></script>
<script src="assets/vendor/jquery.flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
<script src="assets/vendor/flot/jquery.flot.resize.js"></script>
<script src="assets/vendor/flot/jquery.flot.time.js"></script>
<script src="assets/vendor/flot.curvedlines/curvedLines.js"></script>
<script src="assets/vendor/datatables.net/js/jquery.dataTables.js"></script>
<script src="assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.js"></script>
<!-- ================== GLOBAL APP SCRIPTS ==================-->
<script src="assets/js/global/app.js"></script>
<!-- ================== PAGE LEVEL SCRIPTS ==================-->
<script src="assets/js/components/countUp-init.js"></script>
<script src="assets/js/cards/counter-group.js"></script>
<script src="assets/js/cards/recent-transactions.js"></script>
<script src="assets/js/cards/monthly-budget.js"></script>
<script src="assets/js/cards/users-chart.js"></script>
<script src="assets/js/cards/bounce-rate-chart.js"></script>
<script src="assets/js/cards/session-duration-chart.js"></script>
<script src="assets/js/jquery.blockUI.js"></script>
<script src="assets/js/notify.js"></script>
<script src="assets/vendor/sweetalert/sweetalert.min.js"></script>
<script src="assets/uploadify/jquery.uploadifive.js"></script>
<script src="assets/js/selectize.js"></script>
<script src="assets/js/countrySelect.js"></script>
<script src="assets/vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="assets/vendor/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="assets/js/components/bootstrap-datepicker-init.js"></script>
<script src="assets/js/components/bootstrap-date-range-picker-init.js"></script>

<script>


    $("#signup_button").click(function () {
        $("#signin_form").hide(400);

        $("#signup_form").show(700);
    });

    $("#branch").selectize();


    $("#signin_button").click(function () {
        $("#signup_form").hide(400);

        $("#signin_form").show(700);
    });


    $('#signup_btn').click(function () {

        //alert('hi');

        var first_name = $('#signup_first_name').val();
        var last_name = $('#signup_last_name').val();
        var email_address = $('#signup_email_address').val();
        var phone_number = $('#signup_phone_number').val();
        var branch = $('#branch').val();
        var password = $('#signup_password').val();
        var confirm_password = $('#signup_confirm_password').val();

        var error = '';

        if (first_name == "") {
            error += 'Please enter first name \n';
            $("#signup_first_name").focus();
        }

        if (last_name == "") {
            error += 'Please enter last name \n';
            $("#signup_last_name").focus();
        }

        if (phone_number == "") {
            error += 'Please enter phone number \n';
            $("#signup_phone_number").focus();
        }

        if (branch == "") {
            error += 'Please select branch \n';
            $("#signup_branch").focus();
        }

        if (!email_address.match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
            error += 'Please enter valid email \n';
            $("#signup_email_address").focus();

        }

        if (password == "") {
            error += 'Please enter password \n';
            $("#signup_password").focus();
        }

        if (password != "" && confirm_password == "") {
            error += 'Please confirm password \n';
            $("#signup_confirm_password").focus();
        }

        if (password != "" && password.length < 6) {
            error += 'Minimum password characters should be six \n';
            $("#signup_password").focus();
        }

        if (password != "" && confirm_password != "" && confirm_password != password) {
            error += 'Passwords do not match \n';
            $("#signup_confirm_password").focus();
        }


        if (error == "") {


            $.ajax({
                type: "POST",
                url: "ajax/loginscripts/signup.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/img/wait.gif" style="border:0 !important"/>'

                    });
                },
                data: {
                    first_name: first_name,
                    last_name: last_name,
                    email_address: email_address,
                    telephone: phone_number,
                    branch: branch,
                    password: password

                },
                success: function (text) {

                    //alert(text);

                    if (text == 1) {

                        location.reload();
                    }

                    else if (text == 2) {
                        $('#error_loc').notify("Email address or telephone already exists", "error");
                    }


                    else {

                        $('#error_loc').notify("Error creating account", "error");
                    }


                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },
                complete: function () {
                    $.unblockUI();
                },

            });


        }
        else {

            $('#error_loc').notify(error);


        }
        return false;


    });


    $('#login_btn').click(function () {

        //alert('hi');


        var signin_email_address = $('#signin_email_address').val();
        var signin_password = $('#signin_password').val();

        var error = '';

        if (signin_email_address == "") {
            error += 'Please enter email address \n';
            $("#signin_email_address").focus();

        }

       /* if (!signin_email_address.match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
            error += 'Please enter valid email \n';
            $("#signin_email_address").focus();

        }*/


        if (signin_password == "") {
            error += 'Please enter password \n';
            $("#signin_password").focus();
        }




        if (error == "") {


            $.ajax({
                type: "POST",
                url: "ajax/loginscripts/signin.php",
                data: {
                    signin_email_address: signin_email_address,
                    signin_password: signin_password

                },
                success: function (text) {

                    //alert(text);

                    if (text == 1) {

                        window.location.href = "index.php";

                    }


                    else if (text == 3) {

                        $('#error_loc').notify("Email address or password does not exist", "error");
                    }


                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },

            });


        }
        else {

            $('#error_loc').notify(error);


        }
        return false;
    });

</script>

</body>

</html>
