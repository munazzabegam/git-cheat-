<?php
$servername = "localhost";  // Adjust if necessary for your hosting
$username = "root";         // Default MySQL username
$password = "";             // Default password (empty for XAMPP)
$dbname = "git_cheat_website"; // The database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
