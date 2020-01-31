<?php require ('includes/header.php')?>


    <!--START PAGE CONTENT -->
    <section class="page-content container-fluid">

        <div class="mr-auto">
            <ul class="actions top-right">
                <li>
                    <a href="javascript:void(0)" class="btn btn-primary btn-floating">
                        MANAGE DEPARTMENTS
                    </a>
                </li>
            </ul>
        </div>

        <hr/>


        <div class="row">
            <div class="col-md-5 col-sm-12 col-lg-5">
                    <div id="department_form_div"></div>
            </div>
            <div class="col-md-7 col-sm-12 col-lg-7">
                    <div id="department_table_div"></div>
            </div>
        </div>

    </section>

<?php require ('includes/footer.php')?>


<script>

    $.ajax({
        type: "POST",
        url: "ajax/forms/department_form.php",
        beforeSend: function () {
            $.blockUI({
                message: '<img src="assets/img/load.gif"/>'
            });
        },
        success: function (text) {
            $('#department_form_div').html(text);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " " + thrownError);
        },
        complete: function () {
            $.unblockUI();
        },

    });




    $.ajax({
        type: "POST",
        url: "ajax/tables/department_table.php",
        beforeSend: function () {
            $.blockUI({
                message: '<img src="assets/img/load.gif"/>'
            });
        },
        success: function (text) {
            $('#department_table_div').html(text);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " " + thrownError);
        },
        complete: function () {
            $.unblockUI();
        },

    });

</script>
