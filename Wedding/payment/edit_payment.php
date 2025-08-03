<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "WeddingEventDB";

$conn = new mysqli($servername, $username, $password, $database);
if (!isset($_GET['id'])) {
    die("No payment ID specified.");
}

$id = $_GET['id'];
$sql = "SELECT * FROM Payments WHERE payment_id = $id";
$result = mysqli_query($conn, $sql);
$payment = mysqli_fetch_assoc($result);

if (!$payment) {
    die("Payment not found.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $payment_id = $_POST["payment_id"];
    $client_id = $_POST["client_id"];
    $amount_paid = $_POST["amount_paid"];
    $payment_date = $_POST["payment_date"];
    $payment_method = $_POST["payment_method"];
    $remarks = $_POST["remarks"];

    $update_sql = "UPDATE Payments SET 
        client_id = '$client_id',
        amount_paid = '$amount_paid',
        payment_date = '$payment_date',
        payment_method = '$payment_method',
        remarks = '$remarks'
        WHERE payment_id = $payment_id";

    if (mysqli_query($conn, $update_sql)) {
        header("Location: print_payments.php");
        exit();
    } else {
        echo "Error updating payment: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Payment</title>
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
    input[type="date"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 16px;
    }

    input[type="submit"] {
      background-color: #007bff;
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
      background-color: #0056b3;
    }
  </style>
</head>
<body>

  <div class="container">
    <h2>Edit Payment ID: <?php echo $payment['payment_id']; ?></h2>

    <form method="POST" action="edit_payment.php?id=<?php echo $payment['payment_id']; ?>">
      <input type="hidden" name="payment_id" value="<?php echo $payment['payment_id']; ?>">

      <label>Client ID:</label>
      <input type="text" name="client_id" value="<?php echo $payment['client_id']; ?>" required>

      <label>Amount Paid:</label>
      <input type="text" name="amount_paid" value="<?php echo $payment['amount_paid']; ?>" required>

      <label>Payment Date:</label>
      <input type="date" name="payment_date" value="<?php echo $payment['payment_date']; ?>" required>

      <label>Payment Method:</label>
      <input type="text" name="payment_method" value="<?php echo $payment['payment_method']; ?>" required>

      <label>Remarks:</label>
      <input type="text" name="remarks" value="<?php echo $payment['remarks']; ?>">

      <input type="submit" value="Update Payment">
    </form>
  </div>

</body>
</html>
