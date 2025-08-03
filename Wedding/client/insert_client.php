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
$bride = $_POST['bride_name'];
$groom = $_POST['groom_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];

// Insert into Clients table
$sql = "INSERT INTO Clients (bride_name, groom_name, email, phone, address) 
        VALUES ('$bride', '$groom', '$email', '$phone', '$address')";

if (mysqli_query($conn, $sql)) {
    echo "Client registered successfully!";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
