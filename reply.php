
<?php
require 'database.php';
session_start();

$username = $_SESSION['username'];

if(!isset($_SESSION['user_id'])) { //if not yet logged in
   header("Location: index.php");// send to login page
   exit;
} 
if(isset($_POST['catch'])) { //display a new thread
    $query = "SELECT MAX(convo_id) as max FROM messages";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $max = $row['max'];

    $convo_id= rand(1, $max );
 

    $que = "SELECT * FROM messages where convo_id=$convo_id";

    $r = mysqli_query($con, $que);
    $row = mysqli_fetch_assoc($r);
    $topic = $row['convo_name'];
 
}
if(isset($_POST['submit'])) { //Adding new comment
    
      $comment = $_POST['comment'];
      $convo_id = $_POST['prev'];
      $que = "SELECT * FROM messages where convo_id=$convo_id";

      $r = mysqli_query($con, $que);
      $row = mysqli_fetch_assoc($r);
      $topic = $row['convo_name'];

    if($_POST['follow'] == '1'){
        $q = "INSERT INTO convos_following (username, convo_id, date_)
         SELECT * FROM  (SELECT '$username', $convo_id, NOW()) AS tmp
        WHERE NOT EXISTS (
          SELECT * FROM convos_following WHERE username = '$username' and convo_id=$convo_id
        ) LIMIT 1";
        mysqli_query($con, $q);
    }
    if(!empty($comment)){

      $post = "UPDATE users SET post_count=post_count+1 WHERE username='$username'";
      mysqli_query($con, $post);
      
      $time = "UPDATE convos_following SET date_=NOW() WHERE convo_id=$convo_id";
      mysqli_query($con, $time);

      $sql = "INSERT INTO messages (convo_id, convo_name, username, msg_body, date_, upvote) VALUES (:convo_id, :convo_name, :username, :msg_body, NOW(), 0)";
      $stmt = $conn->prepare($sql);

      $stmt->bindParam(':convo_id', $convo_id, PDO::PARAM_INT);
      $stmt->bindParam(':convo_name', $topic, PDO::PARAM_STR);
      $stmt->bindParam(':username', $username, PDO::PARAM_STR);
      $stmt->bindParam(':msg_body', $comment, PDO::PARAM_STR);
      
      
      $stmt->execute();
    }
            
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



<nav class="navbar navbar-light bg-faded navbar-fixed-top">
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
          <form action="reply.php" method="post">
            <button name="catch" class="btn top"><i class="fa fa-plus-square-o fa-3x" aria-hidden="true"></i></button>
          </form>
        </div>

        <div id="dummy">
          <div class="panel-body" id="messages"> 

           <?php
              $query = "SELECT * FROM messages where convo_id=$convo_id";

              $res = mysqli_query($con, $query);
              if ( false===$res ) {
                printf("error: %s\n", mysqli_error($con));
              }
              else {
                $results=array();
                while($row = mysqli_fetch_assoc($res)){
                    $results['object_name'][] = $row;
                    $user = $row['username'];
                    $msg = $row['msg_body'];
                    $date = $row['date_'];
                    $avatar = "";
                    //GET THE AVATAR
                      $query = "SELECT * FROM users where username='$user'";
                      $r = mysqli_query($con, $query);
                      if($r == false){
                        echo "ERROR SHAME ON YOU! HOPE ITS NOT ON THE LIVE DEMO.";
                      }else{
                        $row = mysqli_fetch_assoc($r);
                        $avatar =$row['avatar'];
                        $country = $row['country'];
                        //$notif =$row['notif'];
                      }

                    
						        list($time, $pass) = explode(".", $date);
                    echo "<div class='card'>
                      <div class='media'>
                        <div class='media-left media-top' style='max-width: 120px;'>
                          <form action='./profile.php' method='post'> 
                            <input type='hidden' name='username' value=$user>
                            
                            <a href='javascript:;' onclick='parentNode.submit();'> 
                                <h5 class='media-object' style='text-align:center;word-wrap: break-word;'>$user</h5>
                             </a>
                          </form>

                        <a class='muser'>
                            <!--<img src='avatar.png' class='media-object' style='width:100px'>-->
                                      <object data='$avatar' type='image/jpg' style='width:100px;max-height: 100px;'>
                                        <img src='img/default/avatar.png' class='media-object' style='width:100px;'/>
                                      </object>
                        </a>
                        </div>
                        <div class='media-body'>
                          <h6 class='media-header'><small>$time</small><small style='float: right;'>$country</small></h6>        
                          <h5>$msg</h5>
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
            <?php 
        $exist = "SELECT * FROM messages WHERE username = '$username' and convo_id=$convo_id";
        if(@mysqli_num_rows(mysqli_query($con, $exist))==0){
          echo"
          <div class='form-group'>
          <textarea class='form-control' placeholder='Write a reply' rows='3' name='comment' id='comment'></textarea>
          </div>";
        }
            ?>
            <div class="div col-sm-6">
              <label class="custom-control custom-checkbox">
                <input type="hidden" name="follow" value="0">
                <input type="checkbox" name="follow" value="1" class="custom-control-input" />
                
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description"> Follow</span>
            </label>
            </div>
            <input type="hidden" name="prev" value="<?php echo $convo_id; ?>" >
            <input type="hidden" name="prevtop" value="<?php echo $topic; ?>" >
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

</script>



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
