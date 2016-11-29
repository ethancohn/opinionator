<?php

require 'database.php';
session_start();

$username = $_SESSION['username'];

if(!isset($_SESSION['user_id'])) { //if not yet logged in
   header("Location: index.php");// send to login page
   exit;
} 


if(isset($_POST['submit'])) {
    $topic = $_POST['topic'];
    $message = $_POST['message'];

    $query = "SELECT * FROM messages";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $highest_id = $row['convo_id']+1;

    $sql = "INSERT INTO messages (convo_id, convo_name, username, msg_body) VALUES (:convo_id, :convo_name, :username, :msg_body)";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':convo_id', $highest_id, PDO::PARAM_INT);
    $stmt->bindParam(':convo_name', $topic, PDO::PARAM_STR);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':msg_body', $message, PDO::PARAM_STR);
    
    
    $stmt->execute();
            
}
function randomMsg() {

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
      <a class="nav-link" href="profile.php"> <?php echo $username ?>  </a>
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
                                <a href="#" class="icon fa-paper-plane-o" data-toggle="modal" data-target="#myModal"><span class="label">New Message</span></a>
                            </li>
                        </ul>
                        
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="jumbotron" id="receive">
                        <h1>I'm Feeling Lucky</h1>
                        <ul>
                            <li>
                                 <a href="./reply.php" class="icon fa-question"><span class="label">Receive</span></a>
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
                                <a href="messages.php" class="icon fa-envelope-o"><span class="label">Mailbox</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New Message</h4>
      </div>
      <div class="modal-body">

        <form action="home.php" method="post">
          <div class="form-group">
            <label for="title">Topic:</label>
            <input type="text" class="form-control" name="topic">
          </div>
          <div class="form-group">
            <label for="message">Message:</label>
            <textarea class="form-control" name="message" style="height: 150px"></textarea> 
          </div>
          <div class="checkbox">
            <label><input type="checkbox">Follow</label>
          </div>
          <button type="submit" name="submit" class="btn btn-default">Submit</button>
        </form>
      </div>
    </div>

  </div>
</div>
        </div>
    </div>
   





    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> <!-- for JQuery -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
 
</body>
</html>