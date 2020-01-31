<?php include("../../../config.php"); ?>

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


<div class="card">
    <div id="success_loc"></div>
    <div id="error_loc"></div>
    <h5 class="card-header">Add New sms</h5>
    <form name="branch_form" method="post" autocomplete="off">
        <div class="card-body">

            <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input type="text" class="form-control" id="title" placeholder="Enter title">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Message</label>
                <textarea class="form-control" id="message" rows="20"
                          placeholder="Enter message"></textarea>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Send to</label>
                <input type="text" class="form-control" id="sendto" value="Every member" readonly>
            </div>

        </div>
        <div class="card-footer bg-light">
            <button type="button" class="btn btn-primary" id="save_sms">Submit</button>
            <button type="button" class="btn btn-secondary clear-form">Clear</button>
        </div>
    </form>
</div>



<script>


    $("#save_sms").click(function () {

        var title = $("#title").val();
        var message = $("#message").val();


        var error = '';

        if (title == "") {
            error += 'Enter title \n';
            $("#title").focus();
        }

        if (message == "") {
            error += 'Enter SMS to send \n';
            $("#message").focus();
        }



        if (error == "") {


            $.ajax({
                type: "POST",
                url: "ajax/queries/save_sms.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/img/load.gif" />'
                    });
                },
                data: {
                    message:message,
                    title:title
                },
                success: function (text) {

                    //alert(text);

                        $('#success_loc').notify("SMS Sent","success");

                        $.ajax({
                            url: "ajax/tables/sms_table.php",
                            beforeSend: function () {
                                $.blockUI({
                                    message: '<img src="assets/img/load.gif" />'
                                });
                            },

                            success: function (text) {
                                $('#sms_table_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                $.unblockUI();
                            },

                        });

                        $.ajax({
                            url: "ajax/forms/sms_form.php",
                            beforeSend: function () {
                                $.blockUI({
                                    message: '<img src="assets/img/load.gif" />'
                                });
                            },

                            success: function (text) {
                                $('#sms_form_div').html(text);
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