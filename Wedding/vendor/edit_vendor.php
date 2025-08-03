<?php
$conn = new mysqli("localhost", "root", "", "WeddingEventDB");

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM Vendors WHERE vendor_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
} else {
    die("Invalid vendor ID.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Vendor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow p-4">
        <h2 class="mb-4">Edit Vendor</h2>
        <form action="update_vendor.php" method="post">
            <input type="hidden" name="vendor_id" value="<?= htmlspecialchars($row['vendor_id']) ?>">

            <div class="mb-3">
                <label class="form-label">Vendor Name</label>
                <input type="text" class="form-control" name="vendor_name" value="<?= htmlspecialchars($row['vendor_name']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Service Type</label>
                <input type="text" class="form-control" name="service_type" value="<?= htmlspecialchars($row['service_type']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Contact Name</label>
                <input type="text" class="form-control" name="contact_name" value="<?= htmlspecialchars($row['contact_name']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" class="form-control" name="phone" value="<?= htmlspecialchars($row['phone']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($row['email']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Cost Estimate</label>
                <input type="number" step="0.01" class="form-control" name="cost_estimate" value="<?= htmlspecialchars($row['cost_estimate']) ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Vendor</button>
            <a href="vendor_form.html" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
</body>
</html>
