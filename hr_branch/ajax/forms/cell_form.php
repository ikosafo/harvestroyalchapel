<?php

include('../../../config.php');

$cellid = date("ymdhis").rand(1,10000);

?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">Enter Cell</h5>
            <div class="card-body">

                <form>
                    <div class="form-group">
                        <label for="demoTextInput1">Cell Name</label>
                        <input type="text" class="form-control" id="cell_name"
                               placeholder="Enter Cell Name">
                    </div>

                    <div class="form-group">
                        <button style="margin-top: 20px" type="button" class="btn btn-primary"
                                id="savecell"><i class="zmdi zmdi-plus-circle-o zmdi-hc-fw" style="color: #fff"></i> Save
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<script>

    $("#savecell").click(function () {

        var cell_name = $("#cell_name").val();
        var cell_id = '<?php echo $cellid; ?>';

        //alert(cell_name);

        var error = '';


        if (cell_name == "") {
            error += 'Please enter cell \n';
            $('#cell_name').focus();
        }


        if (error == "") {


            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_cell.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/img/load.gif"/>'
                    });
                },
                data: {

                    cell_name: cell_name,
                    cell_id: cell_id
                },
                success: function (text) {

                    //alert(text);

                    if (text == 1) {

                        $.notify("Cell Saved", "success", {position: "top center"});

                        $.ajax({
                            type: "POST",
                            url: "ajax/forms/cell_form.php",
                            beforeSend: function () {
                                $.blockUI({
                                    message: '<img src="assets/img/load.gif"/>'
                                });
                            },
                            success: function (text) {
                                $('#cell_form_div').html(text);
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
                            url: "ajax/tables/cell_table.php",
                            beforeSend: function () {
                                $.blockUI({
                                    message: '<img src="assets/img/load.gif"/>'
                                });
                            },
                            success: function (text) {
                                $('#cell_table_div').html(text);
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

                        $.notify("Cell name already exists,", {position: "top center"});

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