<?php include("../../../config.php"); ?>
<div class="card">
    <div id="success_loc"></div>
    <div id="error_loc"></div>
    <h5 class="card-header">Add New Branch User</h5>
    <form name="branch_form" method="post" autocomplete="off">
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Full Name of User</label>
                <input type="text" class="form-control" id="full_name" placeholder="Enter full name of user">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Username</label>
                <input type="text" class="form-control" id="username" placeholder="Enter username">
            </div>
           <!-- <div class="form-group">
                <label for="exampleInputEmail1">Default Password</label>
                <input type="password" class="form-control" id="password" placeholder="Enter password">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" placeholder="Confirm password">
            </div>-->
            <div class="form-group">
                <label for="exampleInputEmail1">User Branch</label>
                <select class="select_branch" id="user_branch">
                    <option value="">Select Branch</option>

                    <?php
                    $query = $mysqli->query("select * from branch ORDER BY name");

                    while ($result = $query->fetch_assoc()) { ?>

                        <option value="<?php echo $result['id'] ?>"><?php echo $result['name'] ?></option>

                    <?php } ?>
                </select>
            </div>
            <div class="form-group" style="font-size: small">
                <label for="user_permissions">Permissions</label> <br/>
                NB: Any user added <i>here</i> is an administrator and has permission to all features
            </div>

        </div>
        <div class="card-footer bg-light">
            <button type="button" class="btn btn-primary" id="save_user">Submit</button>
            <button type="button" class="btn btn-secondary clear-form">Clear</button>
        </div>
    </form>
</div>

<script>

    $(".select_branch").selectize();

    $(".select_permissions").selectize();

    $("#save_user").click(function () {

        var full_name = $("#full_name").val();
        var username = $("#username").val();
        var user_branch = $("#user_branch").val();
        /*var password = $("#password").val();
        var confirm_password = $("#confirm_password").val();*/

        var error = '';
        if (full_name == "") {
            error += 'Please enter full name of user \n';
            $("#full_name").focus();
        }
        if (username == "") {
            error += 'Please enter username \n';
            $("#username").focus();
        }
        if (user_branch == "") {
            error += 'Please select branch of user \n';
            $("#user_branch").focus();
        }

       /* if (password == "") {
            error += 'Please enter password \n';
            $("#password").focus();
        }

        if (confirm_password == "") {
            error += 'Please confirm password \n';
            $("#confirm_password").focus();
        }

        if (password != "" && confirm_password != "" && password != confirm_password) {
            error += 'Passwords do not match \n';
            $("#confirm_password").focus();
        }
*/

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/save_user.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/img/load.gif" />'
                    });
                },
                data: {

                    full_name: full_name,
                    username: username,
                    user_branch: user_branch
                    //password:password
                },
                success: function (text) {
                    if (text == 1) {
                        $('#success_loc').notify("Form submitted","success");
                        $.ajax({
                            url: "ajax/tables/user_table.php",
                            beforeSend: function () {
                                $.blockUI({
                                    message: '<img src="assets/img/load.gif" />'
                                });
                            },
                            success: function (text) {
                                $('#user_table_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                $.unblockUI();
                            },
                        });
                        $.ajax({
                            url: "ajax/forms/user_form.php",
                            beforeSend: function () {
                                $.blockUI({
                                    message: '<img src="assets/img/load.gif" />'
                                });
                            },
                            success: function (text) {
                                $('#user_form_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                $.unblockUI();
                            },
                        });
                    } else {
                        $('#error_loc').notify("Username already exists","error");
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