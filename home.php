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
    
    $query = "SELECT MAX(convo_id) as max FROM messages";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $highest_id = $row['max']+1;

    if($_POST['follow'] == '1'){
        $q = "INSERT INTO convos_following (username, convo_id, date_) VALUES (:username, :convo_id, NOW())";
        $stm = $conn->prepare($q);

         $stm->bindParam(':convo_id', $highest_id, PDO::PARAM_INT);
         $stm->bindParam(':username', $username, PDO::PARAM_STR);

         $stm->execute();
    }

    $post = "UPDATE users SET post_count=post_count+1 WHERE username='$username'";
    mysqli_query($con, $post);

    $sql = "INSERT INTO messages (convo_id, convo_name, username, msg_body, date_, upvote) VALUES (:convo_id, :convo_name, :username, :msg_body, NOW(), 0)";
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
    
     <link rel="stylesheet" href="bootstrap-4.0.0/css/bootstrap.css">
     <link rel="stylesheet" href="css/styles.css">
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
      <a class="nav-link" href="./home.php">Home <span class="sr-only">(current)</span></a>
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

        <a class="link link--nukun" href="home.php">Op<span>ini</span>on</a>
                         
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

                            <form action="reply.php" method="post">
                                <a href="javascript:;" onclick="parentNode.submit();" class="icon fa-question"><span class="label">Receive</span></a>
                                <input type="hidden" name="catch" />
                            </form>
                                 
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
                             
                                <form action="messages.php" method="post">
                                <a href="javascript:;" onclick="parentNode.submit();" class="icon fa-envelope-o"><span class="label">Inbox</span></a>
                                <input type="hidden" name="firstconvo" />
                            </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New Message</h4>
      </div>
      <div class="modal-body">

        <form action="home.php" method="post">
          <div class="form-group">
            <label for="topic">Topic</label>
            <input type="text" class="form-control" id="topic" name="topic">
          </div>
          <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control" id="message" name="message" rows="5" style="height: 120px"></textarea> 
          </div>
          <div class="form-check">
            <label class="custom-control custom-checkbox">
                <input type="hidden" name="follow" value="0">
                <input type="checkbox" name="follow" value="1" class="custom-control-input" checked="true" />
                
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description"> Follow</span>
            </label>
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