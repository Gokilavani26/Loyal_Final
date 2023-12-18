<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['is_admin'])) {
    // Redirect to login or show an error message
    header("Location: finished_login.html");
    exit();
}

// Check if the user is an admin
$isAdmin = $_SESSION['is_admin'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form using POST method
    $product_code = $_POST["product_code"];
    $product_name = $_POST["product_name"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $size6 = $_POST["size6"];
    $size7 = $_POST["size7"];
    $size8 = $_POST["size8"];
    $size9 = $_POST["size9"];
    $size10 = $_POST["size10"];
    $size11 = $_POST["size11"];
    $total = $_POST["total"];
    $storeman = $_POST["storeman"];
    $remarks = $_POST["remarks"];
    $given_by = $_POST["given_by"];

    // Include the database connection details
    include 'config.php';

    // Prepare and execute the update query
    $update_sql = "UPDATE finish_add SET product_name=?, date=?, time=?, size6=?, size7=?, size8=?, size9=?, size10=?, size11=?, total=?, storeman=?, remarks=?, given_by=? WHERE product_code=?";
    $update_stmt = $conn->prepare($update_sql);

    // Check for a prepare error
    if (!$update_stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind the parameters and execute the update query
$update_stmt->bind_param("sssiiiiiisssss", $product_name, $date, $time, $size6, $size7, $size8, $size9, $size10, $size11, $total, $storeman, $remarks, $given_by, $product_code);

    if ($update_stmt->execute()) {
        $_SESSION['status'] = "Product Updated Successfully!";
        header("Location: finished_list.php");
    } else {
        echo "Error updating product: " . $update_stmt->error;
    }

    // Close the update statement and the database connection
    $update_stmt->close();
    $conn->close();
} else {
    // Redirect to list.php if the form is not submitted
    header("Location: finished_list.php");
    exit();
}
?>
