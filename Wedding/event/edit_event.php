<?php
include 'db_connect.php';

if (!isset($_GET['id'])) {
    die("No event ID specified.");
}

$id = $_GET['id'];
$sql = "SELECT * FROM events WHERE event_id = $id";
$result = mysqli_query($conn, $sql);
$event = mysqli_fetch_assoc($result);

if (!$event) {
    die("Event not found.");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Event</title>
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
    input[type="date"],
    input[type="time"] {
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
    <h2>Edit Event ID: <?php echo $event['event_id']; ?></h2>

    <form action="update_event.php" method="POST">
      <input type="hidden" name="event_id" value="<?php echo $event['event_id']; ?>">

      <label>Client ID:</label>
      <input type="text" name="client_id" value="<?php echo $event['client_id']; ?>" required>

      <label>Event Name:</label>
      <input type="text" name="event_name" value="<?php echo $event['event_name']; ?>" required>

      <label>Event Date:</label>
      <input type="date" name="event_date" value="<?php echo $event['event_date']; ?>" required>

      <label>Start Time:</label>
      <input type="time" name="start_time" value="<?php echo $event['start_time']; ?>" required>

      <label>End Time:</label>
      <input type="time" name="end_time" value="<?php echo $event['end_time']; ?>" required>

      <label>Venue ID:</label>
      <input type="text" name="venue_id" value="<?php echo $event['venue_id']; ?>" required>

      <label>Status:</label>
      <input type="text" name="status" value="<?php echo $event['status']; ?>" required>

      <input type="submit" value="Update Event">
    </form>
  </div>

</body>
</html>
