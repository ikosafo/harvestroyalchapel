<?php include("../../../config.php"); ?>



<div class="card">
    <div id="success_loc"></div>
    <div id="error_loc"></div>
    <h5 class="card-header">Add New Service</h5>
    <form name="branch_form" method="post" autocomplete="off">
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Name of Service</label>
                <input type="text" class="form-control" id="service_name" placeholder="Enter name of service">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail1">Start Period</label>
                <input type="text" class="form-control" id="start_time" placeholder="Select time">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">End Period</label>
                <input type="text" class="form-control" id="end_time" placeholder="Select time">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Service Period</label>
                <select id="service_period">
                    <option value="">Select</option>

                    <option value="Morning">Morning</option>
                    <option value="Afternoon">Afternoon</option>
                    <option value="Evening">Evening</option>

                </select>
            </div>
            

        </div>
        <div class="card-footer bg-light">
            <button type="button" class="btn btn-primary" id="save_service">Submit</button>
            <button type="button" class="btn btn-secondary clear-form">Clear</button>
        </div>
    </form>
</div>

<script>


    $("#start_time").flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i"
    });

    $("#end_time").flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i"
    });


    $("#service_period").selectize();


    $("#save_service").click(function () {

        var service_name = $("#service_name").val();
        var start_time = $("#start_time").val();
        var end_time = $("#end_time").val();
        var service_period = $("#service_period").val();

        //alert(start_time);



        var error = '';

        if (service_name == "") {
            error += 'Please enter name of service \n';
            $("#service_name").focus();
        }

        if (start_time == "") {
            error += 'Please select start time \n';
        }

        if (end_time == "") {
            error += 'Please select end time \n';
        }

        if (service_period == "") {
            error += 'Please select service period \n';
        }




        if (error == "") {


            $.ajax({
                type: "POST",
                url: "ajax/queries/save_service.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/img/load.gif" />'
                    });
                },
                data: {

                    service_name: service_name,
                    start_time: start_time,
                    end_time:end_time,
                    service_period:service_period

                },
                success: function (text) {

                    //alert(text);


                        $('#success_loc').notify("Form submitted","success");

                        $.ajax({
                            url: "ajax/tables/service_table.php",
                            beforeSend: function () {
                                $.blockUI({
                                    message: '<img src="assets/img/load.gif" />'
                                });
                            },

                            success: function (text) {
                                $('#service_table_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                $.unblockUI();
                            },

                        });

                        $.ajax({
                            url: "ajax/forms/service_form.php",
                            beforeSend: function () {
                                $.blockUI({
                                    message: '<img src="assets/img/load.gif" />'
                                });
                            },

                            success: function (text) {
                                $('#service_form_div').html(text);
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