<div class="card">
    <div id="success_loc"></div>
    <div id="error_loc"></div>
    <h5 class="card-header">Add New Branch</h5>
    <form name="branch_form" method="post">
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Branch Name</label>
                <input type="text" class="form-control" id="branch_name" placeholder="Enter name of branch">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Branch Location</label>
                <input type="text" class="form-control" id="branch_location" placeholder="Enter location of branch">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Branch Code</label>
                <input type="text" class="form-control" id="branch_code" placeholder="Enter branch code">
                <small id="emailHelp3" class="form-text text-muted">Helps in assigning IDs to members and asset registry</small>
            </div>

        </div>
        <div class="card-footer bg-light">
            <button type="button" class="btn btn-primary" id="save_branch">Submit</button>
            <button type="button" class="btn btn-secondary clear-form">Clear</button>
        </div>
    </form>
</div>

<script>

    $("#save_branch").click(function () {

        var branch_name = $("#branch_name").val();
        var branch_location = $("#branch_location").val();
        var branch_code = $("#branch_code").val();


        var error = '';

        if (branch_name == "") {
            error += 'Please enter branch name \n';
            $("#branch_name").focus();
        }

        if (branch_location == "") {
            error += 'Please enter branch location \n';
            $("#branch_location").focus();
        }



        if (error == "") {


            $.ajax({
                type: "POST",
                url: "ajax/queries/save_branch.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/img/load.gif" />'
                    });
                },
                data: {

                    branch_name: branch_name,
                    branch_location: branch_location,
                    branch_code: branch_code

                },
                success: function (text) {

                    if (text == 1) {

                        $('#success_loc').notify("Form submitted","success");

                        $.ajax({
                            url: "ajax/tables/branch_table.php",
                            beforeSend: function () {
                                $.blockUI({
                                    message: '<img src="assets/img/load.gif" />'
                                });
                            },

                            success: function (text) {
                                $('#branch_table_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                $.unblockUI();
                            },

                        });

                        $.ajax({
                            url: "ajax/forms/branch_form.php",
                            beforeSend: function () {
                                $.blockUI({
                                    message: '<img src="assets/img/load.gif" />'
                                });
                            },

                            success: function (text) {
                                $('#branch_form_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                $.unblockUI();
                            },

                        });


                    } else {

                        $('#error_loc').notify("Branch already exists","error");

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