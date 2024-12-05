<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_system";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $year = $_POST['year'];
    $course = $_POST['course'];
    $program = $_POST['program'];

    $sql = "INSERT INTO users (username, password, year, course, program)
            VALUES ('$username', '$password', '$year', '$course', '$program')";

    if ($conn->query($sql) === TRUE) {
        $message = "New record created successfully";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>User Registration</title>
    <style>
        body {
            background-image: url('img/bglogin.avif');
            background-size: cover;
            background-position: center;
        }
        .blur-form {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(5px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            width: 850x; 
            height: 550px; 
            padding: 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }
        .blur-form input, .blur-form label {
            backdrop-filter: none;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="rounded-lg shadow-lg blur-form">
        <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>
        <form method="POST" action="" class="w-full">
            <?php if ($message != ""): ?>
                <div class="mb-4 text-center text-green-500">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <div class="mb-4">
                <label for="username" class="block text-gray-700">Username:</label>
                <input type="text" id="username" name="username" required class="w-full px-3 py-2 border-2 border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password:</label>
                <input type="password" id="password" name="password" required class="w-full px-3 py-2 border-2 border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="mb-4">
                <label for="year" class="block text-gray-700">Year:</label>
                <input type="text" id="year" name="year" class="w-full px-3 py-2 border-2 border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="mb-4">
                <label for="course" class="block text-gray-700">Course:</label>
                <input type="text" id="course" name="course" required class="w-full px-3 py-2 border-2 border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="mb-4">
                <label for="program" class="block text-gray-700">Program:</label>
                <input type="text" id="program" name="program" class="w-full px-3 py-2 border-2 border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="text-center">
                <input type="submit" value="Add User" class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600 transition-colors duration-300">
            </div>
        </form>
    </div>
</body>
</html>
