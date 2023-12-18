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
    $editProductCode = $_GET['product_code'];

    // Include the database connection details
    include 'config.php';

    // Prepare and execute the select query
    $select_sql = "SELECT * FROM raw_add WHERE product_code = ?";
    $select_stmt = $conn->prepare($select_sql);

    // Check for a prepare error
    if (!$select_stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind the parameters and execute the select query
    $select_stmt->bind_param("s", $editProductCode);
    $select_stmt->execute();

    // Get the result
    $result = $select_stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Render your HTML form with the fetched data
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Edit Raw Material Details</title>
    <link rel="stylesheet" href="css/raw_add.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="container">
    <div class="title">Edit Product</div>
    <div class="content">
        <form action="process_raw_edit.php" method="POST">
            <div class="user-details">
            
                <div class="input-box">
                    <span class="details">Product Code</span>
                    <input type="hidden" name="product_code" value="<?php echo $row['product_code']; ?>">
                </div>
                <div class="input-box">
                    <span class="details">Product Name</span>
                    <input type="text" name="product_name" value="<?php echo $row['product_name']; ?>" required>
                </div>
                <div class="input-box">
                    <span class="details">Department</span>
                    <input type="text" name="department" value="<?php echo $row['department']; ?>" required>
                </div>
                <div class="input-box">
                  <span class="details">Date</span>
                  <input type="date" name="date" value="<?php echo $row['date']; ?>" required>
                </div>
                <div class="input-box">
                  <span class="details">Time</span>
                  <input type="time" name="time" value="<?php echo $row['time']; ?>" required>
                </div>
                <div class="input-box" id="size_input_box" style="display: none;">
                    <span class="details">Size</span>
                    <input type="number" name="size" value="<?php echo $row['size']; ?>">
                </div>
                <div class="input-box">
                  <span class="details">Quantity</span>
                  <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" required>
                </div>
                <div class="input-box">
                  <span class="details">Storeman</span>
                  <input type="text" name="storeman" value="<?php echo $row['storeman']; ?>" required>
                </div>
      
                <div class="input-box">
                  <span class="details">Units</span>
                  <input type="text" name="units" value="<?php echo $row['units']; ?>" required>
                </div>           
               
                <div class="input-box">
                  <span class="details">Remarks</span>
                  <input type="text" name="remarks" value="<?php echo $row['remarks']; ?>" required>
                </div>
      
                <div class="input-box" >
                  <span class="details">Given By</span>
                  <input type="text" name="given_by" value="<?php echo $row['given_by']; ?>" required>
                </div>   
            </div>
            <div class="button">
                <input type="submit" value="Update">
            </div>
        </form>
    </div>
</div>
<script>
    // Add an event listener to the Product Code input
    document.getElementById("product_code").addEventListener("input", function () {
        var productCode = this.value;
        var sizeInputBox = document.getElementById("size_input_box");
        var productNameInput = document.getElementById("product_name");

        // Define product code to product name mapping (change as needed)
        var productData = {
            "123": "Product A",
            "456": "Product B",
            "789": "Product C"
        };
        // Update the product name based on the entered product code
        if (productData.hasOwnProperty(productCode)) {
            productNameInput.value = productData[productCode];
        } else {
            productNameInput.value = ""; // Clear the field if not found
        }
        // Show/hide the Size input based on product code
        if (productCode === "123" || productCode === "456" || productCode === "789") {
            sizeInputBox.style.display = "block";
        } else {
            sizeInputBox.style.display = "none";
        }
    });
</script>
</body>
</html>

<?php
    } else {
        echo "Product Not Found!";
    }

    // Close the select statement and the database connection
    $select_stmt->close();
    $conn->close();
} else {
    // Redirect to list.php if product_code is not provided
    header("Location: raw_list.php");
    exit();
}
?>

