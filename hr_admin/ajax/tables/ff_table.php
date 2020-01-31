<?php include('../../../config.php');


$dep = $mysqli->query("SELECT * FROM f_firstfruit  
ORDER BY `year` DESC, period DESC");


?>

<div class="card">

    <h5 class="card-header">First Fruit Records</h5>
    <div class="card-body">

        <table id="bs4-table" class="table">
            <thead>
            <tr>
                <th>No.</th>
                <th>Branch</th>
                <th>First Fruit Paid For</th>
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
                        <?php echo $resdep['year']; ?> <br/>
                    </td>
                    <td>
                        <?php
                        $memberid = $resdep['memberid'];
                        $getmem = $mysqli->query("select * from member where memberid = '$memberid'");
                        $resmem = $getmem->fetch_assoc();

                        echo $resmem['firstname'] . ' ' . $resmem['othername'] . ' ' . $resmem['surname'];

                        ?>

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
        "scrollY": "500px",
        "scrollCollapse": true,
        "paging": false
    });



</script>


