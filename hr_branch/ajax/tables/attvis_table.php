<?php
include ('../../../config.php');
$period = date("Y-m-d H:i:s");
?>

<script>
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>

    <div class="card">
        <div id="success_loc"></div>
        <div id="error_loc"></div>
        <h5 class="card-header">Visitors</h5>
        <form name="branch_form" method="post" autocomplete="off">
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Full Name of Visitor</label>
                    <input type="text" class="form-control" id="visitor_name" placeholder="Enter full name of visitor">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Telephone</label>
                    <input type="text" class="form-control" id="visitor_telephone"
                           placeholder="Enter telephone" onkeypress="return isNumber(event);">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Service Type</label>
                    <select id="visitor_service">
                        <?php
                        $getservice = $mysqli->query("select * from service where start_period <= '$period' 
                                                        AND end_period >= '$period'");
                        while ($ress = $getservice->fetch_assoc()) { ?>
                            <option value="<?php echo $ress['id'] ?>"><?php echo $ress['service_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="card-footer bg-light">
                <button type="button" class="btn btn-primary" id="save_visitor">Submit</button>
            </div>
        </form>
    </div>



<script>
    $("#visitor_service").selectize();

    $("#save_visitor").click(function () {

        var visitor_name = $("#visitor_name").val();
        var visitor_telephone = $("#visitor_telephone").val();
        var visitor_service = $("#visitor_service").val();
        var error = '';

        if (visitor_name == "") {
            error += 'Please enter name of visitor \n';
            $("#visitor_name").focus();
        }
        if (visitor_telephone == "") {
            error += 'Please enter telephone  \n';
            $("#visitor_telephone").focus();
        }
        if (visitor_service == "") {
            error += 'Please select service \n';
        }


        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/save_visitor_attendance.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/img/load.gif" />'
                    });
                },
                data: {
                    visitor_name: visitor_name,
                    visitor_telephone: visitor_telephone,
                    visitor_service: visitor_service
                },
                success: function (text) {
                    //alert(text);
                   location.reload();
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
            $('#error_loc').notify(error);
        }
        return false;
    });


</script>

