<?php 
    session_start();
    if(!isset($_SESSION['admin'])){
    	$_SESSION['view'] = $_POST['view'];
   	   header("location:login.php");
    }

    include 'dbconnection.php';
    if(isset($_SESSION['view'])){
    	$var = $_SESSION['view'];
    }else{
    	$var = $_POST['view'];
    }
	$sql   =  "SELECT * FROM aid WHERE aid_id = '$var' ";
 	$run   =   mysqli_query($connect,$sql);
 	$result1 = mysqli_fetch_assoc($run);

 	$aid_id     = $result1['aid_id'];
 	$date       = $result1['date'];
 	$aid_title  = $result1['aid_title'];
 	$book_title = $result1['book_title'];
 	$category   = $result1['category'];
 	$author     = $result1['author'];
 	$publication = $result1['publication'];
 	$description= $result1['description'];
 	$img_1      = $result1['img_1'];
 	$price      = $result1['price'];


 	$sql   =  "SELECT fname,lname,email,contact_no,address,city,country,pincode FROM aid,users WHERE aid.aid_id = '$var' " ;

 	$run = mysqli_query($connect,$sql);

 	$result2 = mysqli_fetch_assoc($run);

 	$fname     = $result2['fname'];
 	$lname     = $result2['lname'];
  	$contact_no = $result2['contact_no'];
 	$address   = $result2['address'];
 	$country   = $result2['country'];
 	$city      = $result2['city'];
 	$pincode   = $result2['pincode']; 

?>

<!DOCTYPE html>
<html>
<head>
	<title>Product Details</title>
	<link rel="stylesheet" type="text/css" href="details.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/v4-shims.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>	
	<link rel="stylesheet" type="text/css" href="style.css">

	<style type="text/css">
		  body{
			margin-left: 2rem;
			margin-right: 2rem;
			margin-top: 1rem;
			background: rgba(0,47,52,.03);
		    }
		  
			.main{
				width: 60%;
			}

/*			.img{
				margin-left: auto;
				margin-left: auto;
				width: 60%;
				border: 1px solid blue;
			} */           
			.img_1 img{
				padding: 2rem;
				width: 450px;
                margin-left: 1.7rem;
                height: 450px;
			}

			.side{
				margin-left: 1rem;
				width: 35%;
			}

	
	</style>

</head>
<body>

  <div style="display:flex; margin-bottom: 2rem;">	
	<div class="main">
		<div class="img_1" style="border: 1px solid blue; width: 80%; 	box-shadow: 2px 5px 15px rgba(0,0,0,0.8); background: rgba(0,47,52,.03);">
			<div style="border: 1px solid black;">
				<img src="Images/dbimages/<?php echo $img_1;  ?>" >
			</div><br>
			<div style="border: 1px solid black;">
			   <h2 style="padding-top: 1rem; padding-left: 1rem;">Book Details</h2>
			   <p style="font-size: 1rem; font-weight: bold; padding-left: 1rem;">Aid Title: <?php echo $aid_title;  ?></p>
			   <p style="font-size: 1rem; font-weight: bold; padding-left: 1rem;">Book Title: <?php echo $book_title;  ?></p>
			   <p style="font-size: 1rem; font-weight: bold; padding-left: 1rem;">Category: <?php echo $category;  ?></p>
			   <p style="font-size: 1rem; font-weight: bold; padding-left: 1rem;">Author: <?php echo $author;  ?></p>
			   <p style="font-size: 1rem; font-weight: bold; padding-bottom: 1rem; padding-left: 1rem;">Publication: <?php echo $publication;  ?></p>	
			   <form style=" padding-bottom: 0.5rem;" action="save.php" method="post">
		            	<input type="hidden" name="save" value="<?php echo $aid_id; ?>" >
		            	<button id="saved"  style="margin-left:auto; margin-right: auto; font-size: 1.2rem; background: white;">save</button>
		        </form>		
			</div><br>

			<div style="border: 1px solid black;">
				<h2 style="padding-top: 1rem; padding-left: 1rem;">Description</h2>
				<p style="font-size: 1rem; font-weight: bold; padding-left: 1rem;"><?php echo $description;  ?></p>

				
			</div>

			
		</div>
		
	</div>

	<div class="side">

	  <div style="border: 1px solid blue; width: 80%; box-shadow: 2px 5px 15px rgba(0,0,0,0.8);">
		<div>
			<h2>Aid Details</h2>
		    <h3 style="font-size: 1.4rem; padding-left: 1rem;" >Price: <?php echo $price; ?></h3>
		    <p style="font-size: 1rem; font-weight: bold; padding-left: 1rem;">Aid ID: <?php echo $aid_id;  ?></p>
		    <p style="font-size: 1rem; font-weight: bold; padding-left: 1rem;">Aid Posted On: <?php echo $date;  ?></p>
		    <p style="font-size: 1rem; font-weight: bold; padding-left: 1rem;">Aid Title: <?php echo $aid_title;  ?></p>		

		</div>


	  </div>
	  <div style="border: 1px solid blue; width: 80%; box-shadow: 2px 5px 15px rgba(0,0,0,0.8); margin-top: 2rem;">
		<div>
			<h2>Seller Description</h2>
		    <h3 style="font-size: 1.4rem; padding-left: 1rem;" >Name: <?php echo $fname." ".$lname; ?></h3>	
		    <p style="font-size: 1rem; font-weight: bold; padding-left: 1rem;">Contact: <?php echo $contact_no;  ?></p>		
		    <p style="font-size: 1rem; font-weight: bold; padding-left: 1rem;">Address: <?php echo $address;  ?></p>		
		    <p style="font-size: 1rem; font-weight: bold; padding-left: 1rem;">City: <?php echo $city;  ?></p>
		    <p style="font-size: 1rem; font-weight: bold; padding-left: 1rem;">Pincode: <?php echo $pincode;  ?></p>		
		    <p style="font-size: 1rem; font-weight: bold; padding-left: 1rem;">Country: <?php echo $country;  ?></p>		
		    

		</div>


	  </div>	
	</div>
  </div>
    <footer id="footer">
    	<div class="social-menu">
			<ul>
				<li><a href="tel:+919082004479" target="_blank" ><i class="fa fa-phone"></i></a></li>
				<li><a href="https://www.facebook.com/profile.php?id=100004534278375" target="_blank" ><i class="fa fa-facebook"></i></a></li>
				<li><a href="https://twitter.com/Amitkum45372322" target="_blank" ><i class="fa fa-twitter"></i></a></li>
				<li><a href="https://www.instagram.com/amit_pandey_05/" target="_blank"><i class="fa fa-instagram"></i></a></li>
				<li><a href="https://www.linkedin.com/in/amit-pandey-6a66ba182/" target="_blank"><i class="fa fa-linkedin"></i></a></li>
			</ul>
		</div>
		<div class="foot">&copy; Copyright KitaabAdda 2019</div>
    	
    </footer>

    <script type="text/javascript">
          $('#contact').click(function(){
             location.href = 'login.php'
          });
    </script>


</body>
</html>


