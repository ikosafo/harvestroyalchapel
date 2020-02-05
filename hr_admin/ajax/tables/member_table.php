<?php include('../../../config.php');

//$branch = $_SESSION['branch'];

$getmember = $mysqli->query("select * from `member` where status IS NULL ORDER by branch,surname,firstname,othername");

?>
<style>
    .dataTables_filter { display: none; }
</style>



    <div class="card">
        <h5 class="card-header">Members </h5>
        <div class="row">
            <div class="mt-4 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3">
                <form>
                    <div class="search-wrapper page-search">
                        <button class="search-button-submit"
                                type="submit"><i class="icon dripicons-search"></i></button>
                        <input type="text" class="search-input" id="mem_search"
                               placeholder="Search...">
                    </div>
                </form>
            </div>

        </div>
        <div class="card-body">

            <table id="bs4-table" class="table"
                   style="width:100% !important;">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Full Name</th>
                    <th>Image</th>
                    <th>Branch</th>
                    <th>Telephone</th>
                    <th>Gender</th>
                    <th>Residence</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php
                $counter = 1;
                while ($resmember = $getmember->fetch_assoc()) {

                    $memberid = $resmember['memberid'];
                    $lmem = lock($memberid);
                    ?>
                    <tr>
                        <td>
                            <?php echo $counter; ?>
                        </td>
                        <td>
                            <?php echo $resmember['surname'].' '.$resmember['firstname'].' '.$resmember['othername']; ?>
                        </td>
                        <td><?php
                            $img = $mysqli->query("select * from member_images
                            where memberid = '$memberid'");

                            $fetch_img = $img->fetch_assoc() ?>

                            <img src="../<?php echo $fetch_img['image_location'] ?>"
                                 class="w-50 rounded-circle" alt="Member Image">
                        </td>

                        <td>
                            <?php
                            $branchid = $resmember['branch'];
                                $getb = $mysqli->query("select * from branch where id = '$branchid'");
                                $resb = $getb->fetch_assoc();
                                echo $resb['name'];

                            ?>
                        </td>
                        <td>
                            <?php echo $resmember['telephone'] ?>
                        </td>
                        <td>
                            <?php echo $resmember['gender'] ?>
                        </td>
                        <td>
                            <?php echo $resmember['residence'] ?>
                        </td>
                       <!-- <td>
                            <?php /*echo $resmember['maritalstatus'] */?>
                        </td>
                        <td>
                            <?php /*$di = $resmember['department'];
                            $getd = $mysqli->query("select * from department where id = '$di'");
                            $resd = $getd->fetch_assoc();
                            echo $resd['department_name'];
                            if ($di == "None") {
                                echo "None";
                            }
                            */?>
                        </td>-->
                        <td>
                            <button type="button"
                                    class="btn btn-sm btn-warning view_member"
                                    i_index="<?php echo $resmember['id']; ?>"
                                    title="View"><i
                                    class="icon-eye" style="color:#fff !important;"></i>
                            </button>

                            <button type="button"
                                    data-type="confirm"
                                    class="btn btn-sm btn-danger js-sweetalert delete_member"
                                    i_index="<?php echo $resmember['id']; ?>"
                                    title="Delete">
                                <i class="icon-trash" style="color:#fff !important;"></i>
                            </button>
                        </td>
                    </tr>

                    <?php
                    $counter++;
                }
                ?>
                </tbody>
                <tfoot>

            </table>


        </div>


    </div>

    <script>

        oTable = $('#bs4-table').DataTable({
            "bLengthChange": false
        });
        $('#mem_search').keyup(function(){
            oTable.search($(this).val()).draw() ;
        });


        $(document).on('click', '.view_member', function () {
            var id_index = $(this).attr('i_index');
            //alert(id_index);
            $.ajax({
                type: "POST",
                url: "ajax/forms/member_details.php",
                data:
                    {
                        id_index: id_index
                    },
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/img/load.gif"/>'
                    });
                },
                success: function (text) {
                    $('#member_table_div').html(text);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },
                complete: function () {
                    $.unblockUI();
                },
            });
        });


        $(document).on('click', '.edit_member', function () {
            var id_index = $(this).attr('i_index');
            //alert(id_index);
            $.ajax({
                type: "POST",
                url: "ajax/forms/member_form_edit.php",
                data:
                    {
                        id_index: id_index
                    },
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/img/load.gif"/>'
                    });
                },
                success: function (text) {
                    $('#member_table_div').html(text);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },
                complete: function () {
                    $.unblockUI();
                },
            });
        });


        $(document).off('click', '.delete_member').on('click', '.delete_member', function () {
            var theindex = $(this).attr('i_index');
            $.confirm({
                title: 'Delete Member!',
                content: 'Are you sure to continue?',
                buttons: {
                    no: {
                        text: 'No',
                        keys: ['enter', 'shift'],
                        backdrop: 'static',
                        keyboard: false,
                        action: function () {
                            $.alert('Data is safe');
                        }
                    },
                    yes: {
                        text: 'Yes, Delete it!',
                        btnClass: 'btn-blue',
                        action: function () {
                            $.ajax({
                                type: "POST",
                                url: "ajax/queries/delete_member.php",
                                data: {
                                    i_index: theindex
                                },
                                dataType: "html",

                                success: function (text) {

                                    $.ajax({
                                        type: "POST",
                                        url: "ajax/tables/member_table.php",
                                        beforeSend: function () {
                                            $.blockUI({
                                                message: '<img src="assets/img/load.gif"/>'
                                            });
                                        },
                                        success: function (text) {
                                            $('#member_table_div').html(text);
                                        },
                                        error: function (xhr, ajaxOptions, thrownError) {
                                            alert(xhr.status + " " + thrownError);
                                        },
                                        complete: function () {
                                            $.unblockUI();
                                        },

                                    });

                                },
                                complete: function () {
                                },
                                error: function (xhr, ajaxOptions, thrownError) {
                                    alert(xhr.status + " " + thrownError);
                                }
                            });
                        }
                    }
                }
            });
        });

    </script>

