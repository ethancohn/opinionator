<?php
	$server = 'localhost';
	$username = 'root';
	$password = 'spurs';
	$database = 'opinionator_database';
	try {
		$conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
		$con = mysqli_connect("localhost", "root", "spurs", "opinionator_database");
              if (mysqli_connect_errno()) {
                printf("Connect failed: %s\n", mysqli_connect_error());
                exit();
              }
	} 
	catch (PDOException $e) {
		die("Connection to database failed." . $e->getMessage());
	}


