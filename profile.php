<?php

require 'database.php';

session_start();

$username = $_SESSION['username'];

if(!isset($_SESSION['user_id'])) { //if not yet logged in
   header("Location: index.php");// send to login page
   exit;
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Profile</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/styles.css">
 <link rel="stylesheet" href="bootstrap-4.0.0/css/bootstrap.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <!--<script src="/socket.io/socket.io.js"></script>-->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!--
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script
  -->
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
	<div class="container" style="height: 100%;">
<!-- Contains the full page -->
<div class="col-sm-12">
    <div class="page-header" id="mailbox">
    <!-- Page title, im not sure it fits, but I followed the format of the front page, feel free to remove-->
        <h1>Profile</h1>

    </div>
</div>



<div class="row">

<div class="col-sm-2"></div>
<div class="col-sm-8">
<div class="panel panel-default" style="">
      <div class="panel-heading">Profile</div>

      <div class="panel-body" id="profile">

      <!--
      <div class="col-sm-3">
      	 <ul class="list-group">
			  <li class="list-group-item"><img src="avatar.png" class="media-object" style="width:100px"></li>
			  <li class="list-group-item">Country</li>
			  <li class="list-group-item">Post count</li>
			</ul>

      </div>
		<div class="col-sm-8">
			<ul class="list-group">
			  <li class="list-group-item">Name</li>
			  <li class="list-group-item"><b>About me:</b><br>
			  <p>
			  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc convallis tortor at velit congue commodo. Sed nec felis libero. Sed sit amet mollis risus. Fusce commodo maximus dui a pharetra. Donec a iaculis velit, vel fermentum lacus.
			  </p>
			  </li>
			  <li class="list-group-item">???</li>
			</ul>
		</div>
		-->
      </div>
</div>

</div>


</body>
<script type="text/javascript">
alert("WHY");</script>
<script type="text/javascript">
alert("Yo");
function showprofile(uid){
	//gets as input the message id
	alert("ZOMG");
	
	//fetch from sql (msgs), get the id of the user
	var userid=uid;
	//fetch from sql (users) get his name.
	var username=<?php echo "$user"; ?>;
	//fetch from msg sql, get date
	var avatar="avatar.png";//<?php //echo "$avatar" ?>;
	//fetch from mesg sql, get text
	var about= "Im cool";//<?php //echo "$aboutme" ?>
	//fetch from mesg sql, get text
	var country=<?php echo "$country"; ?>;
	//fetch from mesg sql, get text
	var posts= "xxx";//<?php //echo "$posts" ?>;

	//creates the post string:
	//as you can see, it is the equivalent of the "well div" place holder from the message section
	var tnhtml=`<div class="col-sm-3">
      	 <ul class="list-group">
			  <li class="list-group-item"><img src="`+avatar+`" class="media-object" style="width:100px"></li>
			  <li class="list-group-item">`+country+`</li>
			  <li class="list-group-item">Post Count: `+posts+`</li>
			</ul>

      </div>
		<div class="col-sm-8">
			<ul class="list-group">
			  <li class="list-group-item">`+username+`</li>
			  <li class="list-group-item"><b>About me:</b><br>
			  <p>`+about+`
			  </p>
			  </li>
			  <li class="list-group-item">???</li>
			</ul>
		</div>`;
	//add to messages, it simply adds that string to the inner html of the message section
		var theDiv = document.getElementById("profile");
		theDiv.innerHTML += tnhtml; 
showprofile(1);
}


</script>

</html>
