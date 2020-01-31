<?php include ('../../../config.php');
$branch = $_SESSION['branch'];
$dep = $mysqli->query("select * from cell where branch = '$branch' ORDER by cell_name");
?>

    <div class="card">
        <h5 class="card-header">Cells </h5>
        <div class="card-body">
            <table id="bs4-table" class="table"
                   style="width:100% !important;">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Cell Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>

                <?php
                $counter = 1;
                while ($resdep = $dep->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $counter ?></td>
                        <td><?php echo $resdep['cell_name']; ?></td>
                        <td>
                            <button type="button"
                                    class="btn btn-sm btn-info edit_cell"
                                    i_index="<?php echo $resdep['id']; ?>"
                                    title="Edit"><i
                                    class="icon-pencil" style="color:#fff !important;"></i>
                            </button>
                        </td>
                        <td>
                            <button type="button"
                                    data-type="confirm"
                                    class="btn btn-sm btn-danger js-sweetalert delete_cell"
                                    i_index="<?php echo $resdep['id']; ?>"
                                    title="Delete">
                                <i class="icon-trash" style="color:#fff !important;"></i>
                            </button>

                        </td>
                    </tr>

                    <?php
                    $counter ++;
                }
                ?>
                </tbody>
                <tfoot>

            </table>
        </div>

    </div>

    <script>
        $('#bs4-table').DataTable({
            aaSorting: [],
            dom: 'Bfrtip'
        });

        $(document).on('click', '.edit_cell', function () {
            var id_index = $(this).attr('i_index');
            //alert(id_index);
            $.ajax({
                type: "POST",
                url: "ajax/forms/cell_form_edit.php",
                data:
                    {
                        id_index: id_index
                    },
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


        $(document).off('click', '.delete_cell').on('click', '.delete_cell', function () {
            var theindex = $(this).attr('i_index');
            $.confirm({
                title: 'Delete Cell!',
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
                                url: "ajax/queries/delete_cell.php",
                                data: {
                                    i_index: theindex
                                },
                                dataType: "html",
                                success: function (text) {
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

    </script>
