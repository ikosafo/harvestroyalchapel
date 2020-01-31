<?php include ('../../../config.php');

$branch = $_SESSION['branch'];

$dep = $mysqli->query("SELECT * FROM `f_partners` WHERE `branch` = '$branch' ORDER BY full_name");


?>

<div class="card">

    <h5 class="card-header">Partners List <strong>

        </strong></h5>
    <div class="card-body">

        <table id="bs4-table" class="table"
               style="width:100% !important;">
            <thead>
            <tr>
                <th>Full Name</th>
                <th>Telephone</th>
                <th>Denomination</th>
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
                    <td><?php echo $resdep['denomination']; ?></td>

                    <td>
                        <button type="button"
                                data-type="confirm"
                                class="btn btn-sm btn-danger js-sweetalert delete_partner"
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
    $('#bs4-table').DataTable({
        "scrollY": "125px",
        "paging": false
    });




    $(document).on('click', '.delete_partner', function () {
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
                        url: "ajax/queries/delete_partner.php",
                        data: {
                            i_index: i_index
                        },
                        dataType: "html",

                        success: function (text) {

                            $.ajax({
                                type: "POST",
                                url: "ajax/tables/partner_table.php",
                                beforeSend: function () {
                                    $.blockUI({
                                        message: '<img src="assets/img/load.gif"/>'
                                    });
                                },
                                success: function (text) {
                                    $('#partner_table_div').html(text);
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

                    swal("Deleted!", "Partner has been deleted.", "success");

                } else {
                    swal("Cancelled", "Data is safe.", "error");
                }
            });


    });

</script>

