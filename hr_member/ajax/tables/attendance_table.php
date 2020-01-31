<?php include("../../../config.php");

$memberid = $_SESSION['memberid'];

$att = $mysqli->query("select * from attendance where memberid = '$memberid' ORDER BY `datereported` DESC");


?>

<div class="card">

    <h5 class="card-header">Member Attendance<strong>

        </strong></h5>
    <div class="card-body">

        <table id="bs4-table" class="table"
               style="width:100% !important;">
            <thead>
            <tr>

                <th>Name of Service</th>
                <th>Period of Service</th>

            </tr>
            </thead>
            <tbody>

            <?php
            while ($resatt = $att->fetch_assoc()) {


                ?>
                <tr>

                    <td>
                        <?php $serviceid = $resatt['service'];
                        $getser = $mysqli->query("select * from service where id = '$serviceid'");
                        $resser = $getser->fetch_assoc();
                        echo $resser['service_name'];
                        ?>
                    </td>
                    <td>
                        <?php echo $resatt['datereported']; ?>
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
        "aaSorting": []
    });

</script>









