<?php include ('../../../config.php');

//$branch = $_SESSION['branch'];

$dep = $mysqli->query("SELECT * FROM `visitor` ORDER BY `period` DESC");


?>

<div class="card">

    <h5 class="card-header">Visitors <strong>

        </strong></h5>
    <div class="card-body">

        <table id="bs4-table" class="table"
               style="width:100% !important;">
            <thead>
            <tr>
                <th>Full Name</th>
                <th>Branch</th>
                <th>Telephone</th>
                <th>Residence</th>
                <th>Previous Denomination</th>
                <th>How did you hear about us?</th>
                <th>Description</th>


            </tr>
            </thead>
            <tbody>

            <?php
            while ($resdep = $dep->fetch_assoc()) {


                ?>
                <tr>
                    <td><?php echo $resdep['full_name']; ?></td>
                    <td>
                        <?php
                        $branchid = $resdep['branch'];
                        $getb = $mysqli->query("select * from branch where id = '$branchid'");
                        $resb = $getb->fetch_assoc();
                        echo $resb['name'];

                        ?>
                    </td>
                    <td><?php echo $resdep['telephone']; ?></td>
                    <td><?php echo $resdep['residence']; ?></td>
                    <td><?php echo $resdep['denomination']; ?></td>
                    <td><?php echo $resdep['hearing_about']; ?></td>
                    <td><?php echo $resdep['description']; ?></td>




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




    $(document).on('click', '.delete_visitor', function () {
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
                        url: "ajax/queries/delete_visitor.php",
                        data: {
                            i_index: i_index
                        },
                        dataType: "html",

                        success: function (text) {

                            $.ajax({
                                type: "POST",
                                url: "ajax/tables/visitor_table.php",
                                beforeSend: function () {
                                    $.blockUI({
                                        message: '<img src="assets/img/load.gif"/>'
                                    });
                                },
                                success: function (text) {
                                    $('#visitor_table_div').html(text);
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

                    swal("Deleted!", "Visitor has been deleted.", "success");

                } else {
                    swal("Cancelled", "Data is safe.", "error");
                }
            });


    });

</script>

