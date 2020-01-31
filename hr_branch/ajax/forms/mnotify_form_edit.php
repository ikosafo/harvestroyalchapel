<?php

include('../../../config.php');

$id_index = $_POST['id_index'];

$depq = $mysqli->query("select * from mnotify where id = '$id_index'");
$depr = $depq->fetch_assoc();

$key_id = $depr['key_id'];



?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">Enter Key</h5>
            <div class="card-body">

                <form>
                    <div class="form-group">
                        <label for="demoTextInput1">Key</label>
                        <input type="text" class="form-control" id="mnotify_key"
                               placeholder="Enter Mnotify Key" value="<?php echo $depr['mnotify_key'] ?>">
                    </div>

                    <div class="form-group">
                        <button style="margin-top: 20px" class="btn btn-secondary mr-2"
                                type="button" id="btn_cancel_mnotify">Cancel</button>
                        <button style="margin-top: 20px" type="button" class="btn btn-primary"
                                id="updatemnotify"><i class="la la-edit" style="color: #fff"></i> Update
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<script>

    $("#btn_cancel_mnotify").click(function () {


        $.ajax({
            type: "POST",
            url: "ajax/forms/mnotify_form.php",
            beforeSend: function () {
                $.blockUI({
                    message: '<img src="assets/img/load.gif"/>'
                });
            },
            success: function (text) {
                $('#mnotify_form_div').html(text);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " " + thrownError);
            },
            complete: function () {
                $.unblockUI();
            },

        });

    });
    
    

    $("#updatemnotify").click(function () {

        var mnotify_key = $("#mnotify_key").val();
        var key_id = '<?php echo $key_id; ?>';

        //alert(mnotify_name);

        var error = '';


        if (mnotify_key == "") {
            error += 'Please enter key \n';
            $('#mnotify_key').focus();
        }


        if (error == "") {


            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_mnotify.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/img/load.gif"/>'
                    });
                },
                data: {

                    mnotify_key: mnotify_key,
                    key_id: key_id
                },
                success: function (text) {

                    //alert(text);

                    if (text == 1 || text == 3) {

                        $.notify("Key Updated", "success", {position: "top center"});

                        $.ajax({
                            type: "POST",
                            url: "ajax/forms/mnotify_form.php",
                            beforeSend: function () {
                                $.blockUI({
                                    message: '<img src="assets/img/load.gif"/>'
                                });
                            },
                            success: function (text) {
                                $('#mnotify_form_div').html(text);
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
                            url: "ajax/tables/mnotify_table.php",
                            beforeSend: function () {
                                $.blockUI({
                                    message: '<img src="assets/img/load.gif"/>'
                                });
                            },
                            success: function (text) {
                                $('#mnotify_table_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                $.unblockUI();
                            },

                        });

                    }

                    else if (text == 2 || text == 4) {

                        $.notify("Key already exists,", {position: "top center"});

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