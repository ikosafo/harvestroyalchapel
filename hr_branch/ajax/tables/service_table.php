<?php include ('../../../config.php');

$branch = $_SESSION['branch'];

$dep = $mysqli->query("SELECT * FROM `service` WHERE `branch` = '$branch' ORDER BY start_period DESC ,`period` DESC");


?>

<div class="card">

    <h5 class="card-header">Services <strong>

        </strong></h5>
    <div class="card-body">

        <table id="bs4-table" class="table table-responsive"
               style="width:100% !important;">
            <thead>
            <tr>
                <th>No</th>
                <th>Service Name</th>
                <th>Start Period</th>
                <th>End Period</th>
                <th>Service Period</th>
                <th>Status</th>
                <th>Delete</th>

            </tr>
            </thead>
            <tbody>

            <?php
            while ($resdep = $dep->fetch_assoc()) {


                ?>
                <tr>
                    <td><input type="checkbox"/></td>
                    <td><?php echo $resdep['service_name']; ?></td>
                    <td><?php echo $start_period = $resdep['start_period']; ?></td>
                    <td><?php echo $end_period = $resdep['end_period']; ?></td>
                    <td><?php echo $resdep['service_period']; ?></td>
                    <td><?php
                        $now = date('Y-m-d H:i:s');

                        if ($now < $start_period){
                        echo "Not Started";
                        }

                        else if ($now >= $start_period && $now <= $end_period) {
                            echo "Ongoing";
                        }

                        else {
                            echo "Completed";
                        }
                         ?></td>

                    <td>
                        <button type="button"
                                data-type="confirm"
                                class="btn btn-sm btn-danger js-sweetalert delete_service"
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




    $(document).on('click', '.delete_service', function () {
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
                        url: "ajax/queries/delete_service.php",
                        data: {
                            i_index: i_index
                        },
                        dataType: "html",

                        success: function (text) {

                            $.ajax({
                                type: "POST",
                                url: "ajax/tables/service_table.php",
                                beforeSend: function () {
                                    $.blockUI({
                                        message: '<img src="assets/img/load.gif"/>'
                                    });
                                },
                                success: function (text) {
                                    $('#service_table_div').html(text);
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

                    swal("Deleted!", "Service has been deleted.", "success");

                } else {
                    swal("Cancelled", "Data is safe.", "error");
                }
            });


    });

</script>

