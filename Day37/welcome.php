<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	Hello
	<?php 
	session_start();
	echo  $_SESSION['login_user'];
	?>
</body>
</html>