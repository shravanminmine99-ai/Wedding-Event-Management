<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Check if client has related payments
    $checkSql = "SELECT COUNT(*) AS total FROM Payments WHERE client_id = $id";
    $checkResult = mysqli_query($conn, $checkSql);
    $row = mysqli_fetch_assoc($checkResult);

    if ($row['total'] > 0) {
        // Related records exist – prevent deletion
        header("Location: client_print.php?error=client_in_use");
        exit();
    }

    // Safe to delete
    $sql = "DELETE FROM Clients WHERE client_id = $id";

    if (mysqli_query($conn, $sql)) {
        header("Location: client_print.php?message=deleted");
        exit();
    } else {
        echo "Error deleting client: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "No client ID provided.";
}
?>
