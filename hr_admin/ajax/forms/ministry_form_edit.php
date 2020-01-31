<?php

include('../../../config.php');

$id_index = $_POST['id_index'];

$depq = $mysqli->query("select * from ministry where id = '$id_index'");
$depr = $depq->fetch_assoc();

$ministry_id = $depr['ministry_id'];


?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">Update Ministry</h5>
            <div class="card-body">

                <form>
                    <div class="form-group">
                        <label for="demoTextInput1">Ministry Name</label>
                        <input type="text" class="form-control" id="ministry_name_edit"
                               placeholder="Enter Updated Ministry Name"
                               value="<?php echo $depr['ministry_name'] ?>">
                    </div>

                    <div class="form-group">
                        <button style="margin-top: 20px" class="btn btn-secondary mr-2"
                                type="button" id="btn_cancel_ministry">Cancel</button>
                        <button style="margin-top: 20px" type="button" class="btn btn-primary"
                                id="updateministry"><i class="la la-edit" style="color: #fff"></i> Update
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<script>

    $("#btn_cancel_ministry").click(function () {


        $.ajax({
            type: "POST",
            url: "ajax/forms/ministry_form.php",
            beforeSend: function () {
                $.blockUI({
                    message: '<img src="assets/img/load.gif"/>'
                });
            },
            success: function (text) {
                $('#ministry_form_div').html(text);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " " + thrownError);
            },
            complete: function () {
                $.unblockUI();
            },

        });

    });

    $("#updateministry").click(function () {

        var ministry_name = $("#ministry_name_edit").val();
        var ministry_id = '<?php echo $ministry_id; ?>';

        //alert(ministry_name);

        var error = '';


        if (ministry_name == "") {
            error += 'Please enter ministry \n';
            $('#ministry_name').focus();
        }


        if (error == "") {


            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_ministry.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/img/load.gif"/>'
                    });
                },
                data: {

                    ministry_name: ministry_name,
                    ministry_id: ministry_id
                },
                success: function (text) {

                    //alert(text);

                    if (text == 1 || text == 3) {

                        $.notify("Ministry Saved", "success", {position: "top center"});

                        $.ajax({
                            type: "POST",
                            url: "ajax/forms/ministry_form.php",
                            beforeSend: function () {
                                $.blockUI({
                                    message: '<img src="assets/img/load.gif"/>'
                                });
                            },
                            success: function (text) {
                                $('#ministry_form_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                $.unblockUI();
                            },

                        });


                        $.ajax({
                            type: "POST",
                            url: "ajax/tables/ministry_table.php",
                            beforeSend: function () {
                                $.blockUI({
                                    message: '<img src="assets/img/load.gif"/>'
                                });
                            },
                            success: function (text) {
                                $('#ministry_table_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                $.unblockUI();
                            },

                        });

                    }

                    else if (text == 4) {

                        $.notify("Ministry name already exists,", {position: "top center"});

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

            $.notify(error, {position: "top center"});

        }

        return false;

    });

</script>