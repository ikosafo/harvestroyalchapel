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
    <h5 class="card-header">Add New Partner</h5>
    <form name="branch_form" method="post" autocomplete="off">
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Full Name of Partner</label>
                <input type="text" class="form-control" id="full_name" placeholder="Enter full name of partner">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Telephone</label>
                <input type="text" class="form-control" id="telephone"
                       placeholder="Enter telephone" onkeypress="return isNumber(event);">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Denomination</label>
                <input type="text" class="form-control" id="denomination" placeholder="Enter denomination">
            </div>


        </div>
        <div class="card-footer bg-light">
            <button type="button" class="btn btn-primary" id="save_partner">Submit</button>
            <button type="button" class="btn btn-secondary clear-form">Clear</button>
        </div>
    </form>
</div>

<script>

    $("#save_partner").click(function () {

        var full_name = $("#full_name").val();
        var telephone = $("#telephone").val();
        var denomination = $("#denomination").val();


        var error = '';

        if (full_name == "") {
            error += 'Please enter full name\n';
            $("#full_name").focus();
        }

        if (telephone == "") {
            error += 'Please enter telephone  \n';
            $("#telephone").focus();
        }



        if (error == "") {


            $.ajax({
                type: "POST",
                url: "ajax/queries/save_partner.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/img/load.gif" />'
                    });
                },
                data: {

                    full_name: full_name,
                    telephone: telephone,
                    denomination: denomination

                },
                success: function (text) {

                    //alert(text);

                    if (text == 1) {

                        $('#success_loc').notify("Form submitted","success");

                        $.ajax({
                            url: "ajax/tables/partner_table.php",
                            beforeSend: function () {
                                $.blockUI({
                                    message: '<img src="assets/img/load.gif" />'
                                });
                            },

                            success: function (text) {
                                $('#partner_table_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                $.unblockUI();
                            },

                        });


                        $.ajax({
                            url: "ajax/forms/mp_list.php",
                            beforeSend: function () {
                                $.blockUI({
                                    message: '<img src="assets/img/load.gif" />'
                                });
                            },

                            success: function (text) {
                                $('#mp_list_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                $.unblockUI();
                            },

                        });


                    } else {

                        $('#error_loc').notify("Partner details already exists","error");

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