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

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $username = $_POST['username'];
    $password = $_POST['password'];
    $year = $_POST['year'];
    $course = $_POST['course'];
    $program = $_POST['program'];

  
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

   
    $stmt = $conn->prepare("INSERT INTO users (username, password, year, course, program) VALUES (?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }


    $stmt->bind_param("sssss", $username, $hashed_password, $year, $course, $program);

    if ($stmt->execute()) {
        $message = "New record created successfully";
    } else {
        $message = "Error: " . $stmt->error;
    }

 
    $stmt->close();
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
            width: 570px; 
            height: 570px; 
            padding: 80px;
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
        <form method="POST" action="" class="w-full space-y-4">
            <?php if ($message != ""): ?>
                <div class="mb-4 text-center text-green-500">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <input type="text" name="username" placeholder="Username" class="w-full px-3 py-2 border-2 border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            <input type="password" name="password" placeholder="Password" class="w-full px-3 py-2 border-2 border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            <input type="text" name="year" placeholder="Year" class="w-full px-3 py-2 border-2 border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            <input type="text" name="course" placeholder="Course" class="w-full px-3 py-2 border-2 border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            <input type="text" name="program" placeholder="Program" class="w-full px-3 py-2 border-2 border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            <button type="submit" class="w-full p-2 text-white bg-blue-600 rounded hover:bg-blue-700 transition-colors duration-300">Register</button>
        </form>
        <a href="login.php" class="block mt-4 text-center text-blue-600 hover:underline">Already have an account? Login</a>
    </div>
</body>
</html>
