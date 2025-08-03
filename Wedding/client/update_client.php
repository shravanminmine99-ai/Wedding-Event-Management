<?php
include 'db_connect.php';

$client_id = $_POST['client_id'];
$bride_name = $_POST['bride_name'];
$groom_name = $_POST['groom_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];

$sql = "UPDATE Clients SET 
        bride_name = '$bride_name',
        groom_name = '$groom_name',
        email = '$email',
        phone = '$phone',
        address = '$address'
        WHERE client_id = $client_id";

if (mysqli_query($conn, $sql)) {
    echo "✅ Client updated successfully. <a href='client_print.php'>Go back</a>";
} else {
    echo "❌ Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
