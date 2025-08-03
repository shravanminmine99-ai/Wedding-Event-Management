<?php
$conn = new mysqli("localhost", "root", "", "WeddingEventDB");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM staff WHERE staff_id = $id");
    $row = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["staff_id"];
    $name = $_POST["name"];
    $role = $_POST["role"];
    $contact = $_POST["contact"];

    $sql = "UPDATE staff SET name='$name', role='$role', contact='$contact' WHERE staff_id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: print_staff.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Staff</title>
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

        input[type="text"] {
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
            padding: 10px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            width: 100%;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Staff ID: <?= $row['staff_id'] ?></h2>

    <form method="post">
        <input type="hidden" name="staff_id" value="<?= $row['staff_id'] ?>">

        <label>Name:</label>
        <input type="text" name="name" value="<?= $row['name'] ?>" required>

        <label>Role:</label>
        <input type="text" name="role" value="<?= $row['role'] ?>" required>

        <label>Contact:</label>
        <input type="text" name="contact" value="<?= $row['contact'] ?>" required>

        <input type="submit" value="Update Staff">
    </form>
</div>

</body>
</html>
