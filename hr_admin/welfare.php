<?php require ('includes/header.php');?>

<!--START PAGE CONTENT -->
<section class="page-content container-fluid">

    <div class="mr-auto">
        <ul class="actions top-right">
            <li>
                <a href="javascript:void(0)" class="btn btn-primary btn-floating">
                     MANAGE WELFARE
                </a>
            </li>
        </ul>
    </div>

    <hr/>

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div id="welfare_table_div"></div>
        </div>
    </div>

</section>

<?php require ('includes/footer.php')?>



<script>


    $.ajax({
        url: "ajax/tables/welfare_table.php",
        beforeSend: function () {
            $.blockUI({
                message: '<img src="assets/img/load.gif" />'
            });
        },

        success: function (text) {
            $('#welfare_table_div').html(text);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " " + thrownError);
        },
        complete: function () {
            $.unblockUI();
        },

    });


</script>
