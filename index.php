<?php

 session_start();

require 'database.php';

if( isset($_SESSION['user_id']) ){

	$records = $conn->prepare('SELECT id,email,password FROM users WHERE id = :id');
	$records->bindParam(':id', $_SESSION['user_id']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$user = NULL;

	if( count($results) > 0){
		$user = $results;
	}

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Opinionator</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>


	<h1>Welcome to Opinionator! </h1><br>
	<a href="login.php">Login </a> or 
	<a href="register.php">Register </a><br>


</body>
</html>