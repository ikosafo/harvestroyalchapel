<?php require ('includes/header.php')?>

    <!--START PAGE CONTENT -->
    <section class="page-content container-fluid">

        <div class="mr-auto">
            <ul class="actions top-right">
                <li>
                    <a href="javascript:void(0)" class="btn btn-primary btn-floating">
                        MANAGE BRANCHES
                    </a>
                </li>
            </ul>
        </div>

        <hr/>

        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div id="branch_form_div"></div>
            </div>
            <div class="col-md-8 col-sm-12">
                <div id="branch_table_div"></div>
            </div>
        </div>

    </section>

<?php require ('includes/footer.php')?>


<script>


    $.ajax({
        url: "ajax/forms/branch_form.php",
        beforeSend: function () {
            $.blockUI({
                message: '<img src="assets/img/load.gif" />'
            });
        },

        success: function (text) {
            $('#branch_form_div').html(text);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " " + thrownError);
        },
        complete: function () {
            $.unblockUI();
        },

    });


    $.ajax({
        url: "ajax/tables/branch_table.php",
        beforeSend: function () {
            $.blockUI({
                message: '<img src="assets/img/load.gif" />'
            });
        },

        success: function (text) {
            $('#branch_table_div').html(text);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " " + thrownError);
        },
        complete: function () {
            $.unblockUI();
        },

    });


</script>
