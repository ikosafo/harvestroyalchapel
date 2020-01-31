<?php
include("../../../config.php");

$u_id=$_POST['theindex'];

$u_query = $mysqli->query("select * from users_admin where id = '$u_id'");
$u_result = $u_query->fetch_assoc();

?>
<div class="card">
    <div id="success_loc"></div>
    <div id="error_loc"></div>
    <h5 class="card-header">Update Branch User</h5>
    <form name="user_form" method="post" autocomplete="off">
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Full Name of User</label>
                <input type="text" class="form-control" id="full_name"
                       placeholder="Enter full name of user"
                       value="<?php echo $u_result['fullname']; ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Username</label>
                <input type="text" class="form-control" id="username"
                       placeholder="Enter username"
                       value="<?php echo $u_result['username']; ?>">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">User Branch</label>
                <select class="select_branch" id="user_branch">
                    <option value="">Select Branch</option>


                    <?php

                    $user_branch = $u_result['branch'];

                    $query = $mysqli->query("select * from branch ORDER BY name");

                    while ($result = $query->fetch_assoc()) { ?>

                        <option <?php if (@$user_branch == @$result['id']) echo "Selected" ?>><?php echo $result['name'] ?></option>

                    <?php } ?>

                </select>
            </div>
            <div class="form-group" style="font-size: small">
                <label for="user_permissions">Permissions</label> <br/>
                NB: Any user added <i>here</i> is an administrator and has permission to all features
            </div>

        </div>
        <div class="card-footer bg-light">
            <button type="button" class="btn btn-default" id="back_btn">Back</button>
            <button type="button" class="btn btn-primary" id="edit_user">Edit</button>
        </div>
    </form>
</div>

<script>

    $(".select_branch").selectize();

    $(".select_permissions").selectize();

    $("#back_btn").click(function () {

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

    });

    $("#edit_user").click(function () {

        var full_name = $("#full_name").val();
        var username = $("#username").val();
        var user_branch = $("#user_branch").val();
        var user_id = '<?php echo $u_id ?>';

        //alert(user_branch);

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
            error += 'Please enter branch of user \n';
            $("#user_branch").focus();
        }




        if (error == "") {


            $.ajax({
                type: "POST",
                url: "ajax/queries/save_user_edit.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/img/load.gif" />'
                    });
                },
                data: {

                    full_name: full_name,
                    username: username,
                    user_branch: user_branch,
                    user_id: user_id

                },
                success: function (text) {

                    //alert(text);

                    if (text == 1) {

                        $('#success_loc').notify("User Edited","success");

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