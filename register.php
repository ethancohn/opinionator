<?php
	if (!empty($_POST['username','password','email','country'])) {
		
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Opinionator Registration</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
	<h1>Create an Account</h1> <br>

	<form action="register.php" method="POST">
		
		Username: <input type="text" placeholder="username" name="username"> <br>
		Password: <input type="password" placeholder="password" name="password"> <br>
		Email: <input type="Email" name="email"> <br>
		Country: <input type="Country" name="country"> <br>

		<input type="submit">
	</form>

</body>
</html>