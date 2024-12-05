<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$year = $_POST['year'];
$course = $_POST['course'];
$program = $_POST['program'];

$sql = "INSERT INTO users (username, password, year, course, program) VALUES ('$username', '$password', '$year', '$course', '$program')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful";
    header("Location: login.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
