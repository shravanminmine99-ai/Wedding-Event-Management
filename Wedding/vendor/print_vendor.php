<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "WeddingEventDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT vendor_id, vendor_name, service_type, contact_name, phone, email, cost_estimate FROM Vendors";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vendors List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f6fa;
            padding: 40px;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #2c3e50;
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
            padding: 12px 15px;
        }

        thead {
            background-color: #2c3e50;
            color: #fff;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #ecf3f9;
        }

        a {
            text-decoration: none;
            padding: 6px 10px;
            border-radius: 4px;
            font-size: 14px;
            color: #fff;
        }

        a.edit {
            background-color: #27ae60;
        }

        a.delete {
            background-color: #e74c3c;
        }

        .actions {
            display: flex;
            gap: 6px;
        }
    </style>
</head>
<body>

<h2>Vendors Directory</h2>

<table id="userTable">
    <thead>
        <tr>
            <th>#</th>
            <th>Vendor_ID</th>
            <th>Vendor_Name</th>
            <th>Service_Type</th>
            <th>Contact_Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Cost_Estimate</th>
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
                        <td>" . $row["vendor_id"] . "</td>
                        <td>" . $row["vendor_name"] . "</td>
                        <td>" . $row["service_type"] . "</td>
                        <td>" . $row["contact_name"] . "</td>
                        <td>" . $row["phone"] . "</td>
                        <td>" . $row["email"] . "</td>
                        <td>$" . number_format($row["cost_estimate"], 2) . "</td>
                        <td class='actions'>
                            <a class='edit' href='edit_vendor.php?id=" . $row["vendor_id"] . "'>Edit</a>
                            <a class='delete' href='delete_vendor.php?id=" . $row["vendor_id"] . "' onclick=\"return confirm('Are you sure you want to delete this vendor?');\">Delete</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No vendors found</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php $conn->close(); ?>
</body>
</html>
