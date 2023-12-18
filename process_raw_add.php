<?php
session_start();

    // Include the database connection details
    include 'config.php';

// Process the form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_code = $_POST["product_code"];
    $product_name = $_POST["product_name"];
    $department = isset($_POST["department"]) ? $_POST["department"] : null;
    $date = $_POST["date"];
    $time = $_POST["time"];
    $size = $_POST["size"];
    $units = $_POST["units"];
    $quantity = $_POST["quantity"];
    $storeman = $_POST["storeman"];
    $remarks = $_POST["remarks"];
    $given_by = $_POST["given_by"];
    $sql = "INSERT INTO raw_add (product_code, product_name, department, date, time, size, units, quantity, storeman, remarks, given_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    // Check for a prepare error
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    
    // Bind parameters and execute
    $stmt->bind_param("sssssisisss", $product_code, $product_name, $department,$date, $time, $size, $units, $quantity, $storeman, $remarks, $given_by);
    
    if ($stmt->execute()) {
        $_SESSION['status'] = "Product Added Successfully!!!";
        header("Location: raw_list.php");

    } else {
        echo "Error: " . $stmt->error;
    }
    
    // Close the prepared statement and the database connection
    $stmt->close();
    $conn->close();
    
}

?>
