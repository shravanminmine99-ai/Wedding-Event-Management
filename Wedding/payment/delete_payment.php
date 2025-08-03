<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "WeddingEventDB";

$conn = new mysqli($servername, $username, $password, $database);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM Payments WHERE payment_id = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: payments.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
