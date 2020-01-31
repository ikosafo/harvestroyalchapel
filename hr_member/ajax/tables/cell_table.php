<?php include ('../../../config.php');

$branch = $_SESSION['branch'];

$dep = $mysqli->query("select * from cell where branch = '$branch' ORDER by cell_name");


?>

<div class="card">

    <h5 class="card-header">Cells <strong>

        </strong></h5>
    <div class="card-body">

        <table id="bs4-table" class="table"
               style="width:100% !important;">
            <thead>
            <tr>
                <th>Cell Name</th>

            </tr>
            </thead>
            <tbody>

            <?php
            while ($resdep = $dep->fetch_assoc()) {


                ?>
                <tr>
                    <td><?php echo $resdep['cell_name']; ?></td>

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

