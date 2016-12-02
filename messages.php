<?php
require 'database.php';

session_start();

	/*$query = "SELECT convos_following FROM users WHERE user_id = :user_id";
	$stmt = $conn->prepare($query);
	$stmt->bindParam(':user_id', $_SESSION['user_id']);
	$convos = $stmt->execute();*/

	$username = $_SESSION['username'];

	if(isset($_POST['newconvo'])) {
		$id = $_POST['newconvo'];
		$que = "SELECT * FROM messages where convo_id=$id";	
	}

	if(isset($_POST['firstconvo'])){
		$q = "SELECT * FROM convos_following where username='$username' ";
		$out = mysqli_query($con, $q);
		$row = mysqli_fetch_array($out);
		$id = $row['convo_id'];
		$que = "SELECT * FROM messages where convo_id=$id";	
	}
	if(isset($_POST['submit'])) { //Adding new comment
    
      $comment = $_POST['comment'];
      $convo_id = $_POST['prev'];
      $que = "SELECT * FROM messages where convo_id=$convo_id";

      $r = mysqli_query($con, $que);
      $row = mysqli_fetch_assoc($r);
      $topic = $row['convo_name'];

    if($_POST['follow'] == '1'){
		$q = "DELETE FROM convos_following WHERE username='$username' and convo_id=$convo_id";
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

  <link rel="stylesheet" href="css/inbox.css">
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

<div class="container" style="height: 100%;">
<!-- Contains the full page -->
<div class="col-sm-12">
    <div class="page-header" id="mailbox">
    <!-- Page title, im not sure it fits, but I followed the format of the front page, feel free to remove-->
        <h1>Mailbox</h1>

    </div>
</div>


<div class="inbox">
<div class="row">
	<div class="col-sm-4"><!-- This is the threads (message list) section-->
		<div class="panel panel-default">
			<div class="panel-heading">Messages</div>
			<div class="panel-body" id="thread">	
				<div class="list-group" id="threads">
				<!--Thread list start-->
				<!-- each "a ref" is a list a thread these(2) are placeholder-->
				<?php  
						$query = "SELECT * FROM convos_following where username='$username' ORDER BY date_ DESC";
						
						$res = mysqli_query($con, $query);
						if ( false===$res ) {
							printf("error: %s\n", mysqli_error($con));
						}
						else {
							$results=array();
							while($row = mysqli_fetch_assoc($res)){
								$results['object_name'][] = $row;
								$convo_id = $row['convo_id'];
								$q = "SELECT * FROM messages WHERE convo_id=$convo_id ORDER BY date_ DESC";
								$result = mysqli_query($con, $q);
								$r = mysqli_fetch_assoc($result);
								$topic = $r['convo_name'];
								$msg = $r['msg_body'];
							echo "
							<form action='messages.php' method='post'>
								<input type='hidden' name='newconvo' value=$convo_id>
								<a href='javascript:;' class='list-group-item list-group-item-action' onclick='parentNode.submit();'>
									<h5 class='list-group-item-heading'>$topic</h5>
									<p class='list-group-item-text'>$msg</p>
								</a>
							</form>";
							}
						}
					?>
				</div>
				

			</div>
			
		</div>
	</div>
	<div class="col-sm-8">
		<div class="panel panel-default">
			<div class="panel-heading"><?php echo "$topic"; ?></div>
			<div class="panel-body" id="messages" >
			<!-- actual messages here-->
			<!-- Each "well div" is a message post, these are placeholder -->
			<?php 

              	$res = mysqli_query($con, $que);
             	 if ( false===$res ) {
                printf("error: %s\n", mysqli_error($con));
             	 }
              	else {
					$results=array();
					while($rows = mysqli_fetch_assoc($res)){
						$results['object_name'][] = $rows;
						$user = $rows['username'];
						$msg = $rows['msg_body'];
						$date = $rows['date_'];
						list($time, $pass) = explode(".", $date);
						echo "<div class='card'>
						<div class='media'>
							<div class='media-left media-top'>
							<form action='./profile.php' method='post'> 
								<input type='hidden' name='username' value=$user>
								
								<a href='javascript:;' onclick='parentNode.submit();'> 
									<h4 class='media-object' style='text-align:center;'>$user</h4>
								</a>
							</form>

							<a class='muser'>
								<img src='avatar.png' class='media-object' style='width:100px'>
							</a>
							</div>
							<div class='media-body'>
							<h6 class='media-header'><small>$time</small></h6>        
							<h5>$msg</h5>
							</div>
						</div>
						</div>";
					}
                
              

			}
			
			?>
			



		</div>
		<div class="panel-footer">
          <form action="messages.php" method="post">
            <div class="form-group">
            <textarea class="form-control" placeholder="Write a reply" rows="3" name="comment" id="comment"></textarea>
            </div>
            <div class="div col-sm-6">
			<div class="form-group has-warning">
              	<label class="custom-control custom-checkbox ">
					<input type="hidden" name="follow" value="0">
					<input type="checkbox" name="follow" value="1" class="custom-control-input" />
					
					<span class="custom-control-indicator"></span>
					<span class="custom-control-description"> Unfollow</span>
            	</label>
			</div>
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
</div></div>


  
<!-- Scripts start here -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>

<script type="text/javascript">


function thlist(thid){
	//gets as input thread id
	//sets it as id
	var id=thid;
	//from thread sql, fetch starting user name
	var username="user";
	//from thread sql fetch title
	var title="Title";
	//creates thread string
	//the onclick element has a reference to the thread id and calls openNewMessage()

	var tmsglist=`
					<a href="#" class="list-group-item" onclick='openNewMessage(`+id+`);'>
						<h4 class="list-group-item-heading">`+title+`</h4>
						<p class="list-group-item-text">`+username+`  (new icon)</p>
					</a>`;
	//add to thread list thread inner html
	addthread(tmsglist);
}



function openNewMessage(convoid){
	//When click on a thread
	//gets as input the thread id
	//clear the current messages
	clearmessages();
	//create an array from all message ID contained in the thread.
	//so fetch the message JSON/list in thread sql
	var messageArray=allData[convoid].split(';');
	//for each message, add it (message id argument)
	for (i in messageArray){
		//alert(i)
  		showmsg(i);
  	}
}

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
	//as you can see, it is the equivalent of the "well div" place holder from the message section
	var tnhtml=`<div class="well">
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

}
</script>
<script>
//stuff for the pop up that no longer works when hovering user pictures
$(document).ready(function(){
    $('.muser').popover({title: "Username", content: "Country<br>About me<br><a href=#profile>View Profile</a>", html: true, placement: "right", trigger:"hover click"}); 
});
</script>
<script type="text/javascript">
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
	function addthread(msg){
		var theDiv = document.getElementById("threads");
		theDiv.innerHTML += msg; 
	}
	function clearthreads(){
		var theDiv = document.getElementById("threads");
		theDiv.innerHTML = "";
	}

</script>
    <script src="/socket.io/socket.io.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.1.js"></script>
<script>
/*
This is where everything gets initiated.
its all kind of useless because it was for test purposes.

*/

var allData;
var convoArray=[];//threads
var msgArray=[];//messages in the thread, empty at first.

		//alert("1");
      //when we get data back
      //socket.on('send data', function(vallData){
      	//sallData=vallData;//store in global var

      	vallData = <?php echo json_encode($convos); ?>; //alert(vallData);
      	allData=JSON.parse(vallData);

      	//alert(allData);
      	var len=allData.length;
      	for (i in allData){
      		//subData=allData[i].split(';');//get name of thread from first element (; separated)
      		//wouldnt do that with sql stuff
      		convoArray[i]=i;//subData[0];
      	}
      	//remove place holder
      	clearthreads();
      	//create all threads
      	for (i in convoArray){
      		thlist(i);
      	}
      //});
      

    </script>
</body>
