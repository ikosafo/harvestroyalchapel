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
    <h5 class="card-header">Add New Convert</h5>
    <form name="branch_form" method="post" autocomplete="off">
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Full Name of Convert</label>
                <input type="text" class="form-control" id="full_name" placeholder="Enter full name of convert">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Telephone</label>
                <input type="text" class="form-control" id="telephone"
                       placeholder="Enter telephone" onkeypress="return isNumber(event);">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Residence</label>
                <input type="text" class="form-control" id="residence" placeholder="Enter residence">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Previous Denomination</label>
                <input type="text" class="form-control" id="denomination" placeholder="Enter previous denomination">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">How did you hear about us</label>
                <select id="hearing_about">
                    <option value="">Select</option>

                    <option value="A Friend">A Friend</option>
                    <option value="Poster">Poster</option>
                    <option value="Flier">Flier</option>
                    <option value="TV">TV</option>
                    <option value="Radio">Radio</option>
                    <option value="Internet">Internet</option>
                    <option value="Other">Other</option>


                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Description on your invitation</label>
                <textarea class="form-control" id="description"
                          placeholder="Enter description"></textarea>
            </div>


        </div>
        <div class="card-footer bg-light">
            <button type="button" class="btn btn-primary" id="save_convert">Submit</button>
            <button type="button" class="btn btn-secondary clear-form">Clear</button>
        </div>
    </form>
</div>

<script>

    $("#hearing_about").selectize();

    $(".select_permissions").selectize();

    $("#save_convert").click(function () {

        var full_name = $("#full_name").val();
        var telephone = $("#telephone").val();
        var residence = $("#residence").val();
        var denomination = $("#denomination").val();
        var hearing_about = $("#hearing_about").val();
        var description = $("#description").val();



        var error = '';

        if (full_name == "") {
            error += 'Please enter full name\n';
            $("#full_name").focus();
        }

        if (telephone == "") {
            error += 'Please enter telephone  \n';
            $("#telephone").focus();
        }

        if (residence == "") {
            error += 'Please enter residence \n';
            $("#residence").focus();
        }

        if (hearing_about == "") {
            error += 'How did you hear about us? \n';
        }

        if (description == "") {
            error += 'Describe how you heard about us \n';
            $("#description").focus();
        }




        if (error == "") {


            $.ajax({
                type: "POST",
                url: "ajax/queries/save_convert.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/img/load.gif" />'
                    });
                },
                data: {

                    full_name: full_name,
                    telephone: telephone,
                    denomination: denomination,
                    residence:residence,
                    hearing_about:hearing_about,
                    description:description

                },
                success: function (text) {

                    //alert(text);

                    if (text == 1) {

                        $('#success_loc').notify("Form submitted","success");

                        $.ajax({
                            url: "ajax/tables/convert_table.php",
                            beforeSend: function () {
                                $.blockUI({
                                    message: '<img src="assets/img/load.gif" />'
                                });
                            },

                            success: function (text) {
                                $('#convert_table_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                $.unblockUI();
                            },

                        });

                        $.ajax({
                            url: "ajax/forms/convert_form.php",
                            beforeSend: function () {
                                $.blockUI({
                                    message: '<img src="assets/img/load.gif" />'
                                });
                            },

                            success: function (text) {
                                $('#convert_form_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                $.unblockUI();
                            },

                        });


                    } else {

                        $('#error_loc').notify("convert details already exists","error");

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