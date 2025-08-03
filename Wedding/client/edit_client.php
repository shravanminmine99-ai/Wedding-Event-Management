<?php
include 'db_connect.php';

if (!isset($_GET['id'])) {
    die("No client ID specified.");
}

$id = $_GET['id'];
$sql = "SELECT * FROM Clients WHERE client_id = $id";
$result = mysqli_query($conn, $sql);
$client = mysqli_fetch_assoc($result);

if (!$client) {
    die("Client not found.");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Client</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f6f9;
      padding: 50px;
    }

    .container {
      max-width: 600px;
      margin: auto;
      background-color: #ffffff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      color: #333;
      margin-bottom: 25px;
    }

    label {
      display: block;
      margin-bottom: 6px;
      color: #555;
      font-weight: bold;
    }

    input[type="text"],
    input[type="email"],
    textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 16px;
    }

    textarea {
      height: 80px;
      resize: vertical;
    }

    input[type="submit"] {
      background-color: #28a745;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      display: block;
      width: 100%;
    }

    input[type="submit"]:hover {
      background-color: #218838;
    }
  </style>
</head>
<body>

  <div class="container">
    <h2>Edit Client ID: <?php echo $client['client_id']; ?></h2>

    <form action="update_client.php" method="POST">
      <input type="hidden" name="client_id" value="<?php echo $client['client_id']; ?>">

      <label>Bride Name:</label>
      <input type="text" name="bride_name" value="<?php echo $client['bride_name']; ?>" required>

      <label>Groom Name:</label>
      <input type="text" name="groom_name" value="<?php echo $client['groom_name']; ?>" required>

      <label>Email:</label>
      <input type="email" name="email" value="<?php echo $client['email']; ?>" required>

      <label>Phone:</label>
      <input type="text" name="phone" value="<?php echo $client['phone']; ?>" required>

      <label>Address:</label>
      <textarea name="address" required><?php echo $client['address']; ?></textarea>

      <input type="submit" value="Update Client">
    </form>
  </div>

</body>
</html>
