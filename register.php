<?php

	require 'database.php';

	$message = '';

	if (!empty($_POST['username']) && !empty($_POST['password'])) {

		$sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
		$stmt = $connection->prepare($sql);
		
		$stmt->bindParam(':username', $_POST['username']);
		$stmt->bindParam(':password', password_hash($_POST['password'], PASSWORD_BCRYPT));

		if ($stmt->execute()) {
			$message = "Created new user.";
		}
		else {
			$message = "Failed to create new user.";
		}
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

	<?php if(!empty($message)): ?>
		<p><?= $message ?></p>
	<?php endif; ?>

	
	<form action="register.php" method="POST">
		
		Username: <input type="text" placeholder="Username" name="username"> <br>
		Password: <input type="text" placeholder="Password" name="password"> <br>
		Confirm Password: <input type="text" placeholder="Confirm Password" name="confirm_password"> <br>
		Email: <input type="Email" placeholder="Email" name="email"> <br>
		Country: <input type="Country" placeholder="Select Country:" name="country"> <br>

		<input type="submit">
	</form>
</body>
</html>