<?php
$servername = "localhost";
$username = "root";
$password = ""; // Change as needed
$dbname = "WeddingEventDB";

// Connect to database
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get form data
$username = $_POST['username'];
$password = $_POST['password'];

// Insert into Clients table
$sql = "INSERT INTO Admins (username, password) 
        VALUES ('$username', '$password')";

if (mysqli_query($conn, $sql)) {
    echo " registered successfully!";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
