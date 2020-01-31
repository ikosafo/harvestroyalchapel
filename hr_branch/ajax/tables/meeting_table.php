<?php include ('../../../config.php');

$branch = $_SESSION['branch'];

$getmem = $mysqli->query("select * from meeting where branch = '$branch'");


?>

    <div class="card">

        <h5 class="card-header">Church Meetings<strong>

            </strong></h5>
        <div class="card-body">

            <table id="bs4-table" class="table table-responsive"
                   style="width:100% !important;">
                <thead>
                <tr>

                    <th>Meeting Name</th>
                    <th>Period Started</th>
                    <th>Period Ended</th>
                    <th>Men</th>
                    <th>Women</th>
                    <th>Guys</th>
                    <th>Ladies</th>
                    <th>Children</th>
                    <th>Total Members</th>
                    <th>Offering</th>
                    <th>Delete</th>

                </tr>
                </thead>
                <tbody>

                <?php
                while ($resmem = $getmem->fetch_assoc()) {


                    ?>
                    <tr>

                        <td>
                            <?php echo $resmem['meetingname']; ?>
                        </td>
                        <td>
                            <?php echo $resmem['periodstarted'] ?>
                        </td>
                        <td>
                            <?php echo $resmem['periodclosed'] ?>
                        </td>
                        <td>
                            <?php echo $resmem['men'] ?>
                        </td>
                        <td>
                            <?php echo $resmem['women'] ?>
                        </td>
                        <td>
                            <?php echo $resmem['guys'] ?>
                        </td>
                        <td>
                            <?php echo $resmem['ladies'] ?>
                        </td>
                        <td>
                            <?php echo $resmem['children'] ?>
                        </td>
                        <td>
                            <?php echo $resmem['total'] ?>
                        </td>
                        <td>
                            <?php echo $resmem['offering'] ?>
                        </td>
                        <td>
                            <button type="button"
                                    data-type="confirm"
                                    class="btn btn-sm btn-danger js-sweetalert delete_meeting"
                                    i_index="<?php echo $resmem['id']; ?>"
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


        $(document).on('click', '.delete_meeting', function () {
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
                            url: "ajax/queries/delete_meeting.php",
                            data: {
                                i_index: i_index
                            },
                            dataType: "html",

                            success: function (text) {

                                $.ajax({
                                    type: "POST",
                                    url: "ajax/tables/meeting_table.php",
                                    beforeSend: function () {
                                        $.blockUI({
                                            message: '<img src="assets/img/load.gif"/>'
                                        });
                                    },
                                    success: function (text) {
                                        $('#meeting_table_div').html(text);
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

                        swal("Deleted!", "Meeting details has been deleted.", "success");

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