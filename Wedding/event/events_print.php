<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "WeddingEventDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); 
}

$sql = "SELECT event_id, client_id, event_name, event_date, start_time, end_time, venue_id, status FROM events";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Events List</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <style>
        .action-btn {
            padding: 6px 10px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            margin-right: 5px;
        }

        .edit-btn {
            background-color: #1976d2;
            color: white;
        }

        .edit-btn:hover {
            background-color: #1565c0;
        }

        .delete-btn {
            background-color: #d32f2f;
            color: white;
        }

        .delete-btn:hover {
            background-color: #c62828;
        }
    </style>
</head>
<body>

<h2>Event Management</h2>

<table id="userTable" class="display">
    <thead>
        <tr>
            <th>Event_ID</th>
            <th>Client_ID</th>
            <th>Event_Name</th>
            <th>Event_Date</th>
            <th>Start_Time</th>
            <th>End_Time</th>
            <th>Venue_ID</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row["event_id"]}</td>
                        <td>{$row["client_id"]}</td>
                        <td>{$row["event_name"]}</td>
                        <td>{$row["event_date"]}</td>
                        <td>{$row["start_time"]}</td>
                        <td>{$row["end_time"]}</td>
                        <td>{$row["venue_id"]}</td>
                        <td>{$row["status"]}</td>
                        <td>
    <a class='action-btn edit-btn' href='edit_event.php?id={$row["event_id"]}'>Edit</a>
    <button class='action-btn delete-btn' onclick='deleteEvent({$row["event_id"]})'>Delete</button>
</td>
                      </tr>";
            }
        }
        ?>
    </tbody>
</table>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#userTable').DataTable();
    });

    function deleteEvent(eventId) {
        if (confirm("Are you sure you want to delete this event?")) {
            $.ajax({
                url: 'delete_event.php',
                type: 'POST',
                data: { id: eventId },
                success: function(response) {
                    alert(response);
                    location.reload(); // refresh table
                },
                error: function() {
                    alert("Error deleting event.");
                }
            });
        }
    }
</script>

</body>
</html>

<?php $conn->close(); ?>
