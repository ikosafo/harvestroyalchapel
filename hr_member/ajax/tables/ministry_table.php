<?php include ('../../../config.php');

$branch = $_SESSION['branch'];

$dep = $mysqli->query("select * from ministry where branch = '$branch' ORDER by ministry_name");


?>

<div class="card">

    <h5 class="card-header">Ministries <strong>

        </strong></h5>
    <div class="card-body">

        <table id="bs4-table" class="table"
               style="width:100% !important;">
            <thead>
            <tr>
                <th>Ministry Name</th>

            </tr>
            </thead>
            <tbody>

            <?php
            while ($resdep = $dep->fetch_assoc()) {


                ?>
                <tr>
                    <td><?php echo $resdep['ministry_name']; ?></td>

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
</script>

