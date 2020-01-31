<?php include('../../../config.php');
$qubr=$mysqli->query("select * from branch ORDER BY name");
?>

<div class="card">
    <h5 class="card-header">Branches</h5>
    <div class="card-body">
        <table id="bs4-table" class="table" style="width:100%">
            <thead>
            <tr>
                <th>Name</th>
                <th>Location</th>
                <th>Code</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>

            <?php
            while($fet_br=$qubr->fetch_assoc())
            {
                ?>
                <tr>
                    <td><?php echo $fet_br['name'];?></td>
                    <td><?php echo $fet_br['location'];?></td>
                    <td><?php echo $fet_br['code'];?></td>
                    <td align="center">
                        <button type="button"
                                class="btn btn-sm btn-info edit_branch mr-1"
                                i_index="<?php echo $fet_br['id']; ?>"
                                title="Edit"><i
                                class="icon-pencil" style="color:#fff !important;"></i>
                        </button>
                        <button type="button"
                                data-type="confirm"
                                class="btn btn-sm btn-danger js-sweetalert delete_branch"
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


    $(document).on('click','.delete_branch', function(e) {
        var theindex = $(this).attr('i_index');

        swal({
                title: "Do you want to delete this?",
                text: "You will not be able to recover this data!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        type: "POST",
                        url: "ajax/queries/delete_branch.php",
                        data: {
                            theindex: theindex
                        },
                        dataType: "html",

                        success:function(text) {

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

                        },

                        complete: function () {

                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + " " + thrownError);
                        }
                    });

                    swal(
                        'Deleted!',
                        'Branch has been deleted.',
                        'success'
                    )
                } else {
                    swal("Cancelled", "Data is safe.", "error");
                }
            });


    });

    $(document).off('click', '.delete_branch').on('click', '.delete_branch', function () {
        var theindex = $(this).attr('i_index');
        $.confirm({
            title: 'Delete Branch!',
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
                            url: "ajax/queries/delete_branch.php",
                            data: {
                                theindex: theindex
                            },
                            dataType: "html",
                            success:function(text) {
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



    $(document).on('click','.edit_branch',function(){
        var theindex = $(this).attr('i_index');
        $.ajax({
            type: "POST",
            url: "ajax/forms/branch_form_edit.php",
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
                $('#branch_form_div').html(text);
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