<?php include ('../../../config.php');

$branch = $_SESSION['branch'];

$dep = $mysqli->query("SELECT * FROM `sms` WHERE `branch` = '$branch' ORDER BY `date` DESC");


?>

<div class="card">

    <h5 class="card-header">Messages <strong>

        </strong></h5>
    <div class="card-body">

        <table id="bs4-table" class="table"
               style="width:100% !important;">
            <thead>
            <tr>
                <th>No</th>
                <th>Group</th>
                <th>title</th>
                <th>Message</th>


            </tr>
            </thead>
            <tbody>

            <?php
            while ($resdep = $dep->fetch_assoc()) {


                ?>
                <tr>
                    <td><input type="checkbox"/></td>
                    <td><?php echo $resdep['group']; ?></td>
                    <td><?php echo $resdep['title']; ?></td>
                    <td><?php echo $resdep['message']; ?></td>
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

