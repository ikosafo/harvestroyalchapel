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
    <h5 class="card-header">Add Contribution Record</h5>
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


            Contributions payment for

            <hr/>

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Purpose</label>
                        <textarea class="form-control" id="purpose"
                                  placeholder="Enter Purpose"></textarea>
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
            <button type="button" class="btn btn-primary" id="save_contributions">Submit</button>

        </div>
    </form>
</div>


<script>

;

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



    //SAVE contributions
    $("#save_contributions").click(function () {

        var date_paid = $("#date_paid").val();
        var memberid = $("#memberid").val();
        var purpose = $("#purpose").val();
        var amount = $("#amount").val();


        var error = '';

        if (memberid == "") {
            error += 'Please select member \n';
            $("#member_name").focus();
        }

        if (date_paid == "") {
            error += 'Please select date paid \n';
        }

        if (purpose == "") {
            error += 'Please enter purpose \n';
            $("#purpose").focus();
        }

        if (amount == "") {
            error += 'Please enter amount \n';
            $("#amount").focus();
        }

        if (error == "") {


            $.ajax({
                type: "POST",
                url: "ajax/queries/save_contributions.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/img/load.gif" />'
                    });
                },
                data: {

                    date_paid: date_paid,
                    memberid: memberid,
                    purpose: purpose,
                    amount: amount

                },
                success: function (text) {

                    //alert(text);

                    $('#success_loc').notify("Form submitted", "success");

                    $.ajax({
                        url: "ajax/tables/contributions_table.php",
                        beforeSend: function () {
                            $.blockUI({
                                message: '<img src="assets/img/load.gif" />'
                            });
                        },

                        success: function (text) {
                            $('#contributions_table_div').html(text);
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + " " + thrownError);
                        },
                        complete: function () {
                            $.unblockUI();
                        },

                    });

                    $.ajax({
                        url: "ajax/forms/contributions_form.php",
                        beforeSend: function () {
                            $.blockUI({
                                message: '<img src="assets/img/load.gif" />'
                            });
                        },

                        success: function (text) {
                            $('#contributions_form_div').html(text);
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