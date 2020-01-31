<?php include ('../../../config.php');
$branch = $_SESSION['branch'];
$dep = $mysqli->query("SELECT * FROM f_tithe WHERE branch = '$branch' 
ORDER BY `year_month` DESC,`week` DESC, period DESC");


?>
    <div class="card">
        <h5 class="card-header">Tithe Records </h5>
        <div class="card-body">

            <table id="bs4-table" class="table table-responsive"
                   style="width:100% !important;">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Tithe Paid For</th>
                    <th>Member Name</th>
                    <th>Amount</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>

                <?php
                $counter = 1;
                while ($resdep = $dep->fetch_assoc()) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $counter; ?>
                        </td>
                        <td>
                            <?php echo $resdep['year_month']; ?> <br/>
                            <?php echo $resdep['week']; ?>
                        </td>
                        <td>
                            <?php
                            $memberid = $resdep['memberid'];
                            $getmem = $mysqli->query("select * from member where memberid = '$memberid'");
                            $resmem = $getmem->fetch_assoc();

                            echo $resmem['firstname'].' '.$resmem['othername'].' '.$resmem['surname'];

                            ?>

                        </td>
                        <td>
                            <b><?php echo $resdep['amount']; ?></b> <br/>
                            (<?php echo $resdep['payment_mode']; ?>)
                        </td>
                        <td>
                            <button type="button"
                                    data-type="confirm"
                                    class="btn btn-sm btn-danger js-sweetalert delete_tithe"
                                    i_index="<?php echo $resdep['id']; ?>"
                                    title="Delete">
                                <i class="icon-trash" style="color:#fff !important;"></i>
                            </button>
                        </td>
                    </tr>

                    <?php $counter++;
                }
                ?>
                </tbody>
                <tfoot>
            </table>
        </div>

    </div>

    <script>
        $('#bs4-table').DataTable({
            "scrollY": "500px",
            "scrollCollapse": true,
            "paging": false
        });

        

        $(document).on('click', '.delete_tithe', function () {
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
                            url: "ajax/queries/delete_tithe.php",
                            data: {
                                i_index: i_index
                            },
                            dataType: "html",

                            success: function (text) {

                                $.ajax({
                                    type: "POST",
                                    url: "ajax/tables/tithe_table.php",
                                    beforeSend: function () {
                                        $.blockUI({
                                            message: '<img src="assets/img/load.gif"/>'
                                        });
                                    },
                                    success: function (text) {
                                        $('#tithe_table_div').html(text);
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

                        swal("Deleted!", "Tithe has been deleted.", "success");

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