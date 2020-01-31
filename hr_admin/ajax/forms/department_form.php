<?php

include('../../../config.php');

$deptid = date("ymdhis").rand(1,10000);

?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">Enter Department</h5>
            <div class="card-body">

                <form>
                    <div class="form-group">
                        <label for="demoTextInput1">Department Name</label>
                        <input type="text" class="form-control" id="department_name"
                               placeholder="Enter Department Name">
                    </div>

                    <div class="form-group">
                        <button style="margin-top: 20px" type="button" class="btn btn-primary"
                                id="savedepartment"><i class="zmdi zmdi-plus-circle-o zmdi-hc-fw" style="color: #fff"></i> Save
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<script>

    $("#savedepartment").click(function () {

        var department_name = $("#department_name").val();
        var department_id = '<?php echo $deptid; ?>';

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

                    if (text == 1) {

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

                    else if (text == 2) {

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