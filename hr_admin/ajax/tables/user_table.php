<?php include('../../../config.php');
$qubr=$mysqli->query("select * from users_admin ORDER BY fullname");
?>

<div class="card">
    <h5 class="card-header">Users</h5>
    <div class="card-body">
        <table id="bs4-table" class="table" style="width:100%">
            <thead>
            <tr>
                <th>Full Name</th>
                <th>Username</th>
                <th>Branch</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>

            <?php
            while($fet_br=$qubr->fetch_assoc())
            {

                ?>
                <tr>
                    <td><?php echo $fet_br['fullname'];?></td>
                    <td><?php echo $fet_br['username'];?></td>
                    <td><?php $branchid = $fet_br['branch'];
                       $getbranch = $mysqli->query("select * from branch where id = '$branchid'");
                       $resbranch = $getbranch->fetch_assoc();
                       echo $resbranch['name'];
                    ?></td>
                    <td align="center">
                        <button type="button"
                                class="btn btn-sm btn-info edit_user mr-1"
                                i_index="<?php echo $fet_br['id']; ?>"
                                title="Edit"><i
                                class="icon-pencil" style="color:#fff !important;"></i>
                        </button>
                        <button type="button"
                                data-type="confirm"
                                class="btn btn-sm btn-danger js-sweetalert delete_user"
                                i_index="<?php echo $fet_br['id']; ?>"
                                title="Delete">
                            <i class="icon-trash" style="color:#fff !important;"></i>
                        </button>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>


<script>

    $('#bs4-table').DataTable();

    $(document).off('click', '.delete_user').on('click', '.delete_user', function () {
        var theindex = $(this).attr('i_index');
        $.confirm({
            title: 'Delete User!',
            content: 'Are you sure to continue?',
            buttons: {
                no: {
                    text: 'No',
                    keys: ['enter', 'shift'],
                    backdrop: 'static',
                    keyboard: false,
                    action: function () {
                        $.alert('Data is safe');
                    }
                },
                yes: {
                    text: 'Yes, Delete it!',
                    btnClass: 'btn-blue',
                    action: function () {
                        $.ajax({
                            type: "POST",
                            url: "ajax/queries/delete_user.php",
                            data: {
                                theindex: theindex
                            },
                            dataType: "html",
                            success:function(text) {
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
                            },
                            complete: function () {
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            }
                        });
                    }
                }
            }
        });
    });



    $(document).on('click','.edit_user',function(){
        var theindex = $(this).attr('i_index');
        $.ajax({
            type: "POST",
            url: "ajax/forms/user_form_edit.php",
            data:{
                theindex:theindex
            },
            dataType: "html",
            beforeSend: function(){
                $.blockUI({
                    message: '<img src="assets/img/load.gif" />'
                });
            },
            success: function(text) {
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
</script>