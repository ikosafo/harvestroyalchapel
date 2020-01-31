<?php include ('../config.php');

session_destroy();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Church Admin System | Christ Vision Sanctuary Int.</title>
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
    <link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/bootstrap-datepicker.min.css"
    <link rel="stylesheet" href="assets/vendor/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="assets/css/custom.css">

</head>


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
            <div class="card-body">
                <a href="#." class="brand text-center d-block m-b-20">
                    <img src="assets/img/logo.jpg" alt="AHPC Logo" style="width: 30%"/>
                </a>
                <h5 class="sign-in-heading text-center m-b-20">Sign in to Administrator</h5>
                <div class="form-group">
                    <label for="inputPassword" class="sr-only">Username</label>
                    <input type="text" id="username" class="form-control" placeholder="Username" required="">
                </div>

                <div class="form-group">
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" id="password" class="form-control" placeholder="Password" required="">
                </div>
                <div style="text-align:center;">
                    <button id="login_btn"
                            class="btn btn-primary btn-rounded
                                            btn-floating" type="button">Sign In
                    </button>
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

    $('#login_btn').click(function () {
        var username = $('#username').val();
        var password = $('#password').val();

        var error = '';
        if (username == "") {
            error += 'Please enter username \n';
            $("#username").focus();
        }
        if (password == "") {
            error += 'Please enter password \n';
            $("#password").focus();
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/loginaction.php",
                data: {
                    username: username,
                    password: password
                },
                success: function (text) {
                    //alert(text)
                    if (text == 1) {
                        window.location.href = "/cv_branch";
                    }
                    else {
                        $('#error_loc').notify("Username or password does not exist", "error");
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
