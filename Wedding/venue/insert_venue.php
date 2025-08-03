<?php
// Database configuration
$host = "localhost";
$username = "root";
$password = "";  
$database = "WeddingEventDB";    

// Create connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Sanitize and get POST data
$venue_name = mysqli_real_escape_string($conn, $_POST['venue_name']);
$location = mysqli_real_escape_string($conn, $_POST['location']);
$capacity = (int) $_POST['capacity'];
$cost = (float) $_POST['cost'];

// SQL query to insert data
$sql = "INSERT INTO Venues (venue_name, location, capacity, cost)
        VALUES ('$venue_name', '$location', $capacity, $cost)";

if (mysqli_query($conn, $sql)) {
    echo "Venue added successfully!";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>
