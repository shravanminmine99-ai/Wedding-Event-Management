<?php
$conn = new mysqli("localhost", "root", "", "WeddingEventDB");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM Vendors WHERE vendor_id = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: vendors_list.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>
