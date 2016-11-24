<?php


	session_start();

	if( isset($_SESSION['user_id']) ){
		header("Location: /");
	}

	require 'database.php';

	$message = '';

	if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email']) && !empty($_POST['country'])):

		$sql = "INSERT INTO users (username, password, email, country) VALUES (:email, :password)";
		$statement = $connection->prepare($sql);
		
		$statement->bindParam(':username', $_POST['username']);
		$statement->bindParam(':password', password_hash$_POST(['password'], PASSWORD_BCRYPT));
		$statement->bindParam(':email', $_POST['email']);
		$statement->bindParam(':country', $_POST['country']);

		if ($statement->execute()) {
			$message = 'User created.';
		}
		else {
			$message = 'User creation failed.';
		}
	endif;
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