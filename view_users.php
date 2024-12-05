<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_system";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT username, year, course, program FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>View Users</title>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-200">
    <div class="w-full max-w-4xl p-8 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center">Registered Users</h2>
        <table class="w-full mt-4 table-auto">
            <thead>
                <tr>
                    <th class="px-4 py-2">Username</th>
                    <th class="px-4 py-2">Year</th>
                    <th class="px-4 py-2">Course</th>
                    <th class="px-4 py-2">Program</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-2 border"><?php echo $row['username']; ?></td>
                    <td class="px-4 py-2 border"><?php echo $row['year']; ?></td>
                    <td class="px-4 py-2 border"><?php echo $row['course']; ?></td>
                    <td class="px-4 py-2 border"><?php echo $row['program']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="logout.php" class="block mt-4 text-center text-blue-600 hover:underline">Logout</a>
    </div>
</body>
</html>
