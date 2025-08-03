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

$sql = "SELECT venue_id, venue_name, location, capacity, cost FROM Venues";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Venues List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef2f5;
            padding: 40px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
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
            padding: 14px;
        }

        thead {
            background-color: #2c3e50;
            color: white;
        }

        tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tbody tr:hover {
            background-color: #e1f0ff;
        }

        a {
            text-decoration: none;
            padding: 6px 10px;
            border-radius: 4px;
            font-size: 14px;
            color: white;
        }

        a.edit {
            background-color: #27ae60;
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

<h2>Venue Management</h2>

<table id="userTable">
    <thead>
        <tr>
            <th>#</th>
            <th>Venue_ID</th>
            <th>Venue_Name</th>
            <th>Location</th>
            <th>Capacity</th>
            <th>Cost</th>
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
                        <td>" . $row["venue_id"] . "</td>
                        <td>" . $row["venue_name"] . "</td>
                        <td>" . $row["location"] . "</td>
                        <td>" . $row["capacity"] . "</td>
                        <td>$" . number_format($row["cost"], 2) . "</td>
                        <td class='actions'>
                            <a class='edit' href='edit_venue.php?id=" . $row["venue_id"] . "'>Edit</a>
                            <a class='delete' href='delete_venue.php?id=" . $row["venue_id"] . "' onclick=\"return confirm('Are you sure you want to delete this venue?');\">Delete</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No venues found</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php $conn->close(); ?>
</body>
</html>
