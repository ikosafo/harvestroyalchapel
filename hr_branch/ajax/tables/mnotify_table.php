<?php include ('../../../config.php');

$branch = $_SESSION['branch'];

$dep = $mysqli->query("select * from mnotify where branch = '$branch'");


?>

    <div class="card">

        <h5 class="card-header">Mnotify SMS Key <strong>

            </strong></h5>
        <div class="card-body">

            <table class="table"
                   style="width:100% !important;">
                <thead>
                <tr>
                    <th colspan="2">Key</th>
                </tr>

                </thead>
                <tbody>

                <?php
                while ($resdep = $dep->fetch_assoc()) {


                    ?>
                    <tr>
                        <td colspan="2"><?php echo $resdep['mnotify_key']; ?></td>
                    </tr>

                    <tr>
                        <td>
                            <button type="button"
                                    class="btn btn-sm btn-info edit_key"
                                    i_index="<?php echo $resdep['id']; ?>"
                                    title="Edit"><i
                                    class="icon-pencil" style="color:#fff !important;"></i>
                            </button>
                        </td>
                        <td>
                            <button type="button"
                                    data-type="confirm"
                                    class="btn btn-sm btn-danger js-sweetalert delete_key"
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
            aaSorting: [],
            dom: 'Bfrtip'
        });



        $(document).on('click', '.edit_key', function () {

            var id_index = $(this).attr('i_index');

            //alert(id_index);

            $.ajax({
                type: "POST",
                url: "ajax/forms/mnotify_form_edit.php",
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
                    $('#mnotify_form_div').html(text);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },
                complete: function () {
                    $.unblockUI();
                },

            });


        });




        $(document).on('click', '.delete_key', function () {
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
                            url: "ajax/queries/delete_key.php",
                            data: {
                                i_index: i_index
                            },
                            dataType: "html",

                            success: function (text) {

                                $.ajax({
                                    type: "POST",
                                    url: "ajax/tables/mnotify_table.php",
                                    beforeSend: function () {
                                        $.blockUI({
                                            message: '<img src="assets/img/load.gif"/>'
                                        });
                                    },
                                    success: function (text) {
                                        $('#mnotify_table_div').html(text);
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

                        swal("Deleted!", "Key has been deleted.", "success");

                    } else {
                        swal("Cancelled", "Data is safe.", "error");
                    }
                });


        });

    </script>


<?php
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>