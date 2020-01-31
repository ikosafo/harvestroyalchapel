<?php include("../../../config.php"); ?>


<link rel="stylesheet" href="assets/css/jquery-ui.css">


<div class="card">
    <div id="success_loc"></div>
    <div id="error_loc"></div>

    <h5 class="card-header">Add Church Worker</h5>

    <form name="branch_form" method="post" autocomplete="off">
        <div class="card-body">


            <div class="row">
                <div class="col-md-12">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Member Name</label>
                        <input type="text" class="form-control" id="member_name"
                               placeholder="Select Member">
                        <input type="hidden" id="memberid"/>
                    </div>

                </div>

            </div>


        </div>
        <div class="card-footer bg-light">
            <button type="button" class="btn btn-primary" id="save_worker">Submit</button>

        </div>
    </form>
</div>


<script>



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




    //SAVE worker
    $("#save_worker").click(function () {

        var memberid = $("#memberid").val();

        var error = '';

        if (memberid == "") {
            error += 'Please select member \n';
            $("#member_name").focus();
        }


        if (error == "") {


            $.ajax({
                type: "POST",
                url: "ajax/queries/save_worker.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/img/load.gif" />'
                    });
                },
                data: {

                    memberid: memberid

                },
                success: function (text) {

                    //alert(text);

                    if (text == 1) {


                        $('#success_loc').notify("Form submitted", "success");

                        $.ajax({
                            url: "ajax/tables/worker_table.php",
                            beforeSend: function () {
                                $.blockUI({
                                    message: '<img src="assets/img/load.gif" />'
                                });
                            },

                            success: function (text) {
                                $('#worker_table_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                $.unblockUI();
                            },

                        });

                        $.ajax({
                            url: "ajax/forms/worker_form.php",
                            beforeSend: function () {
                                $.blockUI({
                                    message: '<img src="assets/img/load.gif" />'
                                });
                            },

                            success: function (text) {
                                $('#worker_form_div').html(text);
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
                        $('#error_loc').notify('Worker already exists','error');
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


</script>

