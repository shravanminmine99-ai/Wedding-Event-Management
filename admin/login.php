<?php
session_start();

try {
    $pdo = new PDO('mysql:host=localhost;dbname=weddingeventdb', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
        $stmt->execute([$username]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($password, $admin['password'])) {
            $_SESSION['username'] = $username;
            header("Location: ../index.php"); // Or any protected page
            exit();
        } else {
            echo "<script>alert('Invalid credentials'); window.location.href='../login.html';</script>";
        }
    }
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>
