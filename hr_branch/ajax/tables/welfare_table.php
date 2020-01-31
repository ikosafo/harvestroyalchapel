<?php include ('../../../config.php');

$branch = $_SESSION['branch'];

$dep = $mysqli->query("SELECT * FROM f_welfare WHERE branch = '$branch' 
ORDER BY `year_month` DESC,period DESC");


?>

    <div class="card">

        <h5 class="card-header">Welfare Records <strong>

            </strong></h5>
        <div class="card-body">

            <table id="bs4-table" class="table table-striped table-responsive table-bordered"
                   style="width:100% !important;">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Welfare Paid For</th>
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
                            <?php echo $resdep['year_month']; ?>

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
                            <b><?php echo $resdep['amount']; ?></b>
                        </td>
                        <td>
                            <button type="button"
                                    data-type="confirm"
                                    class="btn btn-sm btn-danger js-sweetalert delete_welfare"
                                    i_index="<?php echo $resdep['id']; ?>"
                                    title="Delete">
                                <i class="icon-trash" style="color:#fff !important;"></i>
                            </button>

                        </td>


                    </tr>

                    <?php $counter++; ?>

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
            "scrollY": "500px",
            "scrollCollapse": true,
            "paging": false
        });



        $(document).on('click', '.delete_welfare', function () {
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
                            url: "ajax/queries/delete_welfare.php",
                            data: {
                                i_index: i_index
                            },
                            dataType: "html",

                            success: function (text) {

                                $.ajax({
                                    type: "POST",
                                    url: "ajax/tables/welfare_table.php",
                                    beforeSend: function () {
                                        $.blockUI({
                                            message: '<img src="assets/img/load.gif"/>'
                                        });
                                    },
                                    success: function (text) {
                                        $('#welfare_table_div').html(text);
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

                        swal("Deleted!", "welfare has been deleted.", "success");

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