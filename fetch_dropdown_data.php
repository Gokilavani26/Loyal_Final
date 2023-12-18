<?php
// fetch_dropdown_data.php
include 'config.php'; 

$sql = "SELECT DISTINCT group_name FROM employee";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row['group_name'];
    }
}

// Return the data as JSON
echo json_encode($data);

// Close the database connection
$conn->close();
?>
