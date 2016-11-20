<?php
	if (!empty($_POST['username','password'])) {
		
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Opinionator Login</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
	<h1>Login</h1> <br>

	<form action="login.php" method="POST">
		
		<input type="text" placeholder="username" name="username">
		<input type="password" placeholder="password" name="password">
		<input type="submit">
	</form>
</body>
</html>