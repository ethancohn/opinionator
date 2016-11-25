<?php

	$server = 'localhost';
	$username = 'root';
	$password = 'root';
	$database = 'users_database';

	try {
		$conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
	} 
	catch (PDOException $e) {
		die("Connection to database failed." . $e->getMessage());
	}

