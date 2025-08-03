<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "WeddingEventDB";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'] ?? '';

if ($id) {
    $stmt = $conn->prepare("DELETE FROM events WHERE event_id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Event deleted successfully.";
    } else {
        echo "Failed to delete event.";
    }

    $stmt->close();
} else {
    echo "Invalid ID.";
}

$conn->close();
?>
