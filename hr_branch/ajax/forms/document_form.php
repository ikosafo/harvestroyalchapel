<?php

include('../../../config.php');

$documentid = date("ymdhis").rand(1,10000);

?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">Documents</h5>
            <div class="card-body">

                <form>
                    <div class="form-group">
                        <label for="document_title">Document Title</label>
                        <input type="text" class="form-control" id="document_title"
                               placeholder="Enter Document Title">
                    </div>

                    <div class="form-group">
                        <label for="document_description">Description</label>
                        <textarea class="form-control" id="document_description"
                                  placeholder="Enter Description"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="document_upload">File(s)</label>
                        <input type="file" class="form-control" id="document_upload">
                        <input type="hidden" id="selected"/>
                    </div>

                    <div class="form-group">
                        <button style="margin-top: 20px" type="button" class="btn btn-primary"
                                id="savedocument"><i class="zmdi zmdi-plus-circle-o zmdi-hc-fw" style="color: #fff"></i> Save
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<script>

    $('#document_upload').uploadifive({
        'auto': false,
        'method': 'post',
        'buttonText': 'Upload document',
        'multi': true,
        'width': 180,
        'formData': {'randno': '<?php echo $documentid ?>'},
        'dnd': false,
        'uploadScript': 'ajax/queries/upload_document.php',
        'onUploadComplete': function (file, data) {
            console.log(data);
        },
        'onSelect': function (file) {
            // Update selected so we know they have selected a file
            $("#selected").val('yes');

        },
        'onCancel': function (file) {
            // Update selected so we know they have no file selected
            $("#selected").val('');
        }
    });



    $("#savedocument").click(function () {

        var document_title = $("#document_title").val();
        var document_description = $("#document_description").val();
        var document_id = '<?php echo $documentid; ?>';

        //alert(document_name);

        var error = '';


        if (document_title == "") {
            error += 'Please enter document title \n';
            $('#document_title').focus();
        }


        if (error == "") {


            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_document.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="assets/img/load.gif"/>'
                    });
                },
                data: {

                    document_title: document_title,
                    document_description: document_description,
                    document_id: document_id
                },
                success: function (text) {

                    //alert(text);

                    var selected = $("#selected").val();

                    if (selected == 'yes') {

                        $('#document_upload').uploadifive('upload');


                        $.notify("Profile Saved", "success", {position: "top center"});

                        $.ajax({
                            url: "ajax/forms/document_form.php",
                            success: function (text) {
                                $('#document_form_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },

                        });


                        $.ajax({
                            url: "ajax/tables/document_table.php",
                            success: function (text) {
                                $('#document_table_div').html(text);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },

                        });


                        /* setTimeout(function () {
                             window.location.href = 'provisional_registration.php'; // the redirect goes here

                         }, 2500);*/


                    } else {

                        $.notify("Please select a file to upload", {position: "top center"});

                    }



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