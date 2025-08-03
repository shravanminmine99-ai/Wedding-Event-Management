<?php
$conn = new mysqli("localhost", "root", "", "WeddingEventDB");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM Venues WHERE venue_id = $id");
    $row = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["venue_id"];
    $venue_name = $_POST["venue_name"];
    $location = $_POST["location"];
    $capacity = $_POST["capacity"];
    $cost = $_POST["cost"];

    $sql = "UPDATE Venues SET 
                venue_name='$venue_name',
                location='$location',
                capacity='$capacity',
                cost='$cost'
            WHERE venue_id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: venue_print.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Venue</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            padding: 50px;
        }

        .container {
            max-width: 500px;
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
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            width: 100%;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Venue ID: <?= $row['venue_id'] ?></h2>

    <form method="post">
        <input type="hidden" name="venue_id" value="<?= $row['venue_id'] ?>">

        <label>Venue Name:</label>
        <input type="text" name="venue_name" value="<?= $row['venue_name'] ?>" required>

        <label>Location:</label>
        <input type="text" name="location" value="<?= $row['location'] ?>" required>

        <label>Capacity:</label>
        <input type="number" name="capacity" value="<?= $row['capacity'] ?>" required>

        <label>Cost:</label>
        <input type="number" step="0.01" name="cost" value="<?= $row['cost'] ?>" required>

        <input type="submit" value="Update Venue">
    </form>
</div>

</body>
</html>
