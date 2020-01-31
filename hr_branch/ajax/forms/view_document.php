<?php include('../../../config.php');

$file_id = $_POST['file_id'];
?>


<p>
    <?php
    $doc = $mysqli->query("select * from document_files
                                           where document_id = '$file_id'");

    while ($fetch_doc = $doc->fetch_assoc()) {

        $document_location = $fetch_doc['document_location'];
        $newstring = substr($document_location, -3);

        if ($newstring == "jpg" || $newstring == "JPG" || $newstring == "Jpg") { ?>

            <img
                src="../<?php echo $document_location; ?>"
                style="width: 100%"/>

        <?php }


        else  { ?>

            <iframe src="../<?php echo $document_location; ?>"></iframe>

    <?php    }

        ?>


    <?php } ?>


</p>


