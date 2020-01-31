<?php include("../../../config.php");

$memberid = $_SESSION['memberid'];

$dep = $mysqli->query("select * from f_contributions where memberid = '$memberid' 
ORDER BY period DESC,date_paid DESC");


?>

<div class="card">

    <h5 class="card-header">Contributions Records<strong>

        </strong></h5>
    <div class="card-body">

        <table id="bs4-table" class="table"
               style="width:100% !important;">
            <thead>
            <tr>
                <th>No.</th>
                <th>Contributions Paid For</th>
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
                        <?php echo $resdep['purpose']; ?>
                    </td>
                    <td>
                        <?php echo $resdep['date_paid']; ?>
                    </td>
                    <td>
                        <b><?php echo $resdep['amount']; ?></b>
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









