<?php
$servername = "localhost";
$username = "root";
$password = ""; // Default empty password
$dbname = "portfolio_website";
$port = "3307"; // Ensure this matches your MySQL port

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
