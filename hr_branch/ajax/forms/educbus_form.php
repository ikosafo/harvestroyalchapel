<?php include("../../../config.php");
$memberid = $_POST['member_id'];
?>

<div id="success_loc"></div>
<div id="error_loc"></div>
<h5 class="card-header">Field with * are required</h5>
<form name="educbus_form" method="post" autocomplete="off">
    <div class="card-body">

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="educlevel">Educational Level *</label>
                    <select id="educlevel" style="width: 100%">
                        <option value="">Select</option>
                        <option value="Tertiary">Tertiary</option>
                        <option value="A' Levels">'A' Levels</option>
                        <option value="'O' Levels">'O' Levels</option>
                        <option value="Certificate">Certificate</option>
                        <option value="Secondary">Secondary</option>
                        <option value="Primary">Primary</option>
                        <option value="None">None</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="institution_attended">Last Institution Attended</label>
                    <input type="text" class="form-control" id="institution_attended"
                           placeholder="Enter institution">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Qualification</label>
                    <input type="text" class="form-control" id="qualification"
                           placeholder="Enter qualification">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Occupation</label>
                    <input type="text" class="form-control" id="occupation"
                           placeholder="Enter Occupation">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Place of Work/Company</label>
                    <input type="text" class="form-control" id="workplace"
                           placeholder="Enter Place of Work">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Job Position</label>
                    <input type="text" class="form-control" id="job_position"
                           placeholder="Enter Job Position">
                </div>
            </div>
        </div>
    </div>

</form>



<div class="bg-light">
    <button type="button" style="float: right" class="btn btn-primary" id="save_educbus">Save and Continue
    </button>

</div>


<script>

    $("#educlevel").selectize();

    //Move to Personal Information
    $("#previous_personal").click(function () {
        $("#member_form a[href='#personal']").tab('show');
        $('#personal-id').removeClass('personal-class');
        $('#personal-id').addClass('personal-change');
    });


    $("#save_educbus").click(function () {
        var member_id = '<?php echo $memberid; ?>';
        var educlevel = $("#educlevel").val();
        var institution_attended = $("#institution_attended").val();
        var qualification = $("#qualification").val();
        var occupation = $("#occupation").val();
        var workplace = $("#workplace").val();
        var job_position = $("#job_position").val();
        //alert(member_id);
        var error = '';

        if (educlevel == "") {
            error += 'Please select educational level \n';
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/save_educbus.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/img/load.gif" />'
                    });
                },
                data: {
                    member_id: member_id,
                    educlevel: educlevel,
                    institution_attended: institution_attended,
                    qualification: qualification,
                    occupation: occupation,
                    workplace: workplace,
                    job_position: job_position
                },
                success: function (text) {
                    //alert(text);
                    $.notify("Education and Business Saved", "success", {position: "top center"});
                    $("#member_form a[href='#family']").tab('show');
                    $('#family-id').removeClass('family-class');
                    $('#family-id').addClass('family-change');

                    $.ajax({
                        type: "POST",
                        url: "ajax/forms/family_form.php",
                        data:{member_id:member_id},
                        success: function (text) {
                            $('#family_form_div').html(text);
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
