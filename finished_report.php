<?php
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

    // Include the database connection details
    include 'config.php';

// Fetch data from the "finish_release" table with filtering
$filter_product_code = isset($_GET['filter_product_code']) ? $_GET['filter_product_code'] : '';

// Determine the sorting order based on the user's choice
$sortOrder = isset($_GET['sortOrder']) && ($_GET['sortOrder'] == 'asc' || $_GET['sortOrder'] == 'desc') ? $_GET['sortOrder'] : 'desc';

// Build the SQL query with filtering and sorting
$sql = "SELECT product_code, product_name, total, date, time, taken_by FROM finish_release 
        WHERE product_code LIKE '%$filter_product_code%'
        ORDER BY date $sortOrder, time $sortOrder";

$result = $conn->query($sql);

if ($result === false) {
    die("Error in SQL query: " . $conn->error);
}

// Determine the sorting order based on the user's choice
$sortOrder = isset($_GET['sortOrder']) && ($_GET['sortOrder'] == 'asc' || $_GET['sortOrder'] == 'desc') ? $_GET['sortOrder'] : 'desc';

/// Fetch data from the "finish_release" table with filtering
$filter_product_code = isset($_GET['filter_product_code']) ? $_GET['filter_product_code'] : '';
$filter_taken_by = isset($_GET['filter_taken_by']) ? $_GET['filter_taken_by'] : '';

// Determine the sorting order based on the user's choice
$sortOrder = isset($_GET['sortOrder']) && ($_GET['sortOrder'] == 'asc' || $_GET['sortOrder'] == 'desc') ? $_GET['sortOrder'] : 'desc';

// Build the SQL query with filtering and sorting
$sql = "SELECT product_code, product_name, total, date, time, taken_by FROM finish_release 
        WHERE product_code LIKE '%$filter_product_code%' AND taken_by LIKE '%$filter_taken_by%'
        ORDER BY date $sortOrder, time $sortOrder";

$result = $conn->query($sql);

if ($result === false) {
    die("Error in SQL query: " . $conn->error);
}

// Create an array to store the data
$data = array();

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

?>

<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            background: url('images/list_bg.jpg');
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
.filter-input {
    width: 150px; /* Adjust the width as needed */
    padding: 8px;
    margin: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.filter-button {
    padding: 10px;
    background-color: rgb(255, 136, 0);
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
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

<a href="finished_list.php"><button style="border-radius:5px;margin-top:3pc;margin-left:60pc;padding:1pc;background-color:rgb(255, 136, 0);color:white;border:none;">Stocks Page</button></a>
<a href="finished_report.php?logout=1">
    <button style="border-radius:5px;margin-top:3pc;margin-left:2pc;padding:1pc;background-color:red ;color:white;border:none;">Logout</button>
</a>

<!-- Add a form section for filtering -->
<form action="finished_report.php" method="GET" style="margin: 20px;">
    <label for="filter_product_code">Filter Product Code:</label>
    <input type="text" class="filter-input" name="filter_product_code" id="filter_product_code" value="<?= htmlspecialchars($filter_product_code) ?>">

    <label for="filter_taken_by">Filter Taken By:</label>
    <input type="text" class="filter-input" name="filter_taken_by" id="filter_taken_by" value="<?= isset($filter_taken_by) ? htmlspecialchars($filter_taken_by) : '' ?>">

    <input type="submit" class="filter-button" value="Apply Filters">
</form>

<h1 style="text-align:center; margin:25px;">Finished Goods Report</h1>

<!-- Display the HTML table -->
<?php
if (!empty($data)) {
    echo '<table class="styled-table">';
    echo '<thead><tr><th>Product Code</th><th>Product Name</th><th>Total</th>';
    echo '<th>';
    echo 'Date ';
    // Add sorting icons based on the current sort order
    if ($sortOrder == 'asc') {
        echo '<a href="finished_report.php?sortOrder=desc"> &#9650;</a>';
    } else {
        echo '<a href="finished_report.php?sortOrder=asc"> &#9660;</a>';
    }
    echo '</th>';
    echo '<th>Time</th><th>Taken By</th>
    <th></th>
    
    </tr></thead>';
    echo '<tbody>';

    foreach ($data as $row) {
        echo '<tr>';
        echo '<td>' . $row["product_code"] . '</td>';
        echo '<td>' . $row["product_name"] . '</td>';
        echo '<td>' . $row["total"] . '</td>';
        echo '<td>' . $row["date"] . '</td>';
        echo '<td>' . $row["time"] . '</td>';
        echo '<td>' . $row["taken_by"] . '</td>';
        echo '<td><a href="display_gatepass.php?product_code=' . $row['product_code'] . '"><button style="border-radius:5px;padding:0.5pc;background-color: rgb(32, 155, 155);color:white;border:none;">Gatepass</button></a></td>';

        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table><br>';
} else {
    echo 'No items available!!!';
}
?>

</body>
</html>
