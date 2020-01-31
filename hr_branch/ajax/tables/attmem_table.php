<?php include('../../../config.php');

$branch = $_SESSION['branch'];

$getmember = $mysqli->query("select * from member where branch = '$branch' AND status IS NULL ORDER by surname,firstname,othername");

$period = date("Y-m-d H:i:s");

?>

    <div class="card">

        <h5 class="card-header">Members <strong>

            </strong></h5>
        <div class="card-body">

            <table id="bs4-table" class="table"
                   style="width:100% !important;">
                <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Details</th>
                    <th>Service</th>
                    <th>Action</th>


                </tr>
                </thead>
                <tbody>

                <?php
                while ($resmember = $getmember->fetch_assoc()) {

                    $memberid = $resmember['memberid'];
                    $lmem = lock($memberid);
                    ?>
                    <tr>
                        <td><?php
                            $img = $mysqli->query("select * from member_images
                            where memberid = '$memberid'");

                            $fetch_img = $img->fetch_assoc() ?>

                            <img src="../<?php echo $fetch_img['image_location'] ?>"
                                 class="w-50 rounded-circle" alt="Member Image"><br/>
                            <?php echo $resmember['surname'] . ' ' . $resmember['firstname'] . ' ' . $resmember['othername']; ?>
                        </td>
                        <td>
                            <i class="icon-check"></i> <?php echo $resmember['gender'] ?> <br/>
                            <i class="icon-check"></i> <?php echo $resmember['telephone'] ?> <br/>
                            <i class="icon-check"></i> <?php echo $resmember['residence'] ?> <br/>
                            <i class="icon-check"></i> <?php $di = $resmember['department'];
                            $getd = $mysqli->query("select * from department where id = '$di'");
                            $resd = $getd->fetch_assoc();
                            echo $resd['department_name'];
                            if ($di == "None") {
                                echo "None";
                            }
                            ?>
                        </td>
                        <td>

                            <select id="select_service">

                               <?php

                               $getservice = $mysqli->query("select * from service where start_period <= '$period' 
                                                        AND end_period >= '$period'");

                                while ($ress = $getservice->fetch_assoc()) { ?>

                                    <option value="<?php echo $ress['id'] ?>"><?php echo $ress['service_name']; ?></option>

                                <?php } ?>

                            </select>

                        </td>
                        <td>

                            <?php

                            $getser = $mysqli->query("select * from service where start_period <= '$period' 
                                                        AND end_period >= '$period'");

                            $gettime = $getser->fetch_assoc();
                            $start_period = $gettime['start_period'];
                            $end_period = $gettime['end_period'];

                            $getp = $mysqli->query("select * from attendance where memberid = '$memberid' 
                                          AND datereported >= '$start_period' 
                                          AND datereported <= '$end_period'");

                            if (mysqli_num_rows($getp) == "0") { ?>

                                <button type="button"
                                        class="btn btn-sm btn-danger mark_member_present"
                                        i_index="<?php echo $resmember['memberid']; ?>"
                                        title="Mark as Present"><i
                                            class="icon-close" style="color:#fff !important;"></i>
                                </button>

                            <?php } else { ?>

                                <button type="button"
                                        class="btn btn-sm btn-success mark_member_absent"
                                        i_index="<?php echo $resmember['memberid']; ?>"
                                        title="Mark as Absent"><i
                                            class="icon-check" style="color:#fff !important;"></i>
                                </button>

                            <?php } ?>

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
            "scrollY": "200px",
            "scrollCollapse": true,
            "paging": false
        });


        $(document).on('click', '.mark_member_present', function () {

            var id_index = $(this).attr('i_index');
            var select_service = $("#select_service").val();

            //alert(select_service+' '+id_index);

            var error = '';

            if (select_service == "") {
                error += 'Please select service \n';
            }

            if (select_service == null) {
                error += "There's no service available \n";
            }

            if (error == "") {


                var result = confirm("Do you want to mark as present?");

                if (result) {

                    $.ajax({
                        type: "POST",
                        url: "ajax/queries/mark_present.php",
                        beforeSend: function () {
                            $.blockUI({
                                message: '<img src="assets/img/load.gif"/>'
                            });
                        },
                        data: {

                            id_index: id_index,
                            select_service: select_service

                        },
                        success: function (text) {

                            //alert(text);

                            location.reload();


                        },

                        error: function (xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + " " + thrownError);
                        },
                        complete: function () {
                            $.unblockUI();
                        },

                    });

                }


            }


            else {

                $.notify(error, {position: "top center"});

            }

            return false;

        });








        $(document).on('click', '.mark_member_absent', function () {

            var id_index = $(this).attr('i_index');
            var select_service = $("#select_service").val();

            //alert(select_service+' '+id_index);

            var error = '';

            if (select_service == "") {
                error += 'Please select service \n';
            }

            if (select_service == null) {
                error += "There's no service available \n";
            }

            if (error == "") {


                var result = confirm("Do you want to mark as absent?");

                if (result) {

                    $.ajax({
                        type: "POST",
                        url: "ajax/queries/mark_absent.php",
                        beforeSend: function () {
                            $.blockUI({
                                message: '<img src="assets/img/load.gif"/>'
                            });
                        },
                        data: {

                            id_index: id_index,
                            select_service: select_service

                        },
                        success: function (text) {

                            //alert(text);

                            location.reload();
                        },

                        error: function (xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + " " + thrownError);
                        },
                        complete: function () {
                            $.unblockUI();
                        },

                    });

                }


            }


            else {

                $.notify(error, {position: "top center"});

            }

            return false;

        });


    </script>


<?php
function time_elapsed_string($datetime, $full = false)
{
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