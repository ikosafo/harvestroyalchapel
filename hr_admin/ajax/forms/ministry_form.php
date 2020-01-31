<?php

include('../../../config.php');

$ministryid = date("ymdhis").rand(1,10000);

?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">Enter Ministry</h5>
            <div class="card-body">

                <form>
                    <div class="form-group">
                        <label for="demoTextInput1">Ministry Name</label>
                        <input type="text" class="form-control" id="ministry_name"
                               placeholder="Enter Ministry Name">
                    </div>

                    <div class="form-group">
                        <button style="margin-top: 20px" type="button" class="btn btn-primary"
                                id="saveministry"><i class="zmdi zmdi-plus-circle-o zmdi-hc-fw" style="color: #fff"></i> Save
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<script>

    $("#saveministry").click(function () {

        var ministry_name = $("#ministry_name").val();
        var ministry_id = '<?php echo $ministryid; ?>';

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

                    if (text == 1) {

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

                    else if (text == 2) {

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