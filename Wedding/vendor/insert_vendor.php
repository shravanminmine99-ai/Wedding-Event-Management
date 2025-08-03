<?php
$conn = new mysqli("localhost", "root", "", "WeddingEventDB");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $conn->prepare("INSERT INTO Vendors (vendor_name, service_type, contact_name, phone, email, cost_estimate) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
        "sssssd",
        $_POST['vendor_name'],
        $_POST['service_type'],
        $_POST['contact_name'],
        $_POST['phone'],
        $_POST['email'],
        $_POST['cost_estimate']
    );

    if ($stmt->execute()) {
        header("Location: vendor_form.html");
        exit();
    } else {
        echo "Insert error: " . $stmt->error;
    }
}
?>
