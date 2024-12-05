<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); 
    $year = $_POST['year'];
    $course = $_POST['course'];
    $program = $_POST['program'];

    $stmt = $conn->prepare("INSERT INTO users (username, password, year, course, program) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $password, $year, $course, $program);

    if ($stmt->execute()) {
        echo "Registration successful";
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
