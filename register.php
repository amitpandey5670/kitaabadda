<?php
   include("dbconnection.php");
   if(isset($_POST['submit'])){

   	   $fname    =  $_POST['fname'];
   	   $lname    =  $_POST['lname'];
   	   $gender   =  $_POST['gender'];
   	   $dob      =  $_POST['dob'];
   	   $email    =  $_POST['email'];
   	   $contact  =  $_POST['contact'];
   	   $pwd      =  $_POST['pwd'];
   	   $city     =  $_POST['city'];
   	   $country  =  $_POST['country'];
   	   $pin      =  $_POST['pin'];
   	   $addr     =  $_POST['addr'];




   	   if(!empty($email)){
   	   	   $query = "SELECT * FROM users WHERE email='$email' ";

   	   	   $run = mysqli_query($connect,$query);
   	   	   $check_run = mysqli_num_rows($run);
   	   	   if($check_run >0){
   	   	   	    $message = "Email is already registered";
                echo "<script type='text/javascript'>alert('$message');</script>";
   	   	   	    exit();
   	   	   }


   	   }

   	   if(!empty($fname) && !empty($lname) && !empty($gender) && !empty($dob) && !empty($email) && !empty($pwd)){
   	   	   $sql = "INSERT INTO users (fname,lname,gender,dob,email,contact,password,address,city,country,pincode) VALUES (
   	   	         '$fname','$lname','$gender','$dob','$email','$contact', '$pwd','$addr','$city','$country','$pin')";
   	   	   $run = mysqli_query($connect,$sql);

   	   	   if($run){
   	   	   	    $message = "User registration successful..!";
				echo "<script type='text/javascript'>alert('$message');</script>";
   	   	   }else{
   	   	   	   $message = "Ooops, There is a problem while registering please try again later";
			   echo "<script type='text/javascript'>alert('$message');</script>";
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
	<script type="text/javascript">
		function chkData(){
			var eid = document.frm.email.value;
			var pass1 = document.frm.pwd.value;
			var pass2 = document.frm.pwd1.value;

			var atpos = eid.indexOf("@");
			var dotpos = eid.lastIndexOf(".");

			if(atpos<1 || dotpos+2>= eid.length){
				alert("Please Enter Valid e-mail address");
				return false;
			}

			if(pass1.length<6 || pass1.length>12){
				alert("password length must be between 6 to 12 characters");
				return false;
			}

			if(pass1 == pass2){
				return true;
			} else{
				alert("New Password and Re-enter Password must be same");
				return false;
			}
		}
	</script>

</head>
<body>
		  <form  name="frm" action="register.php" onsubmit="return chkData()" method="post" style="width: 50%; margin-left: 20%; margin-right: 20%">
		    <div class="imgcontainer">
      			<img src="Images/avatar2.png" alt="Avatar" class="avatar">
   			 </div>

		    <div class="container">
		      <h3 style="color: red; text-align: center;">All fields are required</h3>
	
		      <label for="fname"><b>First Name</b></label>
		      <input type="text" placeholder="Enter First name" name="fname" required>

		      <label for="lname"><b>Last Name</b></label>
		      <input type="text" placeholder="Enter Last name" name="lname" required>

		      <label for="gender"><b>Gender</b></label>
		      <input type="radio" name="gender" value="Male">Male <br>
              <input type="radio" name="gender" value="Female" style="margin-left: 9%;">Female <br>
              <input type="radio" name="gender" value="Female" style="margin-left: 9%;">Transgender <br> <br>

              <label for="dob"><b>BirthDate</b></label>
		      <input type="date"  name="dob" required> <br> <br>



		      <label for="email"><b>Email</b></label><span style="margin-left: 1rem; font-size: 0.8rem;">We don't reveal your email to anyone</span>
		      <input type="text" placeholder="Enter email" name="email" required>

		      <label for="contact"><b>Phone Number</b></label><span style="margin-left: 1rem; font-size: 0.8rem;">It will be displayed with your aid so that buyers can contact you</span>
		      <input type="text" placeholder="Enter your Phone number" name="contact" required>


		      <label for="pwd"><b>New Password</b></label>
		      <input type="password" placeholder="Enter password" name="pwd" required>

		      <label for="pwd1"><b>Re-enter Password</b></label>
		      <input type="password" placeholder="Re-enter password" name="pwd1" required>

		      <label for="addr"><b>Address</b></label>
		      <input type="text" placeholder="Re-enter password" name="addr" required>

		      <label for="city"><b>City</b></label>
		      <input type="text" placeholder="Enter City" name="city" required>

		      <label for="country"><b>State</b></label>
		      <input type="text" placeholder="Enter Country" name="country" required>

		      <label for="pin"><b>Pincode</b></label>
		      <input type="text" placeholder="Enter Pincode" name="pin">


		        
		      <button type="submit" name="submit">Register</button>
		    </div>

		    <div class="container" >
		      <button type="button" class="cancelbtn">Cancel</button>
		    </div>
		  </form>

		<script type="text/javascript">
			$(document).ready(function(){
				$('.cancelbtn').click(function(){
					location.href = 'login.php';
				});
			})
		</script>

</body>
</html>