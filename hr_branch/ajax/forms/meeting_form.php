<?php include("../../../config.php"); ?>

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

    <h5 class="card-header">Add Meeting Details</h5>

    <form name="branch_form" method="post" autocomplete="off">
        <div class="card-body">


            <div class="row">
                <div class="col-md-12">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Meeting Name</label>
                        <input type="text" class="form-control" id="meetingname"
                               placeholder="Enter name of meeting">

                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Meeting Period</label>
                        <input type="text" class="form-control" id="meetingperiod"
                               placeholder="Select period of meeting">

                    </div>


                    Attendance
                    <hr/>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Men</label>
                        <input type="text" class="form-control" id="men"
                               placeholder="Enter number of men" onkeypress="return isNumberKey(event)">

                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Women</label>
                        <input type="text" class="form-control" id="women"
                               placeholder="Enter number of women" onkeypress="return isNumberKey(event)">

                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Youth (Guys)</label>
                        <input type="text" class="form-control" id="guys"
                               placeholder="Enter number of youth guys" onkeypress="return isNumberKey(event)">

                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Youth (Ladies)</label>
                        <input type="text" class="form-control" id="ladies"
                               placeholder="Enter number of youth ladies" onkeypress="return isNumberKey(event)">

                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Children</label>
                        <input type="text" class="form-control" id="children"
                               placeholder="Enter number of children" onkeypress="return isNumberKey(event)">

                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Offering</label>
                        <input type="text" class="form-control" id="offering"
                               placeholder="Enter Offering" onkeypress="return isNumberKey(event)">

                    </div>

                </div>

            </div>


        </div>
        <div class="card-footer bg-light">
            <button type="button" class="btn btn-primary" id="save_meeting">Submit</button>

        </div>
    </form>
</div>


<script>

    $("#meetingperiod").flatpickr({
        enableTime: true,
        mode: "range",
        dateFormat: "Y-m-d H:i"
    });

    //SAVE meeting
    $("#save_meeting").click(function () {

        var meetingname = $("#meetingname").val();
        var meetingperiod = $("#meetingperiod").val();
        var men = $("#men").val();
        var women = $("#women").val();
        var guys = $("#guys").val();
        var ladies = $("#ladies").val();
        var children = $("#children").val();
        var offering = $("#offering").val();

        var error = '';

        if (meetingname == "") {
            error += 'Please enter meeting name \n';
            $("#membername").focus();
        }

        if (meetingperiod == "") {
            error += 'Please select meeting period \n';

        }

        if (men == "") {
            error += 'Please enter number of men \n';
            $("#men").focus();
        }

        if (women == "") {
            error += 'Please enter number of women \n';
            $("#women").focus();
        }

        if (ladies == "") {
            error += 'Please enter number of ladies \n';
            $("#ladies").focus();
        }

        if (guys == "") {
            error += 'Please enter number of guys \n';
            $("#guys").focus();
        }

        if (children == "") {
            error += 'Please enter number of children \n';
            $("#children").focus();
        }

        if (offering == "") {
            error += 'Please enter amount for offering \n';
            $("#offering").focus();
        }


        if (error == "") {


            $.ajax({
                type: "POST",
                url: "ajax/queries/save_meeting.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/img/load.gif" />'
                    });
                },
                data: {

                    meetingname: meetingname,
                    meetingperiod: meetingperiod,
                    men: men,
                    women: women,
                    guys: guys,
                    ladies: ladies,
                    children:children,
                    offering:offering
 

        },
                success: function (text) {

                    //alert(text);

                   
                        $('#success_loc').notify("Form submitted", "success");

                        $.ajax({
                            url: "ajax/tables/meeting_table.php",
                            beforeSend: function () {
                                $.blockUI({
                                    message: '<img src="assets/img/load.gif" />'
                                });
                            },

                            success: function (text) {
                                $('#meeting_table_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                $.unblockUI();
                            },

                        });

                        $.ajax({
                            url: "ajax/forms/meeting_form.php",
                            beforeSend: function () {
                                $.blockUI({
                                    message: '<img src="assets/img/load.gif" />'
                                });
                            },

                            success: function (text) {
                                $('#meeting_form_div').html(text);
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


            $.notify(error, {position: "top center"});

        }
        return false;


    });


</script>

