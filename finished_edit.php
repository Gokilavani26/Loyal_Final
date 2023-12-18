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

// Check if the product_code is provided in the URL
if (isset($_GET['product_code'])) {
    $editProductCode = $_GET['product_code'];

   // Include the database connection details
    include 'config.php';

    // Prepare and execute the select query
    $select_sql = "SELECT * FROM finish_add WHERE product_code = ?";
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
    <title>Edit Finished Goods Details</title>
    <link rel="stylesheet" href="css/raw_add.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="container">
    <div class="title">Edit Product</div>
    <div class="content">
        <form action="process_finished_edit.php" method="POST">
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
                  <span class="details">Date</span>
                  <input type="date" name="date" value="<?php echo $row['date']; ?>" required>
                </div>
                <div class="input-box">
                  <span class="details">Time</span>
                  <input type="time" name="time" value="<?php echo $row['time']; ?>" required>
                </div>
                <div class="input-box">
            <span class="details">Size-6</span>
            <input type="number" name="size6" value="<?php echo $row['size6']; ?>" required> 
          </div>
          <div class="input-box">
            <span class="details">Size-7</span>
            <input type="number" name="size7" value="<?php echo $row['size7']; ?>" required>
          </div>
          <div class="input-box">
            <span class="details">Size-8</span>
            <input type="number" name="size8" value="<?php echo $row['size8']; ?>" required>
          </div>
          <div class="input-box">
            <span class="details">Size-9</span>
            <input type="number" name="size9" value="<?php echo $row['size9']; ?>" required>
          </div>
          <div class="input-box">
            <span class="details">Size-10</span>
            <input type="number" name="size10" value="<?php echo $row['size10']; ?>" required>
          </div>
          <div class="input-box">
            <span class="details">Size-11</span>
            <input type="number" name="size11" value="<?php echo $row['size11']; ?>" required>
          </div>
          <div class="input-box">
            <span class="details">Total</span>
            <input type="number" name="total" value="<?php echo $row['total']; ?>" required>
          </div> 
          <div class="input-box" >
                  <span class="details">Given By</span>
                  <input type="text" name="given_by" value="<?php echo $row['given_by']; ?>" required>
                </div>     
                <div class="input-box">
                  <span class="details">Remarks</span>
                  <input type="text" name="remarks" value="<?php echo $row['remarks']; ?>" required>
                </div>     
                <div class="input-box">
                  <span class="details">Storeman</span>
                  <input type="text" name="storeman" value="<?php echo $row['storeman']; ?>" required>
                </div>                
            </div>
            <div class="button">
                <input type="submit" value="Update">
            </div>
        </form>
    </div>
</div>

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
    // Redirect to list1.php if product_code is not provided
    header("Location: finished_login.php");
    exit();
}
?>