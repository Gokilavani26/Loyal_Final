<?php
session_start();

 // Include the database connection details
 include 'config.php';
 
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user inputs
    $enteredUsername = $_POST["username"];
    $enteredPassword = $_POST["password"];

    // Check if the entered username and password are correct
    if (($enteredUsername === $correctUsername && $enteredPassword === $correctPassword) ||
        ($enteredUsername === $adminUsername && $enteredPassword === $adminPassword)) {
        // Check if the user is an admin
        $isAdmin = ($enteredUsername === $adminUsername);
        $_SESSION['is_admin'] = $isAdmin;

        // Authentication successful, redirect to the next page
        header("Location: raw_list.php");
        exit();
    } else {
        // Authentication failed, display an error message
        echo "Invalid username or password. Please try again.";
    }
}
?>
