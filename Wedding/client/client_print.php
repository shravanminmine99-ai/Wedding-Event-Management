<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Clients Table</title>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f6f9;
    }

    h2 {
      text-align: center;
      margin-top: 30px;
    }

    .message {
      text-align: center;
      margin-top: 10px;
      padding: 10px;
      font-weight: bold;
    }

    .success {
      color: green;
    }

    .error {
      color: red;
    }

    table {
      width: 90%;
      margin: 30px auto;
    }

    .edit-button, .delete-button {
      padding: 6px 12px;
      color: white;
      border: none;
      border-radius: 4px;
      text-decoration: none;
      font-size: 14px;
    }

    .edit-button {
      background-color: #007bff;
    }

    .edit-button:hover {
      background-color: #0056b3;
    }

    .delete-button {
      background-color: #dc3545;
    }

    .delete-button:hover {
      background-color: #c82333;
    }
  </style>
</head>
<body>

<h2>Client Management</h2>

<!-- Alert Messages -->
<?php if (isset($_GET['message']) && $_GET['message'] === 'deleted'): ?>
  <p class="message success">✅ Client deleted successfully.</p>
<?php endif; ?>

<?php if (isset($_GET['error']) && $_GET['error'] === 'client_in_use'): ?>
  <p class="message error">❌ Cannot delete client: Payments exist for this client.</p>
<?php endif; ?>

<table id="clientsTable" class="display">
  <thead>
    <tr>
      <th>ID</th>
      <th>Bride Name</th>
      <th>Groom Name</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Address</th>
      <th>Created</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
  include 'db_connect.php';
  $sql = "SELECT * FROM Clients";
  $result = mysqli_query($conn, $sql);

  while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td>{$row['client_id']}</td>";
      echo "<td>{$row['bride_name']}</td>";
      echo "<td>{$row['groom_name']}</td>";
      echo "<td>{$row['email']}</td>";
      echo "<td>{$row['phone']}</td>";
      echo "<td>{$row['address']}</td>";
      echo "<td>{$row['created_at']}</td>";
      echo "<td>
              <a class='edit-button' href='edit_client.php?id={$row['client_id']}'>Edit</a>
              &nbsp;
              <a class='delete-button' href='delete_client.php?id={$row['client_id']}' onclick=\"return confirm('Are you sure you want to delete this client?');\">Delete</a>
            </td>";
      echo "</tr>";
  }

  mysqli_close($conn);
  ?>
  </tbody>
</table>

<script>
  $(document).ready(function () {
    $('#clientsTable').DataTable();
  });
</script>

</body>
</html>
