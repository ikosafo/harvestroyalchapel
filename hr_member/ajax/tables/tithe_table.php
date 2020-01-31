<?php include("../../../config.php");

$memberid = $_SESSION['memberid'];

$dep = $mysqli->query("select * from f_tithe where memberid = '$memberid' 
ORDER BY `year_month` DESC,`week` DESC, period DESC");


?>

<div class="card">

    <h5 class="card-header">Tithe Records<strong>

        </strong></h5>
    <div class="card-body">

        <table id="bs4-table" class="table"
               style="width:100% !important;">
            <thead>
            <tr>
                <th>No.</th>
                <th>Tithe Paid For</th>
                <th>Date Paid</th>
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
                        <?php echo $resdep['year_month']; ?> <br/>
                        <?php echo $resdep['week']; ?>
                    </td>
                    <td>
                        <?php echo $resdep['date_paid'] ?>
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
        "aaSorting": []
    });

</script>









