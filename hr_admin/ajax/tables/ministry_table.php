<?php include ('../../../config.php');
//$branch = $_SESSION['branch'];
$dep = $mysqli->query("select * from ministry ORDER by ministry_name");
?>

    <div class="card">
        <h5 class="card-header">Ministries </h5>
        <div class="card-body">
            <table id="bs4-table" class="table"
                   style="width:100% !important;">
                <thead>
                <tr>
                    <th>Ministry Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php
                while ($resdep = $dep->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $resdep['ministry_name']; ?></td>
                        <td>
                            <button type="button"
                                    class="btn btn-sm btn-info edit_ministry"
                                    i_index="<?php echo $resdep['id']; ?>"
                                    title="Edit"><i
                                    class="icon-pencil" style="color:#fff !important;"></i>
                            </button>
                        </td>
                        <td>
                            <button type="button"
                                    data-type="confirm"
                                    class="btn btn-sm btn-danger js-sweetalert delete_ministry"
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


        $(document).on('click', '.edit_ministry', function () {
            var id_index = $(this).attr('i_index');
            //alert(id_index);
            $.ajax({
                type: "POST",
                url: "ajax/forms/ministry_form_edit.php",
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
                    $('#ministry_form_div').html(text);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },
                complete: function () {
                    $.unblockUI();
                },
            });
        });


        $(document).off('click', '.delete_ministry').on('click', '.delete_ministry', function () {
            var i_index = $(this).attr('i_index');
            $.confirm({
                title: 'Delete Ministry!',
                content: 'Are you sure to continue?',
                buttons: {
                    no: {
                        text: 'No',
                        keys: ['enter', 'shift'],
                        backdrop: 'static',
                        keyboard: false,
                        action: function () {
                            $.alert('Data is safe');
                        }
                    },
                    yes: {
                        text: 'Yes, Delete it!',
                        btnClass: 'btn-blue',
                        action: function () {
                            $.ajax({
                                type: "POST",
                                url: "ajax/queries/delete_ministry.php",
                                data: {
                                    i_index: i_index
                                },
                                dataType: "html",
                                success: function (text) {
                                    $.ajax({
                                        type: "POST",
                                        url: "ajax/tables/ministry_table.php",
                                        beforeSend: function () {
                                            $.blockUI({
                                                message: '<img src="assets/img/load.gif"/>'
                                            });
                                        },
                                        success: function (text) {
                                            $('#ministry_table_div').html(text);
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
                        }
                    }
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