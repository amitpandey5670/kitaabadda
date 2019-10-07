<?php
     session_start();
     if(isset($_SESSION['admin'])){
      unset($_SESSION['view']);
      unset($_SESSION['save']);
      header("location:my_profile.php");
     }
     include("dbconnection.php");

     if(isset($_POST['submit'])){
     	$username = $_POST['uname'];
     	$password = $_POST['psw'];

     	if(!empty($username) && !empty($password)){
     		$sql = "SELECT * FROM users WHERE email = '$username' AND password = '$password'" ;
     		$run = mysqli_query($connect,$sql);
     		$check_run = mysqli_num_rows($run);
     		if($check_run == 1){
     			$_SESSION['admin'] = $username;
          header("location:my_profile.php");

     		}elseif($check_run == 0){
     			      $message = "username and password does not found";
                echo "<script type='text/javascript'>alert('$message');</script>";
   	   	   	    exit();

     		}

     		}

     	}

?>





<!DOCTYPE html>
<html>
<head>
	<title>userlogin</title>
	<link rel="stylesheet" type="text/css" href="login.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>
<body>
<form action="login.php" method="post" name="frm" style="width: 30%; margin-left: 30%; margin-right: 30%">
  <div class="imgcontainer">
    <img src="Images/avatar2.png" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label for="uname"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="uname" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" autocomplete="password" required>
        
    <button type="submit" name="submit">Login</button>
  </div>

  <div class="container" style="display: flex;">
    <button type="button" class="cancelbtn">Cancel</button>
    <button type="button" class="registerbtn" style="margin-left: 56%" >Register</button>
  </div>
</form>

<script type="text/javascript">

	$(document).ready(function() {

		$('.cancelbtn').click(function(){
			location.href = 'index.php';

		});

		$('.close').click(function(){
			location.href = 'index.php';
		});

		$('.registerbtn').click(function(){
			location.href = 'register.php';
		});

	});


</script>
</body>
</html>