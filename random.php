<?php
require 'database.php';
session_start();

$username = $_SESSION['username'];

if(!isset($_SESSION['user_id'])) { //if not yet logged in
   header("Location: index.php");// send to login page
   exit;
} 



echo json_encode($results);
header("Location: reply.php");


?>