<?php
	$server = 'localhost';
	$username = 'root';
<<<<<<< HEAD
	$password = 'root';
	$database = 'opinionator_database';
	try {
		$conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
		$con = mysqli_connect("localhost", "root", "root", "opinionator_database");
=======
	$password = '';
	$database = 'opinionator_database';
	try {
		$conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
		$con = mysqli_connect("localhost", "root", "", "opinionator_database");
>>>>>>> f34b81f23b875f003333ff91593658e4d817a542
              if (mysqli_connect_errno()) {
                printf("Connect failed: %s\n", mysqli_connect_error());
                exit();
              }
	} 
	catch (PDOException $e) {
		die("Connection to database failed." . $e->getMessage());
	}


