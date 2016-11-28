<?php

session_start();

if(!isset($_SESSION['user_id'])) { //if not yet logged in
   header("Location: index.php");// send to login page
   exit;
} 


?>

<!DOCTYPE html>
<html>
<head>
	<title>Opinionator</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">  <!-- width of screen and initial scale is just regular zoom-->
   

    <!-- custom css -->
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/styles.css">
     <link rel="stylesheet" href="bootstrap-4.0.0/css/bootstrap.css">
</head>
<body>
<!--
    <header>
        <h4>John Doe</h4>
        <!-- setting icon. font awesome
    </header> -->
    <nav class="navbar navbar-light bg-faded">
  <ul class="nav navbar-nav">
     
    <li class="nav-item active">
      <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/user.php">Profile</a>
    </li>
    <li class="nav-item float-xs-right">
      <a class="nav-link" href="index.php">Logout</a>
    </li>
  </ul>
</nav>

    <div class="content">

        <a class="link link--nukun" href="#">Op<span>ini</span>on</a>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 ">
                    <div class="jumbotron" id="msg">
                        <h1>New Message</h1>
                        <ul>
                            <li>
                                <a href="#" class="icon fa-paper-plane-o"><span class="label">New Message</span></a>
                            </li>
                        </ul>
                        
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="jumbotron" id="receive">
                        <h1>I'm Feeling Lucky</h1>
                        <ul>
                            <li>
                                 <a href="#" class="icon fa-question"><span class="label">Receive</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                      <div class="jumbotron" id="mailbox">
                        <h1>Mailbox</h1>
                        <ul>
                            <li>
                                <a href="#" class="icon fa-envelope-o"><span class="label">Mailbox</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
   





    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> <!-- for JQuery -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
 
</body>
</html>