<?php require ('includes/header.php');
?>

            <!--START PAGE CONTENT -->
            <section class="page-content container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="row m-0 col-border-xl">
                                <div class="col-md-12 col-lg-6 col-xl-3">
                                    <div class="card-body">
                                        <div class="icon-rounded icon-rounded-primary float-left m-r-20">
                                            <i class="icon icon-people"></i>
                                        </div>
                                        <h5 class="card-title m-b-5 counter" data-count="
                                        <?php $getnum = $mysqli->query("select * from `member`");
                                        echo $count = mysqli_num_rows($getnum); ?>">0</h5>
                                        <h6 class="text-muted m-t-10">
                                            Member(s)
                                        </h6>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6 col-xl-3">
                                    <div class="card-body">
                                        <div class="icon-rounded icon-rounded-accent float-left m-r-20">
                                            <i class="icon dripicons-user"></i>
                                        </div>
                                        <h5 class="card-title m-b-5 counter"
                                            data-count="<?php $getnumm = $mysqli->query("select * from `member` where gender = 'Male'");
                                            echo mysqli_num_rows($getnumm);
                                            ?>">0</h5>
                                        <h6 class="text-muted m-t-10">
                                            Male(s)
                                        </h6>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6 col-xl-3">
                                    <div class="card-body">
                                        <div class="icon-rounded icon-rounded-info float-left m-r-20">
                                            <i class="icon icon-user-female"></i>
                                        </div>
                                        <h5 class="card-title m-b-5 counter" data-count="
<?php $getnumf = $mysqli->query("select * from `member` where gender = 'Female'");
                                        echo mysqli_num_rows($getnumf);
                                        ?>">0</h5>
                                        <h6 class="text-muted m-t-10">
                                            Female(s)
                                        </h6>

                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6 col-xl-3">
                                    <div class="card-body">
                                        <div class="icon-rounded icon-rounded-success float-left m-r-20">
                                            <i class="icon dripicons-user-group"></i>
                                        </div>
                                        <h5 class="card-title m-b-5 counter" data-count="

<?php $getnums = $mysqli->query("select * from `member` where maritalstatus = 'Single'");
                                        echo mysqli_num_rows($getnums);
                                        ?>">0</h5>
                                        <h6 class="text-muted m-t-10">
                                            Single(s)
                                        </h6>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-12">
                        <div class="card-deck m-b-100">
                            <div class="card card-elevate text-center">
                                <a href="#gettingStartedTitle" class="smooth-scroll">
                                    <div class="card-body">
                                        <i class="zmdi zmdi-compass zmdi-hc-fw font-size-80 text-primary"></i>
                                        <h5 class="card-title m-t-20">Getting Started</h5>
                                        <small class="text-muted">Brief tour of Church-IT management system</small>
                                    </div>
                                </a>
                            </div>
                            <div class="card card-elevate card-hover text-center">
                                <a href="#faqTitle" class="smooth-scroll">
                                    <div class="card-body">
                                        <i class="zmdi zmdi-comment-text zmdi-hc-fw font-size-80 text-primary"></i>
                                        <h5 class="card-title m-t-20">FAQ</h5>
                                        <small class="text-muted">Frequently Asked Questions about system usage</small>
                                    </div>
                                </a>
                            </div>
                            <div class="card card-elevate card-hover text-center">
                                <a href="#communityTitle" class="smooth-scroll">
                                    <div class="card-body">
                                        <i class="zmdi zmdi-group-work zmdi-hc-fw font-size-80 text-primary"></i>
                                        <h5 class="card-title  m-t-20">Community</h5>
                                        <small class="text-muted">Contact developers for system support</small>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

<?php require ('includes/footer.php')?>