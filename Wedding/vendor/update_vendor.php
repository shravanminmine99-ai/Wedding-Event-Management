<?php
$conn = new mysqli("localhost", "root", "", "WeddingEventDB");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $conn->prepare("UPDATE Vendors SET vendor_name=?, service_type=?, contact_name=?, phone=?, email=?, cost_estimate=? WHERE vendor_id=?");
    $stmt->bind_param(
        "ssssssi",
        $_POST['vendor_name'],
        $_POST['service_type'],
        $_POST['contact_name'],
        $_POST['phone'],
        $_POST['email'],
        $_POST['cost_estimate'],
        $_POST['vendor_id']
    );

    if ($stmt->execute()) {
        header("Location: vendor_print.php"); // Adjust to wherever you list vendors
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}
?>
