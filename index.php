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
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="bootstrap-4.0.0/css/bootstrap.css">
</head>
<body>

	<div class="content">

        <a class="link link--nukun" href="#">Op<span>ini</span>on</a>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 ">
                    <div class="jumbotron" id="msg">
                        <h1>Login</h1>
                        <form action="index.php" method="POST">
							<input type="text" placeholder="username" name="username"> <br>
							<input type="password" placeholder="password" name="password"> <br><br>
							<input type="submit" name="submit"> <br><br>
						</form>
                        <?php
                       if ( isset($message) ) { ?>
                            <p><?= $message ?></p>
                        <?php } ?>
						or <a href="register.php">Register</a>
                    </div>
                     
                </div>
                
            </div>       
        </div>
    </div>

</body>
</html>