<?php

include('../config.php');

if (!isset($_SESSION['username'])) {
    header("location:login");
}
//$branch = $_SESSION['branch'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Church Admin System | Christ Vision Sanctuary International</title>
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
    <link rel="stylesheet" href="assets/vendor/flatpickr/flatpickr.css">
    <link rel="stylesheet" href="assets/css/countrySelect.css">
    <link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="assets/vendor/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/jquery-confirm/css/jquery-confirm.css">

    <style>
        .active {
            font-weight: bold;
        }
    </style>

</head>
<body>
<!-- START APP WRAPPER -->
<div id="app">
    <!-- START MENU SIDEBAR WRAPPER -->
    <aside class="sidebar sidebar-left">
        <div class="sidebar-content">
            <div class="aside-toolbar">
                <ul class="site-logo">
                    <li>
                        <!-- START LOGO -->
                        <a href="index.php">
                            <div class="logo">
                                <svg id="logo" width="25" height="25" viewBox="0 0 54.03 56.55">
                                    <defs>
                                        <linearGradient id="logo_background_color">
                                            <stop class="stop1" offset="0%"/>
                                            <stop class="stop2" offset="50%"/>
                                            <stop class="stop3" offset="100%"/>
                                        </linearGradient>
                                    </defs>
                                    <path id="logo_path" class="cls-2"
                                          d="M90.32,0c14.2-.28,22.78,7.91,26.56,18.24a39.17,39.17,0,0,1,1,4.17l.13,1.5A15.25,15.25,0,0,1,118.1,29v.72l-.51,3.13a30.47,30.47,0,0,1-3.33,8,15.29,15.29,0,0,1-2.5,3.52l.06.07c.57.88,1.43,1.58,2,2.41,1.1,1.49,2.36,2.81,3.46,4.3.41.55,1,1,1.41,1.56.68.92,1.16,1.89.32,3.06-.08.12-.08.24-.19.33a2.39,2.39,0,0,1-2.62.07,4.09,4.09,0,0,1-.7-.91c-.63-.85-1.41-1.61-2-2.48-1-1.42-2.33-2.67-3.39-4.1a16.77,16.77,0,0,1-1.15-1.37c-.11,0-.06,0-.13.07-.41.14-.65.55-1,.78-.72.54-1.49,1.08-2.24,1.56A29.5,29.5,0,0,1,97.81,53c-.83.24-1.6.18-2.5.39a16.68,16.68,0,0,1-3.65.26H90.58L88,53.36A36.87,36.87,0,0,1,82.71,52a27.15,27.15,0,0,1-15.1-14.66c-.47-1.1-.7-2.17-1.09-3.39-1-3-1.45-8.86-.51-12.38a29,29,0,0,1,2.56-7.36c3.56-6,7.41-9.77,14.08-12.57a34.92,34.92,0,0,1,4.8-1.3Zm.13,4.1c-.45.27-1.66.11-2.24.26a32.65,32.65,0,0,0-4.74,1.37A23,23,0,0,0,71,18.7,24,24,0,0,0,71.13,35c2.78,6.66,7.2,11.06,14.21,13.42,1.16.39,2.52.59,3.84.91l1.47.07a7.08,7.08,0,0,0,2.43,0H94c.89-.21,1.9-.28,2.75-.46V48.8A7.6,7.6,0,0,1,95.19,47c-.78-1-1.83-1.92-2.62-3s-1.86-1.84-2.62-2.87c-2-2.7-4.45-5.1-6.66-7.62-.57-.66-1.14-1.32-1.66-2-.22-.29-.59-.51-.77-.85a2.26,2.26,0,0,1,.58-2.61,2.39,2.39,0,0,1,2.24-.2,4.7,4.7,0,0,1,1.22,1.3l.51.46c.5.68,1,1.32,1.6,2,2.07,2.37,4.38,4.62,6.27,7.17.94,1.26,2.19,2.3,3.14,3.58l1,1c.82,1.1,1.8,2,2.62,3.13.26.35.65.6.9,1A23.06,23.06,0,0,0,105,45c.37-.27,1-.51,1.15-1h-.06c-.18-.51-.73-.83-1-1.24-.74-1-1.64-1.88-2.37-2.87-1.8-2.44-3.89-4.6-5.7-7-.61-.82-1.44-1.52-2-2.34-.85-1.16-3.82-3.73-1.54-5.41a2.27,2.27,0,0,1,1.86-.26c.9.37,2.33,2.43,2.94,3.26s1.27,1.31,1.79,2c1.44,1.95,3.11,3.66,4.54,5.6.41.55,1,1,1.41,1.56.66.89,1.46,1.66,2.11,2.54.29.39.61,1.06,1.09,1.24.54-1,1.34-1.84,1.92-2.8a25.69,25.69,0,0,0,2.5-6.32c1.27-4.51.32-10.37-1.15-13.81A22.48,22.48,0,0,0,100.75,5.94a35.12,35.12,0,0,0-6.08-1.69A20.59,20.59,0,0,0,90.45,4.11Z"
                                          transform="translate(-65.5)" fill="url(#logo_background_color)"/>
                                </svg>
                            </div>
                            <span class="brand-text">ADMIN</span>
                        </a>
                        <!-- END LOGO -->
                    </li>
                </ul>
                <ul class="header-controls">
                    <li class="nav-item">
                        <button type="button" class="btn btn-link btn-menu" data-toggle-state="mini-sidebar">
                            <i class="zmdi zmdi-dot-circle-alt zmdi-hc-fw"></i>
                        </button>
                    </li>
                </ul>
            </div>
            <nav class="main-menu">
                <ul class="nav metismenu">
                    <li class="sidebar-header"><span>MAIN</span></li>
                    <li class="<?php echo($_SERVER['PHP_SELF'] == "/cv_admin/index.php"
                        ? "active" : ""); ?> nav-dropdown">
                        <a href="/cv_admin"><i class="icon dripicons-meter"></i><span>Dashboard</span></a>
                    </li>
                    <li class="<?php echo($_SERVER['PHP_SELF'] == "/cv_admin/branches.php" ||
                    $_SERVER['PHP_SELF'] == "/cv_admin/sms_api_key.php" ||
                    $_SERVER['PHP_SELF'] == "/cv_admin/system_users.php" ||
                    $_SERVER['PHP_SELF'] == "/cv_admin/departments.php" ||
                    $_SERVER['PHP_SELF'] == "/cv_admin/ministries.php"
                        ? "active" : ""); ?> nav-dropdown">
                        <a class="has-arrow" href="#" aria-expanded="false"><i class="icon dripicons-gear"></i><span>Configuration</span></a>
                        <ul class="collapse nav-sub" aria-expanded="false">
                            <li class="active"><a href="branches">
                                    <span class="<?php echo($_SERVER['PHP_SELF'] == "/cv_admin/branches.php"
                                        ? "active" : ""); ?>">Branches</span></a></li>
                            <li><a href="system_users">
                                    <span class="<?php echo($_SERVER['PHP_SELF'] == "/cv_admin/system_users.php"
                                        ? "active" : ""); ?>">System Users</span></a></li>
                            <li><a href="departments">
                                    <span class="<?php echo($_SERVER['PHP_SELF'] == "/cv_admin/departments.php"
                                        ? "active" : ""); ?>">Departments</span></a></li>
                            <li><a href="ministries">
                                    <span class="<?php echo($_SERVER['PHP_SELF'] == "/cv_admin/ministries.php"
                                        ? "active" : ""); ?>">Ministries</span></a></li>
                            <li><a href="sms_api_key">
                                    <span class="<?php echo($_SERVER['PHP_SELF'] == "/cv_admin/sms_api_key.php"
                                        ? "active" : ""); ?>">SMS API Key</span></a></li>
                        </ul>
                    </li>
                    <li class="<?php echo($_SERVER['PHP_SELF'] == "/ad/documents.php"
                        ? "active" : ""); ?> nav-dropdown">
                        <a href="documents"><i class="icon dripicons-folder-open"></i>
                            <span class="<?php echo($_SERVER['PHP_SELF'] == "/cv_admin/documents.php"
                                ? "active" : ""); ?>">Documents</span></a>
                    </li>
                    <li class="<?php echo(
                    $_SERVER['PHP_SELF'] == "/cv_admin/view_members.php" ||
                    $_SERVER['PHP_SELF'] == "/cv_admin/new_converts.php" ||
                    $_SERVER['PHP_SELF'] == "/cv_admin/visitors.php" ||
                    $_SERVER['PHP_SELF'] == "/cv_admin/print_forms.php"
                        ? "active" : ""); ?> nav-dropdown">
                        <a class="has-arrow" href="#" aria-expanded="false">
                            <i class="icon icon-people"></i><span>Membership</span></a>
                        <ul class="collapse nav-sub">

                            <li><a href="view_members">
                                    <span class="<?php echo($_SERVER['PHP_SELF'] == "/cv_admin/view_members.php"
                                        ? "active" : ""); ?>">View Members</span></a></li>
                            <li><a href="new_converts">
                                    <span class="<?php echo($_SERVER['PHP_SELF'] == "/cv_admin/new_converts.php"
                                        ? "active" : ""); ?>">New Converts</span></a></li>
                            <li><a href="visitors">
                                    <span class="<?php echo($_SERVER['PHP_SELF'] == "/cv_admin/visitors.php"
                                        ? "active" : ""); ?>">Visitors</span></a></li>
                            <li><a href="print_forms">
                                    <span class="<?php echo($_SERVER['PHP_SELF'] == "/cv_admin/print_forms.php"
                                        ? "active" : ""); ?>">Print Forms</span></a></li>
                        </ul>
                    </li>
                    <li class="sidebar-header"><span>OTHERS</span></li>
                    <li class="<?php echo(
                    $_SERVER['PHP_SELF'] == "/cv_admin/attendance_service.php" ||
                    $_SERVER['PHP_SELF'] == "/cv_admin/attendance_search.php"
                        ? "active" : ""); ?> nav-dropdown">
                        <a class="has-arrow" href="#" aria-expanded="false"><i
                                    class="icon dripicons-checklist"></i><span>Attendance</span></a>
                        <ul class="collapse nav-sub" aria-expanded="false">
                            <li><a href="attendance_service">
                                    <span class="<?php echo($_SERVER['PHP_SELF'] == "/cv_admin/attendance_service.php"
                                        ? "active" : ""); ?>">Service</span></a></li>
                            <li><a href="attendance_search">
                                    <span class="<?php echo($_SERVER['PHP_SELF'] == "/cv_admin/attendance_search.php"
                                        ? "active" : ""); ?>">Search Details</span></a></li>
                        </ul>
                    </li>
                    <li class="<?php echo(
                    $_SERVER['PHP_SELF'] == "/cv_admin/tithe.php" ||
                    $_SERVER['PHP_SELF'] == "/cv_admin/welfare.php" ||
                    $_SERVER['PHP_SELF'] == "/cv_admin/contributions.php" ||
                    $_SERVER['PHP_SELF'] == "/cv_admin/first_fruit.php"
                        ? "active" : ""); ?> nav-dropdown">
                        <a class="has-arrow" href="#" aria-expanded="false"><i class="icon dripicons-wallet"></i><span>Financials</span></a>
                        <ul class="collapse nav-sub" aria-expanded="false">
                            <li><a href="tithe"><span>Tithe</span></a></li>
                            <li><a href="welfare"><span>Welfare</span></a></li>
                            <li><a href="contributions"><span>Contributions</span></a></li>
                            <li><a href="first_fruit"><span>First Fruit</span></a></li>
                            <li><a href="ministry_partners"><span>Ministry Partners</span></a></li>
                            <li><a href="financials_search"><span>Search</span></a></li>

                        </ul>
                    </li>
                    <li class="nav-dropdown">
                        <a href="sms"><i class="icon icon-envelope-letter"></i><span>SMS</span></a>
                    </li>
                    <li class="nav-dropdown">
                        <a href="birthdays"><i class="icon icon-emotsmile"></i><span>Birthdays</span></a>
                    </li>
                    <li class="nav-dropdown">
                        <a class="has-arrow" href="#" aria-expanded="false"><i
                                    class="icon icon-calculator"></i><span>Accounts</span></a>
                        <ul class="collapse nav-sub" aria-expanded="false">
                            <li><a href="account_inputs"><span>Account Inputs</span></a></li>
                            <li><a href="account_expenses"><span>Expenses</span></a></li>
                            <li><a href="account_bank_transaction"><span>Bank Transaction</span></a></li>
                            <li><a href="account_balance_sheet"><span>Balance Sheet</span></a></li>
                            <li><a href="account_search"><span>Search</span></a></li>
                        </ul>
                    </li>
                    <li class="nav-dropdown">
                        <a class="has-arrow" href="#" aria-expanded="false"><i
                                    class="icon dripicons-blog"></i><span>Asset Register/Inv.</span></a>
                        <ul class="collapse nav-sub" aria-expanded="false">
                            <li><a href="inventory_category"><span>Categories</span></a></li>
                            <li><a href="inventory_entry"><span>Entry</span></a></li>
                            <li><a href="inventory_search"><span>Search</span></a></li>
                        </ul>
                    </li>

                    <li><a href="login"><i class="icon icon-logout"></i><span>Log Out</span></a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>






    <!-- END MENU SIDEBAR WRAPPER -->
    <div class="content-wrapper">

        <!-- START LOGO WRAPPER -->
        <nav class="top-toolbar navbar navbar-mobile navbar-tablet">
            <ul class="navbar-nav nav-left">
                <li class="nav-item">
                    <a href="javascript:void(0)" data-toggle-state="aside-left-open">
                        <i class="icon dripicons-align-left"></i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav nav-center site-logo">
                <li>
                    <a href="index">
                        <div class="logo_mobile">
                            <svg id="logo_mobile" width="27" height="27" viewBox="0 0 54.03 56.55">
                                <defs>
                                    <linearGradient id="logo_background_mobile_color">
                                        <stop class="stop1" offset="0%"/>
                                        <stop class="stop2" offset="50%"/>
                                        <stop class="stop3" offset="100%"/>
                                    </linearGradient>
                                </defs>
                                <path id="logo_path_mobile"
                                      class="cls-2"
                                      d="M90.32,0c14.2-.28,22.78,7.91,26.56,18.24a39.17,39.17,0,0,1,1,4.17l.13,1.5A15.25,15.25,0,0,1,118.1,29v.72l-.51,3.13a30.47,30.47,0,0,1-3.33,8,15.29,15.29,0,0,1-2.5,3.52l.06.07c.57.88,1.43,1.58,2,2.41,1.1,1.49,2.36,2.81,3.46,4.3.41.55,1,1,1.41,1.56.68.92,1.16,1.89.32,3.06-.08.12-.08.24-.19.33a2.39,2.39,0,0,1-2.62.07,4.09,4.09,0,0,1-.7-.91c-.63-.85-1.41-1.61-2-2.48-1-1.42-2.33-2.67-3.39-4.1a16.77,16.77,0,0,1-1.15-1.37c-.11,0-.06,0-.13.07-.41.14-.65.55-1,.78-.72.54-1.49,1.08-2.24,1.56A29.5,29.5,0,0,1,97.81,53c-.83.24-1.6.18-2.5.39a16.68,16.68,0,0,1-3.65.26H90.58L88,53.36A36.87,36.87,0,0,1,82.71,52a27.15,27.15,0,0,1-15.1-14.66c-.47-1.1-.7-2.17-1.09-3.39-1-3-1.45-8.86-.51-12.38a29,29,0,0,1,2.56-7.36c3.56-6,7.41-9.77,14.08-12.57a34.92,34.92,0,0,1,4.8-1.3Zm.13,4.1c-.45.27-1.66.11-2.24.26a32.65,32.65,0,0,0-4.74,1.37A23,23,0,0,0,71,18.7,24,24,0,0,0,71.13,35c2.78,6.66,7.2,11.06,14.21,13.42,1.16.39,2.52.59,3.84.91l1.47.07a7.08,7.08,0,0,0,2.43,0H94c.89-.21,1.9-.28,2.75-.46V48.8A7.6,7.6,0,0,1,95.19,47c-.78-1-1.83-1.92-2.62-3s-1.86-1.84-2.62-2.87c-2-2.7-4.45-5.1-6.66-7.62-.57-.66-1.14-1.32-1.66-2-.22-.29-.59-.51-.77-.85a2.26,2.26,0,0,1,.58-2.61,2.39,2.39,0,0,1,2.24-.2,4.7,4.7,0,0,1,1.22,1.3l.51.46c.5.68,1,1.32,1.6,2,2.07,2.37,4.38,4.62,6.27,7.17.94,1.26,2.19,2.3,3.14,3.58l1,1c.82,1.1,1.8,2,2.62,3.13.26.35.65.6.9,1A23.06,23.06,0,0,0,105,45c.37-.27,1-.51,1.15-1h-.06c-.18-.51-.73-.83-1-1.24-.74-1-1.64-1.88-2.37-2.87-1.8-2.44-3.89-4.6-5.7-7-.61-.82-1.44-1.52-2-2.34-.85-1.16-3.82-3.73-1.54-5.41a2.27,2.27,0,0,1,1.86-.26c.9.37,2.33,2.43,2.94,3.26s1.27,1.31,1.79,2c1.44,1.95,3.11,3.66,4.54,5.6.41.55,1,1,1.41,1.56.66.89,1.46,1.66,2.11,2.54.29.39.61,1.06,1.09,1.24.54-1,1.34-1.84,1.92-2.8a25.69,25.69,0,0,0,2.5-6.32c1.27-4.51.32-10.37-1.15-13.81A22.48,22.48,0,0,0,100.75,5.94a35.12,35.12,0,0,0-6.08-1.69A20.59,20.59,0,0,0,90.45,4.11Z" transform="translate(-65.5)" fill="url(#logo_background_mobile_color)"/>
                            </svg>
                        </div>
                        <span class="brand-text">ADMIN</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav nav-right">
                <li class="nav-item">
                    <a href="javascript:void(0)" data-toggle-state="mobile-topbar-toggle">
                        <i class="icon dripicons-dots-3 rotate-90"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- END LOGO WRAPPER -->
        <!-- START TOP TOOLBAR WRAPPER -->
        <nav class="top-toolbar navbar navbar-desktop flex-nowrap">
            <!-- START LEFT DROPDOWN MENUS -->
            <ul class="navbar-nav nav-left">
                <li class="nav-item nav-text dropdown dropdown-menu-md">
                    <a href="javascript:void(0)" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">
							<span>
								Branches
							</span>
                        <i class="zmdi zmdi-chevron-down zmdi-hc-fw menu-arrow-down"></i>
                    </a>
                    <div class="dropdown-menu menu-icons dropdown-menu-left">
                        <div class="form-group form-filter">
                            <input type="text" placeholder="Search Branch..." class="form-control filter-input"
                                   data-search-trigger="open">
                            <i data-q-action="clear-filter" class="icon dripicons-cross clear-filter"></i>
                            <ul class="list-reset filter-list" data-scroll="minimal-dark">

                                <?php
                                $getbranch = $mysqli->query("select * from branch ORDER BY name");
                                while ($resbranch = $getbranch->fetch_assoc()) { ?>
                                    <li><a class="dropdown-item" href="#"><?php echo $resbranch['name'] ?></a></li>
                                <?php } ?>


                            </ul>
                        </div>
                    </div>
                </li>
                <!-- START MEGA MENU -->

                <!-- END MEGA MENU -->
            </ul>
            <!-- END LEFT DROPDOWN MENUS -->
            <!-- START RIGHT TOOLBAR ICON MENUS -->
            <ul class="navbar-nav nav-right">
                <li class="nav-item">
                    <a href="javascript:void(0)" class="open-search-button" data-q-action="open-site-search">
                        <i class="icon dripicons-search"></i>
                    </a>
                </li>




                <li class="nav-item dropdown">
                    <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="true" aria-expanded="false">
                        <img src="assets/img/logo.jpg" class="w-35 rounded-circle" alt="Albert Einstein">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-accout">
                        <div class="dropdown-header pb-3">
                            <div class="media d-user">
                                <img class="align-self-center mr-3 w-40 rounded-circle"
                                     src="assets/img/logo.jpg" alt="Albert Einstein">
                                <div class="media-body">
                                    <h5 class="mt-0 mb-0">Administrator</h5>
                                    <span>Manage all branches</span>
                                </div>
                            </div>
                        </div>

                        <a class="dropdown-item" href="login"><i class="icon dripicons-lock-open"></i> Sign
                            Out</a>
                    </div>
                </li>

            </ul>
            <!-- END RIGHT TOOLBAR ICON MENUS -->
            <!--START TOP TOOLBAR SEARCH -->
            <form role="search" action="pages.search.html" class="navbar-form">
                <div class="form-group">
                    <input type="text" placeholder="Search and press enter..." class="form-control navbar-search"
                           autocomplete="off">
                    <i data-q-action="close-site-search" class="icon dripicons-cross close-search"></i>
                </div>
                <button type="submit" class="d-none">Submit</button>
            </form>
            <!--END TOP TOOLBAR SEARCH -->
        </nav>
        <!-- END TOP TOOLBAR WRAPPER -->

        <div class="content">
            <!--START PAGE HEADER -->
            <header class="page-header">

            </header>
            <!--END PAGE HEADER -->