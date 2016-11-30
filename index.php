<?php

    require 'database.php';

    session_start();
    if( isset($_SESSION['user_id']) ){
        session_unset();
        session_destroy();
    }

    $error = false;
    $message = '';

    if (isset($_POST['submit'])) {
        if (empty($_POST['username']) || empty($_POST['password'])) {
            $error = true;
            $message = "Please fill out all fields.";
        } 

        if (!$error) {

            $query = 'SELECT user_id,username,password FROM users WHERE username = :username';
            $records = $conn->prepare($query);
            $records->bindParam(':username', $_POST['username']);
            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);

            if(count($results) > 0 && $_POST['password']==$results['password']  ){

                $_SESSION['user_id'] = $results['user_id'];
                $_SESSION['username'] = $results['username'];
                header("Location: home.php");

                    exit;
            } else {
                    
                    $error = true;
                    $message = "Sorry, those credentials do not match.";
                }
            
        } 
    }     

    
        
?>


<!DOCTYPE html>
<html>
<head>
	<title>Opinionator</title>
	<link rel="stylesheet" href="css/reset.css">
    
    <link rel="stylesheet" href="bootstrap-4.0.0/css/bootstrap.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

	<div class="content">

        <a class="link link--nukun" href="#">Op<span>ini</span>on</a>
        <div class="container">
            <div class="row">
                <div class="col-sm-8 offset-sm-2 ">
                    <div class="jumbotron" id="log">
                        <h1>Login</h1>
                        <form action="index.php" method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Username" name="username"> 
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Password" name="password"> 
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block" name="submit">Login</button>
                            </div>
						</form>
                        <?php
                       if ( isset($message) ) { ?>
                            <p><?= $message ?></p>
                        <?php } ?>
						Don't have an account? <a id="signup" href="register.php">Register</a>
                    </div>
                     
                </div>
                
            </div>       
        </div>
    </div>

</body>
</html>