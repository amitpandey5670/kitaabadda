<?php
   session_start();
   if(!isset($_SESSION['admin'])){
   	  header("location:login.php");
   }
   include("dbconnection.php");
   if(isset($_POST['submit'])){

   	   $aid_title   =  $_POST['aid_title'];
   	   $book_title  =  $_POST['book_title'];
   	   $category    =  $_POST['category'];
   	   $author      =  $_POST['author'];
   	   $publication =  $_POST['publication'];
   	   $description =  $_POST['description'];
   	   $date        =  date('F j,Y');
   	   $price       =  $_POST['price'];

	   $stmt = $connect->prepare('SELECT userid FROM users WHERE email = ?');
	   $stmt->bind_param('s', $_SESSION['admin']); // 's' specifies the variable type => 'string'

	   $stmt->execute();

	   $result = $stmt->get_result();
	   while ($row = $result->fetch_assoc()) {
			// Do something with $row
			$userid = $row['userid'];
		    echo "<script type='text/javascript'>alert('$userid');</script>";


	   }

   	   $target_dir = "Images/dbimages/";
   	   $imageName1 =  $_FILES["img_1"]["name"];
   	   $imageTmp1  = $_FILES["img_1"]["tmp_name"];
   	   $target_file1 = $target_dir.basename($imageName1);




   	   if(!empty($aid_title) && !empty($book_title) && !empty($category)){
   	   	  $sql = "INSERT INTO aid (user_id,date,aid_title,book_title,category,author,publication,description,img_1,price) VALUES ('$userid','$date','$aid_title','$book_title','$category','$author','$publication','$description','$imageName1','$price')";
   	   	   $run = mysqli_query($connect, $sql);

   	   	   if($run){	   	   	    
   	   	   	    move_uploaded_file($imageTmp1,$target_file1);
   	   	   	    // move_uploaded_file($imageTmp3,$target_file3);
   	   	   	    $message = "Aid Posted successful..!";
				echo "<script type='text/javascript'>alert('$message');</script>";
   	   	   }else{
   	   	   	   $message = "Ooops, There is a problem while Aid posting please try again later";
			   echo "<script type='text/javascript'>alert('$message');</script>";
   	   	   }
   	   }

   } 


?>






<!DOCTYPE html>
<html>
<head>
	<title>Aids</title>
	<link rel="stylesheet" type="text/css" href="login.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>	

</head>
<body>
	    <form  name="frm" action="aid.php" method="post" enctype="multipart/form-data"   style="width: 50%; margin-left: 20%; margin-right: 20%">
		    <div class="container">
		      <label for="aid_title"><b>Aid_title <span style="color: red;">*</span></b></label>
		      <input type="text" placeholder="Enter Aid title" name="aid_title" required>

		      <label for="book_title"><b>Book_title <span style="color: red;">*</span></b></label>
		      <input type="text" placeholder="Enter Book_title" name="book_title" required>

		      <label for="category"><b>Category <span style="color: red;">*</span></b></label>
		      <select name="category" style="margin-left: 2rem; font-size: 1rem;" required>
		      	<option>Engineering</option>
		      	<option>Science</option>
		      	<option>Commerce</option>
		      	<option>Arts</option>
		      	<option>Medical</option>
		      	<option>HSC</option>
		      	<option>1-10th</option>
		      	<option>Competitive</option>
		      	<option>Others</option>
		      </select> <br> <br>
              <label for="author"><b>Author</b></label>
		      <input type="text"  placeholder="Enter Author name" name="author"> <br> <br>

		      <label for="publication"><b>Publication</b></label>
		      <input type="text" placeholder="Enter Publication" name="publication" >

		      <label for="description"><b>Description</b></label> <br> <br>
		      <textarea rows="7" cols="30" placeholder="write about condition of the book,year of publication..." name="description"> </textarea> <br>

		      <label for="price"><b>Price <span style="color: red;">*</span></b></label>
		      <input type="text" placeholder="Enter Price in rupees" name="price" required>




		      <label for="img_1"><b>Image_1 <span style="color: red;">*</span></b></label>
		      <input type="file" placeholder="Enter Image 1" name="img_1" style="padding-left: 2rem;"><br> <br>
              <button type="submit" name="submit">Publish</button>
		    </div>

		    <div class="container" >
		      <button type="button" class="cancelbtn">Cancel</button>
		    </div>
		</form>

		<script type="text/javascript">
			$(".cancelbtn").click(function(){
				location.href = 'my_profile.php';
			});
		</script>


</body>
</html>