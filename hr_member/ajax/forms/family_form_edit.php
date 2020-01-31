<?php include("../../../config.php");

$memberid = $_POST['member_id'];

$getf = $mysqli->query("select * from member where memberid = '$memberid'");
$resf = $getf->fetch_assoc();

?>

<style>

    .buttonwrapper {
        display:inline-block;
    }

</style>

<script>
    function SelectFather(val) {
        var element = document.getElementById('divfather');
        if (val == 'Yes')
            element.style.display = 'block';
        else
            element.style.display = 'none';
    }

    function SelectMother(val) {
        var element = document.getElementById('divmother');
        if (val == 'Yes')
            element.style.display = 'block';
        else
            element.style.display = 'none';
    }

    function SelectSpouse(val) {
        var element = document.getElementById('divspouse');
        if (val == 'Married')
            element.style.display = 'block';
        else
            element.style.display = 'none';
    }

    function SelectChildren(val) {
        var element = document.getElementById('divchildren');
        if (val == 'Yes')
            element.style.display = 'block';
        else
            element.style.display = 'none';
    }
</script>

<div id="success_loc"></div>
<div id="error_loc"></div>
<h5 class="card-header">Field with * are required</h5>
<form name="educbus_form" method="post" autocomplete="off">
    <div class="card-body">

        <div class="row">

            <?php /*echo $resf['maritalstatus']."err"; */?>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="marital_status">Marital Status *</label>

                    <select id="maritalstatus" style="width: 100%" onchange='SelectSpouse(this.value);'>

                        <option value="">Select</option>
                        <option <?php if(@$resf['maritalstatus'] == "Single") echo "Selected" ?>>Single</option>
                        <option <?php if(@$resf['maritalstatus'] == "Married") echo "Selected" ?>>Married</option>
                        <option <?php if(@$resf['maritalstatus'] == "Divorced") echo "Selected" ?>>Divorced</option>
                        <option <?php if(@$resf['maritalstatus'] == "Separated") echo "Selected" ?>>Separated</option>
                        <option <?php if(@$resf['maritalstatus'] == "Engaged") echo "Selected" ?>>Engaged</option>
                    </select>
                </div>

                <div class="form-group">
                    <div id="divspouse">
                        <label for="spouse">Name of Spouse</label>
                        <input type="text" class="form-control" id="spouse"
                               placeholder="Enter name of spouse" value="<?php echo $resf['spousename']; ?>">

                    </div>
                </div>


                <div class="form-group">
                    <label for="father_alive">Is your father alive? *</label>
                    <select id="father_alive" style="width: 100%" onchange='SelectFather(this.value);'>

                        <option value="">Select</option>
                        <option <?php if(@$resf['fatheralive'] == "Yes") echo "Selected" ?>>Yes</option>
                        <option <?php if(@$resf['fatheralive'] == "No") echo "Selected" ?>>No</option>
                    </select>
                </div>

                <div class="form-group">
                    <div id="divfather">
                        <label for="father">Name of Father</label>
                        <input type="text" class="form-control" id="father"
                               placeholder="Enter name of father" value="<?php echo $resf['fathername']; ?>">

                    </div>
                </div>


            </div>

            <div class="col-md-4">


                <div class="form-group">
                    <label for="mother_alive">Is your mother alive? *</label>
                    <select id="mother_alive" style="width: 100%" onchange='SelectMother(this.value);'>

                        <option value="">Select</option>
                        <option <?php if(@$resf['motheralive'] == "Yes") echo "Selected" ?>>Yes</option>
                        <option <?php if(@$resf['motheralive'] == "No") echo "Selected" ?>>No</option>
                    </select>
                </div>

                <div class="form-group">
                    <div id="divmother">
                        <label for="mother">Name of Mother</label>
                        <input type="text" class="form-control" id="mother"
                               placeholder="Enter name of mother" value="<?php echo $resf['mothername']; ?>">

                    </div>
                </div>


                <div class="form-group">
                    <label for="have_children">Do you have children? *</label>
                    <select id="have_children" style="width: 100%" onchange='SelectChildren(this.value);'>

                        <option value="">Select</option>
                        <option <?php if(@$resf['havechildren'] == "Yes") echo "Selected" ?>>Yes</option>
                        <option <?php if(@$resf['havechildren'] == "No") echo "Selected" ?>>No</option>
                    </select>
                </div>


            </div>


            <div class="col-md-4">
                <div class="form-group">
                    <div id="divchildren">
                        <label for="child_name">Name of Child</label>
                        <div class="input-group mb-3">
                            <input type="text" id="child_name" class="form-control"
                                   placeholder="Enter name of child">
                            <div class="input-group-append">
                                <button class="btn btn-primary" id="savechild" type="button">Add</button>
                            </div>
                        </div>


                        <div id="child_table_div">

                           <?php

                            $getchild = $mysqli->query("select * from children where memberid = '$memberid'");

                            ?>

                            <table class="table table-bordered"
                                   style="width:100% !important;">

                                <tbody>

                                <?php
                                while ($resch = $getchild->fetch_assoc()) {


                                    ?>
                                    <tr>
                                        <td><?php echo $resch['childname']; ?></td>

                                        <td>
                                            <button type="button"
                                                    data-type="confirm"
                                                    class="btn btn-sm btn-danger js-sweetalert delete_child"
                                                    i_index="<?php echo $resch['id']; ?>"
                                                    title="Delete">
                                                <i class="icon-trash" style="color:#fff !important;"></i>
                                            </button>

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
                </div>


            </div>

        </div>


    </div>


</form>


<div class="card-footer bg-light">
    <button type="button" id="previous_educbus" class="btn btn-secondary">Previous</button>
    <button type="button" style="float: right" class="btn btn-primary" id="save_family">Save and Continue
    </button>

</div>


<script>

    $("#maritalstatus").selectize();
    $("#father_alive").selectize();
    $("#mother_alive").selectize();
    $("#have_children").selectize();


    //Move to Education and Business
    $("#previous_educbus").click(function () {

        $("#member_form a[href='#educbus']").tab('show');
        $('#educbus-id').removeClass('educbus-class');
        $('#educbus-id').addClass('educbus-change');


    });



    $("#save_family").click(function () {

        var member_id = '<?php echo $memberid; ?>';
        var marital_status = $("#maritalstatus").val();
        var spouse = $("#spouse").val();
        var father_alive = $("#father_alive").val();
        var father = $("#father").val();
        var mother_alive = $("#mother_alive").val();
        var mother = $("#mother").val();
        var have_children = $("#have_children").val();

        //alert(member_id);

        var error = '';


        if (marital_status == "") {
            error += 'Please select marital status \n';
        }

        if (marital_status == "Married" && spouse == "") {
            error += 'Please enter name of spouse \n';
            $("#spouse").focus();
        }

        if (marital_status != "Married" && spouse != "") {
            error += "Spouse's name should be empty or choose 'Married' as status \n";
            $("#spouse").focus();
        }

        if (father_alive == "") {
            error += 'Please select status of father \n';
        }

        if (father_alive == "Yes" && father == "") {
            error += 'Please enter name of father \n';
            $("#father").focus();
        }

        if (father_alive != "Yes" && father != "") {
            error += "Father's name should be empty or choose 'Yes' \n";
            $("#father").focus();
        }

        if (mother_alive == "") {
            error += 'Please select status of mother \n';
        }

        if (mother_alive == "Yes" && mother == "") {
            error += 'Please enter name of mother \n';
            $("#mother").focus();
        }

        if (mother_alive != "Yes" && mother != "") {
            error += "Mother's name should be empty or choose 'Yes' \n";
            $("#mother").focus();
        }

        if (have_children == "") {
            error += 'Please select number of children \n';
            $("#divchildren").hide();
        }


        if (error == "") {


            $.ajax({
                type: "POST",
                url: "ajax/queries/save_family.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/img/load.gif" />'
                    });
                },
                data: {

                    member_id: member_id,
                    marital_status: marital_status,
                    spouse: spouse,
                    father_alive: father_alive,
                    father: father,
                    mother_alive: mother_alive,
                    mother: mother,
                    have_children: have_children

                },
                success: function (text) {

                    //alert(text);

                    $.notify("Family Details Saved", "success", {position: "top center"});

                    $("#member_form a[href='#ministry']").tab('show');
                    $('#ministry-id').removeClass('ministry-class');
                    $('#ministry-id').addClass('ministry-change');


                    $.ajax({
                        type: "POST",
                        url: "ajax/forms/memministry_form_edit.php",
                        data: {member_id: member_id},
                        success: function (text) {
                            $('#ministry_form_div').html(text);
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






    $("#savechild").click(function () {

        var member_id = '<?php echo $memberid; ?>';
        var child_name = $("#child_name").val();


        //alert(member_id);

        var error = '';


        if (child_name == "") {
            error += "Please enter child's name \n";
            $("#child_name").focus();
        }


        if (error == "") {


            $.ajax({
                type: "POST",
                url: "ajax/queries/save_child.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/img/load.gif" />'
                    });
                },
                data: {

                    member_id: member_id,
                    child_name: child_name

                },
                success: function (text) {

                    //alert(text);

                    $.notify("Child Saved", "success", {position: "top center"});
                    $("#child_name").val(" ")


                    $.ajax({
                        type: "POST",
                        url: "ajax/tables/child_table.php",
                        data: {
                            member_id: member_id
                        },
                        success: function (text) {
                            $('#child_table_div').html(text);
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




    $(document).on('click', '.delete_child', function () {
        var i_index = $(this).attr('i_index');
        var member_id = '<?php echo $memberid ?>';

        //alert(i_index);

        swal({
                title: "Do you want to delete this child?",
                text: "You will not be able to recover this data!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        type: "POST",
                        url: "ajax/queries/delete_child.php",
                        data: {
                            i_index: i_index
                        },
                        dataType: "html",

                        success: function (text) {

                            $.ajax({
                                type: "POST",
                                url: "ajax/tables/child_table.php",
                                data: {member_id:member_id},
                                beforeSend: function () {
                                    $.blockUI({
                                        message: '<img src="assets/img/load.gif"/>'
                                    });
                                },
                                success: function (text) {
                                    $('#child_table_div').html(text);
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

                    swal("Deleted!", "Child has been deleted.", "success");

                } else {
                    swal("Cancelled", "Data is safe.", "error");
                }
            });


    });


</script>
