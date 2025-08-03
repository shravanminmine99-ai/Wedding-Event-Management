
<html>
<head>
    <title> Registration Form</title>
    <head>
   <title>Login Page</title>
   <style type = "text/css">
      body {
         font-family:Arial, Helvetica, sans-serif;
         font-size:14px;
      }
      label {
         font-weight:bold;
         width:100px;
         font-size:14px;
      }
      .box {
         border:#666666 solid 1px;
      }
   </style>
</head>
</head>
<body style="text-align: center;">
    <h2>Registration Form</h2>
    <form action="data.php" method="GET">
        <label >Full Name:</label><br>
        <input type="text"  name="name" required><br><br>

        <label for="adhaar">Adhaar:</label><br>
        <input type="num"  name="adhaar" required><br><br>

         <label for="phone">Phone:</label><br>
        <input type="tel"  name="number" required><br><br>

         <label>Gender:</label><br>
        <input type="radio" name="gender" value="Male" required> Male<br>
        <input type="radio" name="gender" value="Female"> Female<br><br>

        <label for="email">Email</label><br>
        <input type="email" name="email" required><br><br>


        <input type="submit" value="Submit">
    </form>
</body>
</html>
