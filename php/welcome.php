<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['first_name'])) {
    // If no user is logged in, redirect to login page
    header("Location: ../php/login.php");
    exit;
}

$user_name = $_SESSION['first_name'];  // Retrieve the name stored in session

echo "<h1>Welcome, $user_name!</h1>";
?>

<!-- You can include other content here like a logout button -->
<a href="../php/logout.php">Logout</a>
