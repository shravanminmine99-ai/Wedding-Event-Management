<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "WeddingEventDB";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// Collect POST data
$client_id = $_POST['client_id'];
$event_name = $_POST['event_name'];
$event_date = $_POST['event_date'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$venue_id = $_POST['venue_id'];
$status = $_POST['status'];

// Insert into Events table
$sql = "INSERT INTO Events (client_id, event_name, event_date, start_time, end_time, venue_id, status)
        VALUES ('$client_id', '$event_name', '$event_date', '$start_time', '$end_time', '$venue_id', '$status')";

if (mysqli_query($conn, $sql)) {
    echo "✅ Event created successfully!";
} else {
    echo "❌ Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
