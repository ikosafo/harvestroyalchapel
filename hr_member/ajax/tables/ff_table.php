<?php include("../../../config.php");

$memberid = $_SESSION['memberid'];

$dep = $mysqli->query("select * from f_firstfruit where memberid = '$memberid' 
ORDER BY `year` DESC,period DESC");


?>

<div class="card">

    <h5 class="card-header">First Fruit Records<strong>

        </strong></h5>
    <div class="card-body">

        <table id="bs4-table" class="table"
               style="width:100% !important;">
            <thead>
            <tr>
                <th>No.</th>
                <th>First Fruit Paid For</th>
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
                        <?php echo $resdep['year']; ?>
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









