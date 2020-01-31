<?php include("../../../config.php");

//$branch = $_SESSION['branch'];

$memberid = $_POST['member_id'];
$getm = $mysqli->query("select * from member where memberid = '$memberid'");
$resm = $getm->fetch_assoc();


?>

<div id="success_loc"></div>
<div id="error_loc"></div>
<h5 class="card-header">Field with * are required</h5>
<form name="mmemministry_form" method="post" autocomplete="off">
    <div class="card-body">

        <div class="row">

            <div class="col-md-4">
                <div class="form-group">
                    <label for="mem_department">Department *</label>

                    <select id="mem_department" style="width: 100%">

                        <option value="">Select</option>

                        <?php


                        $department = $resm['department'];



                        $query = $mysqli->query("select * from department ORDER BY department_name");

                            while ($result = $query->fetch_assoc()) { ?>

                            <option <?php if (@$department == @$result['id']) echo "Selected" ?>>
                            <?php echo $result['department_name'];?></option>

                        <?php } ?>
                        <option <?php if (@$department == 'None') echo "Selected" ?>>None</option>



                    </select>
                </div>


            </div>

            <div class="col-md-4">

                <div class="form-group">
                    <label for="mem_ministry">Ministry *</label>

                    <select id="mem_ministry" style="width: 100%">

                        <option value="">Select</option>

                        <?php


                        $ministry = $resm['ministry'];

                        $query = $mysqli->query("select * from ministry ORDER BY ministry_name");

                        while ($result = $query->fetch_assoc()) { ?>

                            <option <?php if (@$ministry == @$result['id']) echo "Selected" ?>>
                                <?php echo $result['ministry_name'];?></option>

                        <?php } ?>
                        <option <?php if (@$ministry == 'None') echo "Selected" ?>>None</option>



                    </select>
                </div>


            </div>

            <div class="col-md-4">


                <div class="form-group">
                    <label for="mem_cell">Cell *</label>

                    <select id="mem_cell" style="width: 100%">

                        <option value="">Select</option>


                        <?php


                        $cell = $resm['cell'];

                        $query = $mysqli->query("select * from cell ORDER BY cell_name");

                        while ($result = $query->fetch_assoc()) { ?>

                            <option <?php if (@$cell == @$result['id']) echo "Selected" ?>>
                                <?php echo $result['cell_name'];?></option>

                        <?php } ?>
                        <option <?php if (@$cell == 'None') echo "Selected" ?>>None</option>


                    </select>
                </div>



            </div>

        </div>



    </div>


</form>



<div class="card-footer bg-light mt-lg-5">
    <button type="button" id="previous_family" class="btn btn-secondary">Previous</button>
    <button type="button" style="float: right" class="btn btn-primary" id="save_memministry">Save and Continue
    </button>

</div>


<script>

    $("#mem_department").selectize();
    $("#mem_ministry").selectize();
    $("#mem_cell").selectize();

    //Move to Personal Information
    $("#previous_family").click(function () {

        $("#member_form a[href='#family']").tab('show');
        $('#family-id').removeClass('family-class');
        $('#family-id').addClass('family-change');


    });





    $("#save_memministry").click(function () {

        var member_id = '<?php echo $memberid; ?>';
        var mem_department = $("#mem_department").val();
        var mem_ministry = $("#mem_ministry").val();
        var mem_cell = $("#mem_cell").val();

        //alert(mem_department);

        var error = '';


        if (mem_department == "") {
            error += 'Please select department \n';
        }

        if (mem_ministry == "") {
            error += 'Please select ministry \n';
        }

        if (mem_cell == "") {
            error += 'Please select cell \n';
        }


        if (error == "") {


            $.ajax({
                type: "POST",
                url: "ajax/queries/save_memministry_edit.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/img/load.gif" />'
                    });
                },
                data: {

                    member_id: member_id,
                    mem_department: mem_department,
                    mem_ministry: mem_ministry,
                    mem_cell: mem_cell
                },
                success: function (text) {

                    //alert(text);

                    $.notify("Ministry Information Saved", "success", {position: "top center"});

                    $("#member_form a[href='#summary']").tab('show');
                    $('#summary-id').removeClass('summary-class');
                    $('#summary-id').addClass('summary-change');


                    $.ajax({
                        type: "POST",
                        url: "ajax/forms/summary_form.php",
                        data:{member_id:member_id},
                        success: function (text) {
                            $('#summary_form_div').html(text);
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + " " + thrownError);
                        },

                    });



                },

                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },
                complete: function () {
                    $.unblockUI();
                },

            });

        }


        else {

            $.notify(error, {position: "top center"});

        }

        return false;

    });

</script>
