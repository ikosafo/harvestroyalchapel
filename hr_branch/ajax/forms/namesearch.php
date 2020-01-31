<?php

include('../../../config.php');

$branch = $_SESSION['branch'];

// Get search term
$searchTerm = $_GET['term'];

// Get matched data from provisional table
$query = $mysqli->query("SELECT * FROM member m JOIN member_images i ON m.`memberid` = i.`memberid` 
WHERE m.branch = '$branch' AND (m.surname LIKE '%" . $searchTerm . "%'
OR m.firstname LIKE '%" . $searchTerm . "%' 
OR m.othername LIKE '%" . $searchTerm . "%')");

// Generate name data array
$nameData = array();
if ($query->num_rows > 0) {
    while ($row = $query->fetch_assoc()) {

        $name = $row['firstname'] . ' ' . $row['othername'] . ' ' . $row['surname'];
        $data['id'] = $row['memberid'];
        $data['value'] = $name;
        $data['label'] = '
<a href="javascript:void(0);">
<img src="../' . $row['image_location'] . '" width="50" height="50"/>
<span>' . $name . '</span>
</a>';
        array_push($nameData, $data);


    }
}

// Return results as json encoded array
echo json_encode($nameData);

?>