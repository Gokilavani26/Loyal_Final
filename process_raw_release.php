
<?php
session_start();

    // Include the database connection details
    include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    $taken_by = $_POST["taken_by"];

    // Check if the product exists and has sufficient quantity
    $sql = "SELECT * FROM raw_add WHERE product_code = ? AND product_name = ?";
    $stmt = $conn->prepare($sql);

    // Check for a prepare error
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind the parameters and execute
    $stmt->bind_param("ss", $product_code, $product_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $available_quantity = $row["quantity"];

        // Check if the available quantity is sufficient
           if ($available_quantity >= $quantity) {
            // Update the database to reduce the quantity
            $new_quantity = $available_quantity - $quantity;
            $update_sql = "UPDATE raw_add SET quantity = ? WHERE product_code = ? AND product_name = ?";
            $update_stmt = $conn->prepare($update_sql);

            // Check for a prepare error
            if (!$update_stmt) {    
                die("Prepare failed: " . $conn->error);
            }

            // Bind the parameters and execute the update
            $update_stmt->bind_param("iss", $new_quantity, $product_code, $product_name);

            if ($update_stmt->execute()) {
                $_SESSION['status'] = "Product Released Successfully!";
                
                $sql = "INSERT INTO raw_release (product_code, product_name, date, time, size, department, quantity, units, storeman, remarks, taken_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
            
                // Check for a prepare error
                if (!$stmt) {
                    die("Prepare failed: " . $conn->error);
                }
            
                // Bind parameters and execute
                $stmt->bind_param("ssssisissss", $product_code, $product_name, $date, $time, $size, $department, $quantity, $units, $storeman, $remarks, $taken_by);
            
                if ($stmt->execute()) {
                    // Redirect after successful insertion
                    header("Location: raw_list.php");
                } else {
                    echo "Error inserting data into raw_release table: " . $stmt->error;
                }
            } else {
                echo "Error updating quantity: " . $update_stmt->error;
            }
            
            // Close the update statement
            $update_stmt->close();
        } else {
            $_SESSION['status'] = "Insufficient Quantity!";
            header("Location: raw_list.php"); // Redirect to an appropriate page
        }
    } else {
        $_SESSION['status'] = "Product Not Found!";
        header("Location: raw_list.php"); // Redirect to an appropriate page
    }

    // Close the prepared statement and the database connection
    $stmt->close();
    $conn->close();
}
?>
