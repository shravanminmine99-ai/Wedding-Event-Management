<?php
session_start();
$conn = new mysqli("localhost", "root", "", "weddingeventdb");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $stmt->store_result();
    if ($stmt->num_rows === 1) {
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();

        if (password_verify($password, $hashedPassword)) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $username;
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No such user found.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Wedding Event Login</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #74ebd5, #9face6);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }

        @keyframes float {
            0% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0); }
        }

        form {
            background: white;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            width: 320px;
            animation: float 3s ease-in-out infinite;
            position: relative;
        }

        h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-top: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            transition: 0.3s;
        }

        input:focus {
            border-color: #7f5af0;
            box-shadow: 0 0 8px rgba(127, 90, 240, 0.3);
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background: linear-gradient(to right, #ff416c, #ff4b2b);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: linear-gradient(to right, #ff4b2b, #ff416c);
        }

        .link {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        .link a {
            color: #007bff;
            text-decoration: none;
            transition: 0.3s;
        }

        .link a:hover {
            text-decoration: underline;
        }

        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
            font-weight: bold;
        }

        /* Animated background shapes (optional) */
        .bg-circle {
            position: absolute;
            border-radius: 50%;
            opacity: 0.2;
            z-index: -1;
        }

        .circle1 {
            width: 150px;
            height: 150px;
            background: #ff9a9e;
            top: -40px;
            left: -40px;
        }

        .circle2 {
            width: 100px;
            height: 100px;
            background: #a1c4fd;
            bottom: -30px;
            right: -30px;
        }

    </style>
</head>
<body>
    <form method="post">
        <div class="bg-circle circle1"></div>
        <div class="bg-circle circle2"></div>

        <h2>Admin Login</h2>
        <input type="text" name="username" placeholder="Username" required autofocus>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
        <div class="link">
            Don't have an account? <a href="register.php">Register here</a>
        </div>
        
        <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
    </form>
</body>
</html>
