<?php

require 'database.php';

session_start();

$username = $_SESSION['username'];

function print_r2($val){
        echo '<pre>';
        print_r($val);
        echo  '</pre>';
}

if(!isset($_SESSION['user_id'])) { //if not yet logged in
   header("Location: index.php");// send to login page
   exit;
} 
if(isset($_POST['username'])) { //display a new thread

	$user=$_POST['username'];
    /*$que = "SELECT * FROM messages where convo_id=$convo_id";

    $r = mysqli_query($con, $que);
    $row = mysqli_fetch_assoc($r);
    $username = $row['username'];
    $country = $row['country'];
    //$aboutme = $row['aboutme'];
    $posts  = $row['convo_following']; //actually its lenght
    //$avatar =$row['avatar'];
    //$notif =$row['notif'];
 */
}
else
{
	$user=$username;
}

if(isset($_POST['avatar'])) {
    $pavatar = $_POST['picture'];
    if ($pavatar=="")
    {
    	$pavatar="img/default/avatar.png";
    }
    
    $sql = "UPDATE users SET avatar='$pavatar' WHERE username='$username'";
    mysqli_query($con, $sql);
    	   
}

if(isset($_POST['about'])) {
    $pabout = $_POST['abouttext'];
    
    $sql = "UPDATE users SET about='$pabout' WHERE username='$username'";
    mysqli_query($con, $sql);
    	   
}

	$query = "SELECT * FROM users where username='$user'";
	$r = mysqli_query($con, $query);
	if($r == false){
		echo "ERROR SHAME ON YOU! HOPE ITS NOT ON THE LIVE DEMO.";
	}else{
		$row = mysqli_fetch_assoc($r);
		$user = $row['username'];
		$country = $row['country'];
		$about = $row['about'];
		$posts  = $row['post_count']; //actually its lenght
		$avatar =$row['avatar'];
		//$notif =$row['notif'];
	}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Profile</title>
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
    	<form action='./profile.php' method='post'> 
                            <input type='hidden' name='username' value=<?php echo $username ?>>
                            
                            <a class="nav-link" href='javascript:;' onclick='parentNode.submit();'> 
                              <?php echo $username ?>
                            </a>
		</form>
      <!--<a class="nav-link" href="./profile.php"> <?php echo $username ?>  </a> -->
    </li>
    <li class="nav-item float-xs-right">
      <a class="nav-link" href="./index.php">Logout</a>
    </li>
  </ul>
</nav>


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

<?php
	/*$avatar="avatar.png";
	$posts="XYZ";
	$aboutme="LAAAHHH HHOOO STATE OFF YOU";
	echo "<div class='col-sm-3'>
      	 <ul class='list-group'>
			  <li class='list-group-item'><img src='$avatar' class='media-object' style='width:100px'></li>
			  <li class='list-group-item'>$country</li>
			  <li class='list-group-item'>Post Count: $posts</li>
			</ul>

      </div>
		<div class='col-sm-8'>
			<ul class='list-group'>
			  <li class='list-group-item'>$user</li>
			  <li class='list-group-item'><b>About me:</b><br>
			  <p>$aboutme
			  </p>
			  </li>
			  <li class='list-group-item'>???</li>
			</ul>
		</div>";
*/
?>
      </div>
</div>

</div>

</div>


<!-- Modal avatar-->
<div id="Mchangeavatar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change avatar</h4>
      </div>
      <div class="modal-body">

        <form action="profile.php" method="post">
          <div class="form-group">
            <label for="picture">Enter picture URL</label>
            <input type="text" class="form-control" id="picture" name="picture">
          </div>

          <button type="submit" name="avatar" class="btn btn-default">Confirm</button>
        </form>
      </div>
    </div>

  </div>
</div>


<!-- Modal Aboutme-->
<div id="Mchangeaboutme" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change About me text</h4>
      </div>
      <div class="modal-body">

        <form action="profile.php" method="post">
          <div class="form-group">
            <label for="abouttext">Enter your new description</label>
            <textarea type="form-control" class="form-control" id="abouttext" name="abouttext"></textarea>
          </div>

          <button type="submit" name="about" class="btn btn-default">Confirm</button>
        </form>
      </div>
    </div>

  </div>
</div>

