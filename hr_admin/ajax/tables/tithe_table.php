<?php include ('../../../config.php');

//$branch = $_SESSION['branch'];

$dep = $mysqli->query("SELECT * FROM f_tithe  
ORDER BY `year_month` DESC,`week` DESC, period DESC");


?>

    <div class="card">

        <h5 class="card-header">Tithe Records <strong>

            </strong></h5>
        <div class="card-body">

            <table id="bs4-table" class="table"
                   style="width:100% !important;">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Branch</th>
                    <th>Tithe Paid For</th>
                    <th>Member Name</th>
                    <th>Amount</th>


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
                            <?php
                            $branchid = $resdep['branch'];
                            $getb = $mysqli->query("select * from branch where id = '$branchid'");
                            $resb = $getb->fetch_assoc();
                            echo $resb['name'];

                            ?>
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