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

 // Include the database connection details
 include 'config.php';

$data = array();

$product_code = isset($_GET['product_code']) ? $_GET['product_code'] : '';

$gpQuery = "SELECT DISTINCT * FROM finish_release WHERE product_code = '$product_code'";
$gpResult = $conn->query($gpQuery);

if ($gpResult->num_rows > 0) {
      while ($row = $gpResult->fetch_assoc()) {
        $data[] = $row;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            position: relative;
            font-family: 'Raleway', sans-serif;
        }

        .watermark {            
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            z-index: -1; 
            opacity: 0.2; 
        }

        .styled-table {

            border-collapse: collapse;
            font-size: 0.9em;
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
            border: 1px solid black;
            width: 100%;

        }

        .styled-table th {

            color: black;
            text-align: center;
        }

        .styled-table th,
        .styled-table td {
            border: 1px solid black;
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

        .section {
            margin: 10px 0;
            text-align: left;
            margin-left: 80%;
        }

        .sectionleft {
            margin: 10px 0;
            margin-left: 8%;
            text-align: left;
        }

        @media print {
            .nav-button,
            #gp,
            .print,
            pre,
            input[type="submit"] {
                display: none;
            }
        }
    </style>
    <script>
        function printPage() {
            window.print();
        }
    </script>
</head>

<body>
<img class="watermark" src="images/logo_loyal.jpeg" alt="Watermark">

     <a href="finished_list.php"><button class="print" style="border-radius:5px;margin-top:3pc;margin-left:50pc;padding:10px;background-color:rgb(255, 136, 0);color:white;border:none;">Home</button></a>
    <button onclick="printPage()" class="print" style="border-radius:5px;margin-top:3pc;margin-left:1pc;padding:10px;background-color:rgb(255, 136, 0);color:white;border:none;margin-right:50px;">Print</button>

    <h1 style="text-align:center; margin:25px;">LOYAL SMALL SCALE INDUSTRIES LTD</h1>
    <p style="text-align:center; margin:10px;">Manufacturers of pure leather and leather products</p>
    <p style="text-align:center; margin:10px;">Plot no: 36-48, Nile crescent road, Jinja (U)</p>
    <p style="text-align:center; margin:10px;">Mobile: 0759567511,0751567511</p>
    <h1 style="text-align:center; margin:25px;">OUTWARD GATEPASS</h1>

    <?php
    if (!empty($data)) {
        echo '<div class="section"><b>DATE: </b> ' .  date("d-m-y", strtotime($data[0]["date"])) . '</div>';
        echo '<div class="section"><b>TIME: </b> ' . $data[0]["time"] . '</div>';
        echo '<div class="section"><b>GP NO: </b> ' . $data[0]["sell_id"] . '</div><br>';
        echo '<p style="text-align:center; margin:20px;"><b><span>Security guard:   </span></b>Please check and allow to take out the following material from the Centre.</p>';
        echo '<table class="styled-table">';
        echo '<thead><tr><th>S No.</th><th>COMPANY NAME</th><th>MODEL NAME/NO</th>
    <th>SIZE6</th><th>SIZE7</th><th>SIZE8</th><th>SIZE9</th><th>SIZE10</th><th>SIZE11</th><th>TOTAL</th></tr></thead>';
        echo '<tbody>';

        // Initialize serial number
        $serialNumber = 1;

        foreach ($data as $row) {
            echo '<tr>';
            echo '<td>' . $serialNumber . '</td>';
            echo '<td>' . ($row["taken_by"] ?? '') . '</td>';
            echo '<td>' . ($row["product_code"] ?? '') .' - '.($row["product_name"] ?? '') . '</td>';
            echo '<td>' . ($row["size6"] ?? '') . '</td>';
            echo '<td>' . ($row["size7"] ?? '') . '</td>';
            echo '<td>' . ($row["size8"] ?? '') . '</td>';
            echo '<td>' . ($row["size9"] ?? '') . '</td>';
            echo '<td>' . ($row["size10"] ?? '') . '</td>';
            echo '<td>' . ($row["size11"] ?? '') . '</td>';
            echo '<td>' . ($row["total"] ?? '') . '</td>';
            echo '</tr>';

            // Increment the serial number for the next row
            $serialNumber++;
        }

        echo '</tbody>';
        echo '</table><br>';

        echo '<br><h2 class="sectionleft">TOTAL :    </h2>';
        // echo '<h2>TOTAL :    '. $row["total"] .'</h2>';
        echo '<br><br><div class="section"><b>AUTHORISED BY</b> </div><br>';
        echo '<div class="sectionleft"><b>Taken By:</b> ' . ($data[0]["taken_by"] ?? '') . '</div>';
        echo '<div class="sectionleft"><b>Designation:</b> ' . ($data[0]["designation"] ?? '') . '</div>';
        echo '<div class="sectionleft"><br><b>GOODS/ITEMS ARE CHECKED AS PER ABOVE LIST AND FOUND CORRECT.</b></div>';
        echo '<div class="sectionleft"><br>SECURITY GUARD: </div><br><br><br>';
    } else {
        echo 'No items available!!!';
    }
    ?>
</body>

</html>
