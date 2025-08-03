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

$sql = "SELECT staff_id, name, role, contact FROM staff";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Staff List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f4f8;
            padding: 40px;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
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
            background-color: #34495e;
            color: white;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #eaf2f8;
        }

        a {
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 14px;
            color: white;
        }

        a.edit {
            background-color: #2ecc71;
        }

        a.delete {
            background-color: #e74c3c;
        }

        .actions {
            display: flex;
            gap: 8px;
        }
    </style>
</head>
<body>

<h2>Staff Directory</h2>

<table id="userTable">
    <thead>
        <tr>
            <th>#</th>
            <th>Staff_ID</th>
            <th>Name</th>
            <th>Role</th>
            <th>Contact</th>
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
                        <td>" . $row["staff_id"] . "</td>
                        <td>" . $row["name"] . "</td>
                        <td>" . $row["role"] . "</td>
                        <td>" . $row["contact"] . "</td>
                        <td class='actions'>
                            <a class='edit' href='edit_staff.php?id=" . $row["staff_id"] . "'>Edit</a>
                            <a class='delete' href='delete_staff.php?id=" . $row["staff_id"] . "' onclick=\"return confirm('Are you sure you want to delete this staff member?');\">Delete</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No staff found</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php $conn->close(); ?>
</body>
</html>
