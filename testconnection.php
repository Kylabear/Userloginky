<?php
$servername = "localhost";
$username = "root";
$password = ""; // Update if necessary
$database = "my_database";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
