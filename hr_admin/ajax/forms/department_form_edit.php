<?php

include('../../../config.php');

$id_index = $_POST['id_index'];

$depq = $mysqli->query("select * from department where id = '$id_index'");
$depr = $depq->fetch_assoc();

$department_id = $depr['department_id'];


?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">Update Department</h5>
            <div class="card-body">

                <form>
                    <div class="form-group">
                        <label for="demoTextInput1">Department Name</label>
                        <input type="text" class="form-control" id="department_name_edit"
                               placeholder="Enter Updated Department Name"
                               value="<?php echo $depr['department_name'] ?>">
                    </div>

                    <div class="form-group">
                        <button style="margin-top: 20px" class="btn btn-secondary mr-2"
                                type="button" id="btn_cancel_department">Cancel</button>
                        <button style="margin-top: 20px" type="button" class="btn btn-primary"
                                id="updatedepartment"><i class="la la-edit" style="color: #fff"></i> Update
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<script>

    $("#btn_cancel_department").click(function () {


        $.ajax({
            type: "POST",
            url: "ajax/forms/department_form.php",
            beforeSend: function () {
                $.blockUI({
                    message: '<img src="assets/img/load.gif"/>'
                });
            },
            success: function (text) {
                $('#department_form_div').html(text);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " " + thrownError);
            },
            complete: function () {
                $.unblockUI();
            },

        });

    });

    $("#updatedepartment").click(function () {

        var department_name = $("#department_name_edit").val();
        var department_id = '<?php echo $department_id; ?>';

        //alert(department_name);

        var error = '';


        if (department_name == "") {
            error += 'Please enter department \n';
            $('#department_name').focus();
        }


        if (error == "") {


            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_department.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/img/load.gif"/>'
                    });
                },
                data: {

                    department_name: department_name,
                    department_id: department_id
                },
                success: function (text) {

                    //alert(text);

                    if (text == 1 || text == 3) {

                        $.notify("Department Saved", "success", {position: "top center"});

                        $.ajax({
                            type: "POST",
                            url: "ajax/forms/department_form.php",
                            beforeSend: function () {
                                $.blockUI({
                                    message: '<img src="assets/img/load.gif"/>'
                                });
                            },
                            success: function (text) {
                                $('#department_form_div').html(text);
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
                            url: "ajax/tables/department_table.php",
                            beforeSend: function () {
                                $.blockUI({
                                    message: '<img src="assets/img/load.gif"/>'
                                });
                            },
                            success: function (text) {
                                $('#department_table_div').html(text);
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

                        $.notify("Department name already exists,", {position: "top center"});

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