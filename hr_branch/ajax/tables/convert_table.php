<?php include ('../../../config.php');

$branch = $_SESSION['branch'];

$dep = $mysqli->query("SELECT * FROM `convert` WHERE `branch` = '$branch' ORDER BY `period` DESC");


?>

    <div class="card">

        <h5 class="card-header">Converts <strong>

            </strong></h5>
        <div class="card-body">

            <table id="bs4-table" class="table table-responsive"
                   style="width:100% !important;">
                <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Telephone</th>
                    <th>Residence</th>
                    <th>Previous Denomination</th>
                    <th>How did you hear about us?</th>
                    <th>Description</th>
                    <th>Delete</th>

                </tr>
                </thead>
                <tbody>

                <?php
                while ($resdep = $dep->fetch_assoc()) {


                    ?>
                    <tr>
                        <td><?php echo $resdep['full_name']; ?></td>
                        <td><?php echo $resdep['telephone']; ?></td>
                        <td><?php echo $resdep['residence']; ?></td>
                        <td><?php echo $resdep['denomination']; ?></td>
                        <td><?php echo $resdep['hearing_about']; ?></td>
                        <td><?php echo $resdep['description']; ?></td>

                        <td>
                            <button type="button"
                                    data-type="confirm"
                                    class="btn btn-sm btn-danger js-sweetalert delete_convert"
                                    i_index="<?php echo $resdep['id']; ?>"
                                    title="Delete">
                                <i class="icon-trash" style="color:#fff !important;"></i>
                            </button>

                        </td>




                    </tr>

                    <?php
                }
                ?>
                </tbody>
                <tfoot>

            </table>


        </div>



    </div>

    <script>
        $('#bs4-table').DataTable();




        $(document).on('click', '.delete_convert', function () {
            var i_index = $(this).attr('i_index');

            //alert(i_index);

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
                            url: "ajax/queries/delete_convert.php",
                            data: {
                                i_index: i_index
                            },
                            dataType: "html",

                            success: function (text) {

                                $.ajax({
                                    type: "POST",
                                    url: "ajax/tables/convert_table.php",
                                    beforeSend: function () {
                                        $.blockUI({
                                            message: '<img src="assets/img/load.gif"/>'
                                        });
                                    },
                                    success: function (text) {
                                        $('#convert_table_div').html(text);
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

                        swal("Deleted!", "Convert has been deleted.", "success");

                    } else {
                        swal("Cancelled", "Data is safe.", "error");
                    }
                });


        });

    </script>

