<?php

require 'database.php';

session_start();

	$query = "SELECT convos_following FROM users WHERE user_id = :user_id";
	$stmt = $conn->prepare($query);
	$stmt->bindParam(':user_id', $_SESSION['user_id']);
	$convos = $stmt->execute();





?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Opinion message box</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/styles.css">
 <link rel="stylesheet" href="bootstrap-4.0.0/css/bootstrap.css">

<style>
	html{
  height: 100%;
}
body {
  min-height: 100%;
}
</style>

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



<div class="row">
	<div class="col-sm-4"><!-- This is the threads (message list) section-->
		<div class="panel panel-default">
			<div class="panel-heading">Messages</div>
			<div class="panel-body" >	
				<div class="list-group" id="threads">
				<!--Thread list start-->
				<!-- each "a ref" is a list a thread these(2) are placeholder-->
				</div>

			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="panel panel-default">
			<div class="panel-heading">Message title</div>
			<div class="panel-body" id="messages" style="max-height:500px;overflow: auto;">
			<!-- actual messages here-->
			<!-- Each "well div" is a message post, these are placeholder -->
			



		</div>
		</div>
	</div>
</div>
</div>


  
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

		alert("1");
      //when we get data back
      //socket.on('send data', function(vallData){
      	//sallData=vallData;//store in global var

      	vallData = <?php echo json_encode($convos); ?>;alert(vallData);
      	allData=JSON.parse(vallData);

      	alert(allData);
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
