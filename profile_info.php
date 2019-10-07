<?php  
   session_start();
   if(!isset($_SESSION['admin'])){
   	  header("location:login.php");
   }
   include 'dbconnection.php';
   $email = $_SESSION['admin'];
   $sql = " SELECT * FROM users WHERE email = '$email' ";
   $run  = mysqli_query($connect,$sql);
   $result = mysqli_fetch_assoc($run);

   $fname = $result['fname'];
   $lname = $result['lname'];
   $gender = $result['gender'];
   $dob   = $result['dob'];
   $contact = $result['contact_no'];
   $password = $result['password'];
   $address = $result['address'];
   $city = $result['city'];
   $country = $result['country'];
   $pincode = $result['pincode'];
   
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

   	   if(!empty($fname) && !empty($lname) && !empty($dob) && !empty($email) && !empty($pwd)){
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
	<title>Profile info</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="login.css">
	<style type="text/css">
		
	</style>

</head>
<body>
	<div>
		 <form  name="frm" action="register.php" onsubmit="return chkData()" method="post" style="width: 50%; margin-left: 20%; margin-right: 20%">
		    <div class="imgcontainer">
      			<img src="Images/avatar2.png" alt="Avatar" class="avatar">
   			 </div>

		    <div class="container">
	
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


		      <label for="pwd"><b>Password</b></label>
		      <input type="password" id="pwd" placeholder="Enter password" name="pwd" required>
		      <input type="checkbox" onclick="myFunction()">Show Password<br><br>


		      <label for="addr"><b>Address</b></label>
		      <input type="text" placeholder="Re-enter password" name="addr" required>

		      <label for="city"><b>City</b></label>
		      <input type="text" placeholder="Enter City" name="city" required>

		      <label for="country"><b>State</b></label>
		      <input type="text" placeholder="Enter Country" name="country" required>

		      <label for="pin"><b>Pincode</b></label>
		      <input type="text" placeholder="Enter Pincode" name="pin">


		        
		      <button type="submit" name="submit">Update Info</button>
		    </div>

		    <div class="container" >
		      <button type="button" class="cancelbtn">Cancel</button>
		    </div>
		  </form>
		
	</div>
	<script type="text/javascript">
		(function($) {
			  $.fn.populateData = function(data) {
			    var $form = this;
			    $.each(data, function(key, value) {
			      $('[name=' + key + ']', $form).val(value);
			    });
        }
       })(jQuery);

	   var form = document.forms['frm'];
	   var formData = {
		   fname : '<?php echo $fname;  ?>',
		   lname : '<?php echo $lname;  ?>',
		   dob : '<?php echo $dob;  ?>',
		   gender : '<?php echo $gender;  ?>',
		   dob : '<?php echo $dob;  ?>',
		   email : '<?php echo $email;  ?>',
		   contact : '<?php echo $contact;  ?>',
		   pwd : '<?php echo $password;  ?>',
		   addr : '<?php echo $address;  ?>',
		   city : '<?php echo $city;  ?>',
		   country : '<?php echo $country;  ?>',
		   pin : '<?php echo $pincode;  ?>',
        };

$(form).populateData(formData);

function myFunction() {
  var x = document.getElementById("pwd");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
		
	</script>

</body>
</html>