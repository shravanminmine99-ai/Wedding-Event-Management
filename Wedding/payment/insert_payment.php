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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $client_id = (int) $_POST['client_id'];
    $amount_paid = (float) $_POST['amount_paid'];
    $payment_date = $_POST['payment_date'];
    $payment_method = $_POST['payment_method'];
    $remarks = $_POST['remarks'];

    // Prepare the SQL query
    $sql = "INSERT INTO Payments (client_id, amount_paid, payment_date, payment_method, remarks) 
            VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind parameters (i - int, d - double, s - string)
        mysqli_stmt_bind_param($stmt, "idsss", $client_id, $amount_paid, $payment_date, $payment_method, $remarks);

        if (mysqli_stmt_execute($stmt)) {
            echo "Payment recorded successfully!";
        } else {
            echo "Execution failed: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Prepare failed: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