<!-- Modal change password-->
<div id="Mchangepassword" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change Password</h4>
      </div>
      <div class="modal-body">

        <form action="profile.php" method="post">
          <div class="form-group">
            <label for="topic">Enter old password:</label>
            <input type="text" class="form-control" id="old" name="topic">
            <label for="topic">Enter new password:</label>
            <input type="text" class="form-control" id="new" name="topic">
          </div>

          <button type="submit" name="submit" class="btn btn-default">Change</button>
        </form>
      </div>
    </div>

  </div>
</div>

</div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <!--<script src="/socket.io/socket.io.js"></script>-->
  
  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>

<script type="text/javascript">

function showprofile(uid){
	//gets as input the message id
	
	//fetch from sql (msgs), get the id of the user
	var userid=uid;
	//fetch from sql (users) get his name.
	var tusername=<?php echo json_encode($user); ?>;//<?php //echo "$user"; ?>;
	//username=JSON.parse(tusername);alert("Yo");
	
	//fetch from msg sql, get date
	var avatar=<?php echo json_encode($avatar); ?>;;//<?php //echo "$avatar" ?>;
	//fetch from mesg sql, get text
	var about= <?php echo json_encode($about); ?>;;//<?php //echo "$aboutme" ?>
	//fetch from mesg sql, get text
	var country=<?php echo json_encode($country); ?>;//<?php// echo "$country"; ?>;
	//fetch from mesg sql, get text
	var posts= <?php echo json_encode($posts); ?>;;//<?php //echo "$posts" ?>;

	//creates the post string:
	//as you can see, it is the equivalent of the "well div" place holder from the message section
	if (uid==1)
	{
	{
		var tnhtml=`<div class="col-sm-3">
      	 <ul class="list-group">
			  <li class="list-group-item">
			  	<object data="`+avatar+`" type="image/jpg" style="width:100px;max-height: 100px;">
    			<img src="img/default/avatar.png" class="media-object" style="width:100px"/>
				</object>
			  </li>
			  <li class="list-group-item">`+country+`</li>
			  <li class="list-group-item">Post Count: `+posts+`</li>
			</ul>

      </div>
		<div class="col-sm-8">
			<ul class="list-group">
			  <li class="list-group-item"><h4>`+tusername+`</h4></li>
			  <li class="list-group-item"><b>About me:</b><br>
			  <p>`+about+`
			  </p>
			  </li>
			</ul>
		</div>`;
	}
	}
	else
	{
		var tnhtml=`<div class="col-sm-3">
      	 <ul class="list-group">
			  <li class="list-group-item">
			  	<object data="`+avatar+`" type="image/jpg" style="width:100px;max-height: 100px;">
    			<img src="img/default/avatar.png" class="media-object" style="width:100px"/>
				</object>

			  <br>
			  	<button type="button" data-toggle="modal" data-target="#Mchangeavatar" class="btn-info btn-primary btn-xs">change</button>
			  </li>
			  <li class="list-group-item">`+country+`</li>
			  <li class="list-group-item">Post Count: `+posts+`</li>
			</ul>

      </div>
		<div class="col-sm-8">
			<ul class="list-group">
			  <li class="list-group-item"><h4>`+tusername+`</h4></li>
			  <li class="list-group-item"><b>About me:</b><br>
			  <p>`+about+`
			  </p>
			  <br>
			  <button type="button" data-toggle="modal" data-target="#Mchangeaboutme" class="btn-info btn-primary btn-xs">change</button>
			  </li>
			</ul>
		</div>`;
	}
	//add to messages, it simply adds that string to the inner html of the message section
		var theDiv = document.getElementById("profile");
		theDiv.innerHTML += tnhtml; 

}
function noprofile(){
	var tnhtml=`<div class='alert alert-info'>
			  <strong>Error!</strong> No such user found.
			</div>`;

			var theDiv = document.getElementById('profile');
			theDiv.innerHTML += tnhtml; 
}

</script>
<?php
	if (is_null($user)==true)
	{
		echo "
		<script>
			noprofile();
		</script>
		";
	}
	else
	if ($username==$user)
	{
		echo "
		<script>
			showprofile(2);
		</script>
		";
	}
	else
	{
		echo "
		<script>
			showprofile(1);
		</script>
		";
	}
?>
</body>

</html>
