<?php include ('../../../config.php');

$memberid = $_POST['member_id'];

$getchild = $mysqli->query("select * from children where memberid = '$memberid'");

?>

<table class="table table-bordered"
       style="width:100% !important;">

    <tbody>

    <?php
    while ($resch = $getchild->fetch_assoc()) {


        ?>
        <tr>
            <td><?php echo $resch['childname']; ?></td>

            <td>
                <button type="button"
                        data-type="confirm"
                        class="btn btn-sm btn-danger js-sweetalert delete_child"
                        i_index="<?php echo $resch['id']; ?>"
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
    <script>
        $('#bs4-table').DataTable({
            aaSorting: [],
            dom: 'Bfrtip'
        });




        $(document).on('click', '.delete_child', function () {
            var i_index = $(this).attr('i_index');
            var member_id = '<?php echo $memberid ?>';

            //alert(i_index);

            swal({
                    title: "Do you want to delete this child?",
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
                            url: "ajax/queries/delete_child.php",
                            data: {
                                i_index: i_index
                            },
                            dataType: "html",

                            success: function (text) {

                                $.ajax({
                                    type: "POST",
                                    url: "ajax/tables/child_table.php",
                                    data: {member_id:member_id},
                                    beforeSend: function () {
                                        $.blockUI({
                                            message: '<img src="assets/img/load.gif"/>'
                                        });
                                    },
                                    success: function (text) {
                                        $('#child_table_div').html(text);
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

                        swal("Deleted!", "Child has been deleted.", "success");

                    } else {
                        swal("Cancelled", "Data is safe.", "error");
                    }
                });


        });

    </script>
