<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['is_admin'])) {
    // Redirect to login or show an error message
    header("Location: login.html");
    exit();
}

// Check if the user is an admin
$isAdmin = $_SESSION['is_admin'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $product_code = $_POST["product_code"];
    $product_name = $_POST["product_name"];
    $department = $_POST["department"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $size = $_POST["size"];
    $units = $_POST["units"];
    $quantity = $_POST["quantity"];
    $storeman = $_POST["storeman"];
    $remarks = $_POST["remarks"];
    $given_by = $_POST["given_by"];

   // Include the database connection details
   include 'config.php';

    // Prepare and execute the update query
    $update_sql = "UPDATE raw_add SET product_name=?, department=?, date=?, time=?, size=?, units=?, quantity=?, storeman=?, remarks=?, given_by=? WHERE product_code=?";
    $update_stmt = $conn->prepare($update_sql);

    // Check for a prepare error
    if (!$update_stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind the parameters and execute the update query
$update_stmt->bind_param("ssssissssss", $product_name, $department, $date, $time, $size, $units, $quantity, $storeman, $remarks, $given_by, $product_code);


    if ($update_stmt->execute()) {
        $_SESSION['status'] = "Product Updated Successfully!";
        header("Location: raw_list.php");
    } else {
        echo "Error updating product: " . $update_stmt->error;
    }

    // Close the update statement and the database connection
    $update_stmt->close();
    $conn->close();
} else {
    // Redirect to list.php if the form is not submitted
    header("Location: raw_list.php");
    exit();
}
?>
