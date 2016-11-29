
<?php
require 'database.php';
session_start();

$username = $_SESSION['username'];

if(!isset($_SESSION['user_id'])) { //if not yet logged in
   header("Location: index.php");// send to login page
   exit;
} 
 $con = mysqli_connect("localhost", "root", "spurs", "opinionator_database");
              if (mysqli_connect_errno()) {
                printf("Connect failed: %s\n", mysqli_connect_error());
                exit();
              }

$que = "SELECT * FROM messages where convo_id=5";

$r = mysqli_query($con, $que);
$row = mysqli_fetch_assoc($r);
$topic = $row['convo_name'];
$convo_id = $row['convo_id'];

if(isset($_POST['submit'])) {
    
    $comment = $_POST['comment'];

    $sql = "INSERT INTO messages (convo_id, convo_name, username, msg_body) VALUES (:convo_id, :convo_name, :username, :msg_body)";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':convo_id', $convo_id, PDO::PARAM_INT);
    $stmt->bindParam(':convo_name', $topic, PDO::PARAM_STR);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':msg_body', $comment, PDO::PARAM_STR);
    
    
    $stmt->execute();
            
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Opinion message box</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/reply.css">
    <link rel="stylesheet" href="bootstrap-4.0.0/css/bootstrap.css">
     
</head>
<body>



<nav class="navbar navbar-light bg-faded">
  <ul class="nav navbar-nav">
     
    <li class="nav-item active">
      <a class="nav-link" href="./home.php">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="./profile.php"> <?php echo $username ?>  </a>
    </li>
    <li class="nav-item float-sm-right">
      <a class="nav-link" href="./index.php">Logout</a>
    </li>
  </ul>
</nav>





<div class="row">
  <div class="col-sm-8 offset-sm-2">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h2 class="top">
            <?php 
              echo "$topic";
            ?>
          </h2>
          <button class="btn top"><i class="fa fa-plus-square-o fa-3x" aria-hidden="true"></i></button>
        </div>

        <div id="dummy">
          <div class="panel-body" id="messages"> 

           <?php
              $query = "SELECT * FROM messages where convo_id=5";

              $res = mysqli_query($con, $query);
              if ( false===$result ) {
                printf("error: %s\n", mysqli_error($con));
              }
              else {
                $results=array();
                while($row = mysqli_fetch_assoc($res)){
                    $results['object_name'][] = $row;
                    $user = $row['username'];
                    $msg = $row['msg_body'];
                    echo "<div class='card'>
                      <div class='media'>
                        <div class='media-left media-top'>
                        <a href='#profile'>
                          <h4 class='media-object' style='text-align:center;'>$user</h4>
                        </a>
                        <a class='muser'>
                            <img src='avatar.png' class='media-object' style='width:100px'>
                        </a>
                        </div>
                        <div class='media-body'>
                          <h4 class='media-header'><small><i>date</i></small></h4>        
                          <p>$msg</p>
                        </div>
                    </div>
                    </div>";
                }
                
              }
            ?>
          
          </div>
        </div>
        <div class="panel-footer">
          <form action="reply.php" method="post">
            <div class="form-group">
            <textarea class="form-control" placeholder="Write a reply" rows="3" name="comment" id="comment"></textarea>
            </div>
            <div class="div col-sm-6">
              <div class="checkbox" data-toggle="buttons">
                <label class="btn btn-primary active">
                <input type="checkbox" checked autocomplete="off"> Follow </input>
                </label>
              </div>
            </div>

            <div class="div col-sm-6">
              <div class="submit">
                <input id="submit" type="submit" name="submit" class="btn btn-default" value="Reply" style="align-content: right">
              </div>
             </div>
            </form>
        </div>
      </div>
  </div>
</div>

<!-- only stuff related to threads is removed -->
<!-- Scripts start here -->

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <!--<script src="/socket.io/socket.io.js"></script>-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>


<script type="text/javascript">

/*
function showmsg(msgid){
  //gets as input the message id
  //fetch from sql (msgs), get the id of the user
  var userid=msgid;
  //fetch from sql (users) get his name.
  var username="user";
  //fetch from msg sql, get date
  var date="date";
  //fetch from mesg sql, get text
  var txt="Wise Text";

  //creates the post string:
  //as you can see, it is the equivalent of the "card div" place holder from the message section
  var tnhtml=`<div class="card">
          <div class="media">
            <div class="media-left media-top">
            <a href="#profile">
              <h4 class="media-object" style="text-align:center;">`+username+`</h4>
            </a>
            <a class="muser">
                <img src="avatar.png" class="media-object" style="width:100px">
            </a>
            </div>
            <div class="media-body">
            <h4 class="media-header"><small><i>`+date+`</i></small></h4>        
              <p>`+txt+`</p>
          </div>
        </div>`;
  //add to messages, it simply adds that string to the inner html of the message section
  addtomessages(tnhtml);

}*/
</script>
<script>
/*
//stuff for the pop up that no longer works when hovering user pictures
$(document).ready(function(){
    $('.muser').popover({title: "Username", content: "Country<br>About me<br><a href=#profile>View Profile</a>", html: true, placement: "right", trigger:"hover click"}); 
});
</script>
<script type="text/javascript">
/*
//these simply add to the inner html the content give.
//the clear versions erase everything
  function addtomessages(msg){
    var theDiv = document.getElementById("messages");
    theDiv.innerHTML += msg; 
  }
  function clearmessages(){
    var theDiv = document.getElementById("messages");
    theDiv.innerHTML =""; 
  }


</script>
    <script src="/socket.io/socket.io.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.1.js"></script>
<script>
/*
This is where everything gets initiated.
its all kind of useless because it was for test purposes.

*/
/*
var allData;
var convoArray=[];//threads
var msgArray=[];//messages in the thread, empty at first.
//just to fill with messages
  for (i=0; i<3; i+=1){
    //alert(i)
      showmsg(i);
    }
/*      var socket = io();
      //not used from tut
      $('form').submit(function(){
        socket.emit('chat message', $('#m').val());
        $('#m').val('');
        return false;
      });
      //not used from tut
      socket.on('chat message', function(msg){
        $('#messages').append($('<li>').text(msg));
        //$('#messages').append('<li>'+msg);
      });
      
      //Ask the socket to send data
      socket.emit('send data', "");

      //when we get data back
      socket.on('send data', function(vallData){
        allData=vallData;//store in global var
        
        var len=allData.length;
        for (i in allData){
          subData=allData[i].split(';');//get name of thread from first element (; separated)
          //wouldnt do that with sql stuff
          convoArray[i]=subData[0];
        }
        //remove place holder
        clearthreads();
        //create all threads
        for (i in convoArray){
          thlist(i);
        }
      });
      */

    </script>

    </body>
</html>
