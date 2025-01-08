<?php
$host = '127.0.0.1';    // Database host (usually localhost or 127.0.0.1)
$user = 'root';         // Database username (use your own username)
$password = '';         // Database password (use your own password)
$dbname = 'dbperpus';  // Database name

// Create a connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
