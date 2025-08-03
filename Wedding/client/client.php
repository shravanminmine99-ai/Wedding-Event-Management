<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Wedding Client Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: linear-gradient(to right,#020024 0%,#090979 35%,#00D4FF 100%);
            padding: 40px;
        }
        .container {
            max-width: 500px;
            background: #fff;
            padding: 25px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin: 15px 0 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="email"], textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #bbb;
            border-radius: 5px;
            box-sizing: border-box;
        }
        textarea {
            resize: vertical;
        }
        input[type="submit"] {
            background: #28a745;
            color: white;
            padding: 12px 20px;
            border: none;
            margin-top: 20px;
            cursor: pointer;
            border-radius: 5px;
            width: 100%;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background: #218838;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Client Registration Form</h2>
    <form action="insert_client.php" method="POST">
        <label for="bride_name">Bride's Name:</label>
        <input type="text" id="bride_name" name="bride_name" required>

        <label for="groom_name">Groom's Name:</label>
        <input type="text" id="groom_name" name="groom_name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required>

        <label for="address">Address:</label>
        <textarea id="address" name="address" rows="4" required></textarea>

        <input type="submit" value="Register Client">
    </form>
</div>

</body>
</html>
