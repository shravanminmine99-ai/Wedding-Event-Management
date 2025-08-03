<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "WeddingEventDB";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT payment_id, client_id, amount_paid, payment_date, payment_method, remarks FROM Payments";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Records</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            padding: 40px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        th, td {
            text-align: left;
            padding: 14px;
        }
        thead {
            background-color: #2c3e50;
            color: white;
        }
        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tbody tr:hover {
            background-color: #e1ecf4;
        }
        a {
            text-decoration: none;
            padding: 6px 10px;
            border-radius: 4px;
            color: white;
            font-size: 14px;
        }
        a[href*="edit"] {
            background-color: #27ae60;
        }
        a[href*="delete"] {
            background-color: #e74c3c;
        }
    </style>
</head>
<body>

<h2>Payment Records</h2>

<table id="userTable">
    <thead>
        <tr>
            <th>#</th>
            <th>Payment_ID</th>
            <th>Client_ID</th>
            <th>Amount_Paid</th>
            <th>Payment_Date</th>
            <th>Payment_Method</th>
            <th>Remarks</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $counter = 1;
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $counter++ . "</td>
                        <td>" . $row["payment_id"] . "</td>
                        <td>" . $row["client_id"] . "</td>
                        <td>" . $row["amount_paid"] . "</td>
                        <td>" . $row["payment_date"] . "</td>
                        <td>" . $row["payment_method"] . "</td>
                        <td>" . $row["remarks"] . "</td>
                        <td>
                            <a href='edit_payment.php?id=" . $row["payment_id"] . "'>Edit</a>
                            <a href='delete_payment.php?id=" . $row["payment_id"] . "' onclick=\"return confirm('Are you sure you want to delete this payment?');\">Delete</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No records found</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>

<?php $conn->close(); ?>
