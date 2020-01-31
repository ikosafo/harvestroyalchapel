<?php include("../../../config.php"); ?>


<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">


<style>
    .ui-datepicker-calendar {
        display: none;
    }
</style>

<script>
    function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode != 46 && charCode > 31
            && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }

</script>

<div class="card">
    <div id="success_loc"></div>
    <div id="error_loc"></div>
    <h5 class="card-header">Add Tithe Record</h5>
    <form name="branch_form" method="post" autocomplete="off">
        <div class="card-body">


            <div class="row">
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Date Paid</label>
                        <input type="text" class="form-control" id="date_paid"
                               placeholder="Select Date" value="<?php echo date("Y-m-d"); ?>">
                    </div>

                </div>
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Member Name</label>
                        <input type="text" class="form-control" id="member_name" placeholder="Select Member">
                        <input type="hidden" id="memberid"/>
                    </div>


                </div>
            </div>


            Tithe payment for

            <hr/>

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Year - Month</label>
                        <input type="text" class="form-control monthYearPicker" id="year_month"
                               placeholder="Select Month">
                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Week</label>
                        <select id="week">
                            <option value="">Select</option>

                            <option value="Week 1">Week 1</option>
                            <option value="Week 2">Week 2</option>
                            <option value="Week 3">Week 3</option>
                            <option value="Week 4">Week 4</option>
                            <option value="Week 5">Week 5</option>

                        </select>
                    </div>

                </div>

            </div>


            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Payment Mode</label>
                        <select id="payment_mode">
                            <option value="">Select</option>

                            <option value="Cash">Cash</option>
                            <option value="Cheque">Cheque</option>
                            <option value="Mobile Money">Mobile Money</option>


                        </select>
                    </div>

                </div>


                <div class="col-md-6">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Amount</label>
                        <input type="text" id="amount" class="form-control"
                               placeholder="Enter amount" onkeypress="return isNumberKey(event)">

                    </div>

                </div>

            </div>


        </div>
        <div class="card-footer bg-light">
            <button type="button" class="btn btn-primary" id="save_tithe">Submit</button>

        </div>
    </form>
</div>


<script>


    $('.monthYearPicker').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'yy-mm'
    }).focus(function () {
        var thisCalendar = $(this);
        $('.ui-datepicker-calendar').detach();
        $('.ui-datepicker-close').click(function () {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            thisCalendar.datepicker('setDate', new Date(year, month, 1));
        });
    });

    $("#member_name").autocomplete({
        source: "ajax/forms/namesearch.php",
        minLength: 0,
        select: function (event, ui) {
            $("#member_name").val(ui.item.value);
            $("#memberid").val(ui.item.id);
        }
    }).data("ui-autocomplete")._renderItem = function (ul, item) {
        return $("<li class='ui-autocomplete-row'></li>")
            .data("item.autocomplete", item)
            .append(item.label)
            .appendTo(ul);
    };


    $("#date_paid").flatpickr();

    $("#week").selectize();

    $("#payment_mode").selectize();





    //SAVE TITHE
    $("#save_tithe").click(function () {

        var date_paid = $("#date_paid").val();
        var memberid = $("#memberid").val();
        var year_month = $("#year_month").val();
        var week = $("#week").val();
        var payment_mode = $("#payment_mode").val();
        var amount = $("#amount").val();


        var error = '';

        if (memberid == "") {
            error += 'Please select member \n';
            $("#member_name").focus();
        }

        if (date_paid == "") {
            error += 'Please select date paid \n';
        }

        if (year_month == "") {
            error += 'Please select year and month paid \n';
            $("#year_month").focus();
        }

        if (week == "") {
            error += 'Please select week \n';
        }

        if (payment_mode == "") {
            error += 'Please select payment mode \n';
        }

        if (amount == "") {
            error += 'Please enter amount \n';
            $("#amount").focus();
        }

        if (error == "") {


            $.ajax({
                type: "POST",
                url: "ajax/queries/save_tithe.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/img/load.gif" />'
                    });
                },
                data: {
                    
                    date_paid: date_paid,
                    memberid: memberid,
                    year_month: year_month,
                    week: week,
                    payment_mode: payment_mode,
                    amount: amount

                },
                success: function (text) {

                    //alert(text);

                    $('#success_loc').notify("Form submitted", "success");

                    $.ajax({
                        url: "ajax/tables/tithe_table.php",
                        beforeSend: function () {
                            $.blockUI({
                                message: '<img src="assets/img/load.gif" />'
                            });
                        },

                        success: function (text) {
                            $('#tithe_table_div').html(text);
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + " " + thrownError);
                        },
                        complete: function () {
                            $.unblockUI();
                        },

                    });

                    $.ajax({
                        url: "ajax/forms/tithe_form.php",
                        beforeSend: function () {
                            $.blockUI({
                                message: '<img src="assets/img/load.gif" />'
                            });
                        },

                        success: function (text) {
                            $('#tithe_form_div').html(text);
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + " " + thrownError);
                        },
                        complete: function () {
                            $.unblockUI();
                        },

                    });


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


</script>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


-->