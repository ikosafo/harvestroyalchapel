<?php require ('includes/header.php')?>


<!--START PAGE CONTENT -->
<section class="page-content container-fluid">

    <div class="mr-auto">
        <ul class="actions top-right">
            <li>
                <a href="javascript:void(0)" class="btn btn-primary btn-floating">
                    SEARCH ATTENDANCE
                </a>
            </li>
        </ul>
    </div>

    <hr/>



    <div class="row">

        <div class="col-md-4 col-sm-12 col-lg-4">
            <div class="card">
                <h5 class="card-header">Select Dates to Search for Attendance</h5>
                <div class="card-body">

                    <form>

                        <div class="form-group">
                            <label for="demoTextInput1">Select Dates</label>
                            <input type="text" class="form-control" id="select_dates"
                                   placeholder="Click to Select Date ranges">
                        </div>

                        <div class="form-group">
                            <button type="button" class="btn btn-primary mt-lg-2"
                                    id="search_attendance">
                                <i class="zmdi zmdi-search zmdi-hc-fw" style="color: #fff"></i> Search
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8 col-sm-12 col-lg-8">
            <div id="attendance_search_table_div"></div>
        </div>

    </div>

</section>

<?php require ('includes/footer.php')?>


<script>

    $("#select_dates").flatpickr({
        mode: "range",
        maxDate: "today"
    });

    $("#search_attendance").click(function(){

        var daterange = $("#select_dates").val();

        var error = "";

        if (daterange == "") {
            error+= "Please select date range \n";
        }


        if (error == "") {


            $.ajax({
                type: "POST",
                url: "ajax/queries/search_attendance.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/img/load.gif"/>'
                    });
                },
                data: {

                    date_range: daterange

                },
                success: function (text) {

                    //alert(text);

                    $('#attendance_search_table_div').html(text);

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

            $.notify(error, {position: "top center"});

        }

        return false;


    });


</script>
