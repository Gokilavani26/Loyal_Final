<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['is_admin'])) {
    // Redirect to login or show an error message
    header("Location: raw_login.html");
    exit();
}

// Check if the user is an admin
$isAdmin = $_SESSION['is_admin'];

// Check if the product_code is provided in the URL
if (isset($_GET['product_code'])) {
    $deleteProductCode = $_GET['product_code'];

   // Include the database connection details
    include 'config.php';

    // Prepare and execute the delete query
    $delete_sql = "DELETE FROM raw_add WHERE product_code = ?";
    $delete_stmt = $conn->prepare($delete_sql);

    // Check for a prepare error
    if (!$delete_stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind the parameters and execute the delete query
    $delete_stmt->bind_param("s", $deleteProductCode);

    if ($delete_stmt->execute()) {
        // Redirect back to list.php after deletion
        header("Location: raw_list.php");
        exit();
    } else {
        echo "Error deleting data: " . $delete_stmt->error;
    }

    // Close the delete statement and the database connection
    $delete_stmt->close();
    $conn->close();
} else {
    // Redirect to list.php if product_code is not provided
    header("Location: raw_list.php");
    exit();
}
?>
