<?php
// Database connection settings
$host = "localhost";
$username = "root";     
$password = "";    
$database = "WeddingEventDB";

// Connect to database
$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get and sanitize form data
$name = mysqli_real_escape_string($conn, $_POST['name']);
$role = mysqli_real_escape_string($conn, $_POST['role']);
$contact = mysqli_real_escape_string($conn, $_POST['contact']);

// SQL insert query
$sql = "INSERT INTO Staff (name, role, contact)
        VALUES ('$name', '$role', '$contact')";

if (mysqli_query($conn, $sql)) {
    echo "Staff member added successfully!";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>
