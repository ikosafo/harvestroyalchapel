<?php

include('../../../config.php');

$id_index = $_POST['id_index'];

$depq = $mysqli->query("select * from cell where id = '$id_index'");
$depr = $depq->fetch_assoc();

$cell_id = $depr['cell_id'];


?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">Update Cell</h5>
            <div class="card-body">

                <form>
                    <div class="form-group">
                        <label for="demoTextInput1">Cell Name</label>
                        <input type="text" class="form-control" id="cell_name_edit"
                               placeholder="Enter Updated Cell Name"
                               value="<?php echo $depr['cell_name'] ?>">
                    </div>

                    <div class="form-group">
                        <button style="margin-top: 20px" class="btn btn-secondary mr-2"
                                type="button" id="btn_cancel_cell">Cancel</button>
                        <button style="margin-top: 20px" type="button" class="btn btn-primary"
                                id="updatecell"><i class="la la-edit" style="color: #fff"></i> Update
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<script>

    $("#btn_cancel_cell").click(function () {


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

    });

    $("#updatecell").click(function () {

        var cell_name = $("#cell_name_edit").val();
        var cell_id = '<?php echo $cell_id; ?>';

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

                    if (text == 1 || text == 3) {

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

                    else if (text == 4) {

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