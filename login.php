<?php

	require 'database.php';

	session_start();

	if( isset($_SESSION['user_id']) ){
		header("Location: /");
	}

	if (!empty($_POST['username']) && !empty($_POST['password']))

		$records = $conn->prepare('SELECT id,email,password FROM users WHERE username = :username');
		$records->bindParam(':username', $_POST['username']);
		$records->execute();
		$results = $records->fetch(PDO::FETCH_ASSOC);

		$message = '';

		if(count($results) > 0 && password_verify($_POST['password'], $results['password']) ){

			$_SESSION['user_id'] = $results['id'];
			header("Location: /");

		} else {
			$message = 'Sorry, those credentials do not match';
		}

	endif;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Opinionator Login</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>

	<?php if(!empty($message)): ?>
		<p><?= $message ?></p>
	<?php endif; ?>

	<h1>Login</h1> <br>

	<form action="login.php" method="POST">
		
		<input type="text" placeholder="username" name="username">
		<input type="password" placeholder="password" name="password">
		<input type="submit">
	</form>
</body>
</html>