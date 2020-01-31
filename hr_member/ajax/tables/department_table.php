<?php include ('../../../config.php');

$branch = $_SESSION['branch'];

$dep = $mysqli->query("select * from department where branch = '$branch' ORDER by department_name");


?>

    <div class="card">

        <h5 class="card-header">Departments <strong>

            </strong></h5>
        <div class="card-body">

            <table id="bs4-table" class="table"
                   style="width:100% !important;">
                <thead>
                <tr>
                    <th>Department Name</th>

                </tr>
                </thead>
                <tbody>

                <?php
                while ($resdep = $dep->fetch_assoc()) {


                    ?>
                    <tr>
                        <td><?php echo $resdep['department_name']; ?></td>

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

