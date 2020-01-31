<?php

include('../../../config.php');

$branch = $_SESSION['branch'];

// Get search term
$searchTerm = $_GET['term'];

// Get matched data from provisional table
$query = $mysqli->query("SELECT * FROM f_partners  
WHERE branch = '$branch' AND full_name LIKE '%" . $searchTerm . "%'");

// Generate name data array
$nameData = array();
if ($query->num_rows > 0) {
    while ($row = $query->fetch_assoc()) {

        $name = $row['full_name'];
        $data['id'] = $row['id'];
        $data['value'] = $name;

        array_push($nameData, $data);


    }
}

// Return results as json encoded array
echo json_encode($nameData);

?>