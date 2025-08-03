<?php
$server = "localhost";
$user = "root";
$password = "";
$db = "v2v";

// Create connection
$conn = mysqli_connect($server, $user, $password, $db);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$name = $_GET['name'];
$adhaar = $_GET['adhaar'];
$number = $_GET['number'];
$gender = $_GET['gender'];
$email = $_GET['email'];


$sql = "INSERT INTO reg (Name, Adhaar, Phone, Gender , Email)
VALUES ('$name','$adhaar','$number','$gender','$email')";

if (mysqli_query($conn, $sql)) {
  echo " Details submited successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>