<?php
session_start();

// Check if the user is attempting to logout
if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    // Destroy the session
    session_destroy();

    // Redirect to the login page
    header("Location: raw_login.html");
    exit();
}

// Check if the user is logged in
if (!isset($_SESSION['is_admin'])) {
    // Redirect to login or show an error message
    header("Location: raw_login.html");
    exit();
}

// Check if the user is an admin
$isAdmin = $_SESSION['is_admin'];

// Include the database connection details
include 'config.php';
?>
 
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            background: url("./images/list_bg.jpg");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            background-size: cover;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            -ms-background-size: cover;
            font-family: 'Raleway', sans-serif;
        }

        .styled-table {
            width: 60%;
            border-collapse: collapse;
            margin: 5pc 20pc;
            font-size: 0.9em;
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
            background-color: white;
        }

        .styled-table th {
            background-color: rgb(255, 136, 0);
            color: #ffffff;
            text-align: center;
        }

        .styled-table th,
        .styled-table td {
            padding: 15px 15px;
        }

        .alert {
            text-align: center;
            background-color: green;
            padding: 5px;
        }

        .nav-button {
            border-radius: 5px;
            margin-top: 3pc;
            padding: 1pc;
            background-color: rgb(255, 136, 0);
            color: white;
            border: none;
        }
        
       .pagination-container {
            text-align: center;
            margin-top: 20px;
        }

        .pagination-link {
            margin-right: 5px;
            padding: 5px 10px;
            border: 1px solid rgb(255, 136, 0);
            background-color: #f0f0f0;
            text-decoration: none;
            color: #333;
        }
    </style>
</head>
<body>
<?php
if (isset($_SESSION['status'])) {
    echo '<h2 class="alert">' . $_SESSION['status'] . '</h2>';
    unset($_SESSION['status']);
}
?>

<a href="raw_add.html"><button style="border-radius:5px;margin-top:3pc;margin-left:60pc;padding:1pc;background-color:rgb(255, 136, 0);color:white;border:none;">Add Stocks</button></a>
<a href="raw_release.html"><button style="border-radius:5px;margin-top:3pc;margin-left:2pc;padding:1pc;background-color:rgb(255, 136, 0);color:white;border:none;">Release Stocks</button></a>
<a href="raw_report.php"><button style="border-radius:5px;margin-top:3pc;margin-left:2pc;padding:1pc;background-color:rgb(255, 136, 0);color:white;border:none;">Report</button></a>
<a href="raw_list.php?logout=1">
    <button style="border-radius:5px;margin-top:3pc;margin-left:2pc;padding:1pc;background-color:red ;color:white;border:none;">Logout</button>
</a>

<?php

// Get the total number of rows in the table
$countQuery = "SELECT COUNT(*) as total FROM raw_add";
$countResult = $conn->query($countQuery);
$countRow = $countResult->fetch_assoc();
$totalItems = $countRow['total'];

// Get the current page number
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset for the SQL query
$offset = ($page - 1) * $itemsPerPage;

// Fetch data from the "raw_add" table with pagination
$sql = "SELECT DISTINCT product_code, product_name, quantity, size, department FROM raw_add ORDER BY date ASC LIMIT $offset, $itemsPerPage";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Create an array to store the data
    $data = array();

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    echo "No data found.";
}

?>

<h1 style="text-align:center; margin:25px;">Raw Material Stock Table</h1>

<?php
// Display data and pagination links
if (!empty($data)) {
    echo '<table class="styled-table">';
    echo '<thead><tr><th>Product Code</th><th>Product Name</th><th>Quantity</th>';
    if ($isAdmin) {
        echo '<th>Edit</th><th>Delete</th></tr></thead>';
    }
    echo '<tbody>';

    foreach ($data as $row) {
        echo '<tr';
    
        // Check if the quantity is less than the threshold and apply a style
        if ($row["quantity"] < $threshold) {
            echo ' style="background-color: red;"';
        }
    
        echo '>';
        echo '<td>' . $row["product_code"] . '</td>';
        echo '<td>' . $row["product_name"] . '</td>';
        echo '<td>' . $row["quantity"] . '</td>';
        if ($isAdmin) {
            echo '<td><a href="raw.php?product_code=' . $row['product_code'] . '"><button style="border-radius:5px;padding:0.5pc;background-color: rgb(32, 155, 155);color:white;border:none;">Edit</button></a></td>';
            echo '<td><a href="raw_delete.php?product_code=' . $row['product_code'] . '"><button style="border-radius:5px;padding:0.5pc;background-color: red;color:white;border:none;">Delete</button></a></td>';
        }
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table><br>';

      // Display pagination links at the bottom
   echo '<div class="pagination-container">';
    $totalPages = ceil($totalItems / $itemsPerPage);
    for ($i = 1; $i <= $totalPages; $i++) {
        echo '<a href="?page=' . $i . '" class="pagination-link">' . $i . '</a>';
    }
    echo '</div>';
} else {
    echo 'No items available!!!';
}
 
?>

</body>
</html>
