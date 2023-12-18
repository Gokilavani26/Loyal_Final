<?php
  // Start a PHP session to manage user sessions
  session_start();

// Check if the user is attempting to logout
if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    // Destroy the session
    session_destroy();

    // Redirect to the login page
    header("Location: finished_login.html");
    exit();
}

// Check if the user is not logged in
if (!isset($_SESSION['is_admin'])) {
    // Redirect to the login page
    header("Location: finished_login.html");
    exit();
}

// Check if the user is an admin
$isAdmin = $_SESSION['is_admin'];

 // Include the database connection details
include 'config.php';

// Fetch data from the "finish_add" table with pagination
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page number
$offset = ($page - 1) * $itemsPerPage; // Calculate the offset for the SQL query

$sql = "SELECT product_code, product_name, total FROM finish_add ORDER BY date ASC LIMIT $offset, $itemsPerPage";
$result = $conn->query($sql);

if ($result->num_rows) {
    // Create an array to store the data
    $data = array();

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    echo "No data found.";
}

// Get the total number of rows in the table
$countQuery = "SELECT COUNT(*) as total FROM finish_add";
$countResult = $conn->query($countQuery);
$countRow = $countResult->fetch_assoc();
$totalItems = $countRow['total'];


  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve data from the HTML form
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
}
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            background: url("images/list_bg.jpg");
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
    </style>
</head>
<body>
<?php
if (isset($_SESSION['status'])) {
    echo '<h2 class="alert">' . $_SESSION['status'] . '</h2>';
    unset($_SESSION['status']);
}
?>
    <a href="finished_add.html"><button style="border-radius:5px;margin-top:3pc;margin-left:60pc;padding:1pc;background-color:rgb(255, 136, 0);color:white;border:none;">Add Goods</button></a>
    <a href="finished_release.html"><button style="border-radius:5px;margin-top:3pc;margin-left:2pc;padding:1pc;background-color:rgb(255, 136, 0);color:white;border:none;">Release Goods</button></a>
    <a href="finished_report.php"><button style="border-radius:5px;margin-top:3pc;margin-left:2pc;padding:1pc;background-color:rgb(255, 136, 0);color:white;border:none;">Report</button></a>
    <a href="finished_list.php?logout=1">
        <button style="border-radius:5px;margin-top:3pc;margin-left:2pc;padding:1pc;background-color:red ;color:white;border:none;">Logout</button>
    </a>
<?php

// Fetch data from the "finish_add" table
$sql = "SELECT product_code, product_name, total FROM finish_add ORDER BY date ASC";
$result = $conn->query($sql);

if ($result->num_rows) {
    // Create an array to store the data
    $data = array();

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    echo "No data found.";
}
?>
<!-- Display the HTML table for finished goods -->
<h1 style="text-align:center; margin:25px;">Finished Goods Table</h1>

<?php

if (!empty($data)) {
    echo '<table class="styled-table">';
    echo '<thead><tr><th>Product Code</th><th>Product Name</th><th>Total</th>';
    if ($isAdmin) {
        echo '<th>Edit</th><th>Delete</th></tr></thead>';
    }
    echo '<tbody>';

    foreach ($data as $row) {
        echo '<tr';

        // Check if the total is less than the threshold and apply a style
        if ($row["total"] < $threshold) {
            echo ' style="background-color: red;"';
        }

        echo '>';
        echo '<td>' . $row["product_code"] . '</td>';
        echo '<td>' . $row["product_name"] . '</td>';
        echo '<td>' . $row["total"] . '</td>';
        if ($isAdmin) {
            echo '<td><a href="finished_edit.php?product_code=' . $row['product_code'] . '"><button style="border-radius:5px;padding:0.5pc;background-color: rgb(32, 155, 155);color:white;border:none;">Edit</button></a></td>';
            echo '<td><a href="finished_delete.php?product_code=' . $row['product_code'] . '"><button style="border-radius:5px;padding:0.5pc;background-color: red;color:white;border:none;">Delete</button></a></td>';
        }
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table><br>';

    // Display pagination links
    echo '<div style="text-align:center;">';
    $totalPages = ceil($totalItems / $itemsPerPage);
    for ($i = 1; $i <= $totalPages; $i++) {
        echo '<a href="?page=' . $i . '">' . $i . '</a> ';
    }
    echo '</div>';
} else {
    echo 'No items available!!!';
}
?>
</body>
</html>
