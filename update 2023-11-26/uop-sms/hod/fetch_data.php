<?php
// fetch_data.php

// Include your database connection logic
include "../db/connection.php";

// Check if the 'field' parameter is set
if (isset($_GET['field'])) {
    $field = $_GET['field'];

    // Fetch data based on the field
    switch ($field) {
        case 'type_name':
            $sql = "SELECT id, type_name FROM staff_type";
            break;
        case 'title':
            $sql="SELECT id,title_name FROM title_details";
            break;
        case 'designation':
            $sql="SELECT id,designation_name FROM designation";
            break;
        case 'faculty':
            $sql="SELECT id,faculty_name FROM faculty";
            break;
        case 'department':
            $sql="SELECT id,department_name FROM department";
            break;            
        default:
            $sql = "";
            break;
    }

    if (!empty($sql)) {
        $result = mysqli_query($con, $sql);

        if ($result) {
            $data = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }

            // Return data in JSON format
            echo json_encode($data);
        } else {
            echo "Error executing query: " . mysqli_error($con);
        }
    } else {
        echo "Invalid field parameter.";
    }
} else {
    echo "Field parameter not received.";
}

// Close the database connection
mysqli_close($con);
?>
