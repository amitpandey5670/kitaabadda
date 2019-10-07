<?php
    include 'dbconnection.php';

    $category = $_POST['category'];
    $city     = $_POST['city'];

    if(isset($_POST['search'])){
        $search = $_POST['search'];
        $sql  = " SELECT aid_id,img_1,book_title,price,city,date FROM users,aid WHERE aid.user_id = users.userid AND city =  '$city' AND `book_title` LIKE '%{$search}%' ";
    }elseif($category == 'Others'){
	    $sql   =  "SELECT aid_id,img_1,book_title,price,city,date FROM users,aid WHERE aid.user_id = users.userid AND city =  '$city' ";
	}else{
		$sql  =  "SELECT aid_id,img_1,book_title,price,city,date FROM users,aid WHERE aid.user_id = users.userid and category = '$category' AND city = '$city' ";
	}




	    $run   =   mysqli_query($connect,$sql);

	    while ($row = mysqli_fetch_assoc($run)) {
	    	$aid_id     = $row['aid_id'];
	    	$img_1       =$row['img_1'];
	    	$book_title  = $row['book_title'];
	    	$price       =$row['price'];
	    	$city        =$row['city'];
	    	$date        =$row['date'];
    ?>


	    <div class="box zone" style="height: fit-content;">	
	    	<img src="Images/dbimages/<?php echo $img_1;  ?>" width="250px" height="300px" style="padding-top: 1rem; margin-left: 0.5rem;">
	    	<h6 style="color: black; margin: auto; padding-bottom: 0.5rem; font-size: 1rem; text-align: center;"><?php  echo $book_title; ?></h6>
	    	<h6 style="color: black; margin:auto; padding-bottom: 0.5rem; font-size: 1.5rem; text-align: center;">Price:<?php  echo $price;  ?></h6>
	    	<div style="display: flex;">
		    	<h6 style="color: black; margin:auto; padding-bottom: 0.5rem; font-size: 1rem;"><?php  echo $city;  ?></h6>
	            <h6 style="color: black; margin:auto; padding-bottom: 0.5rem; font-size: 1rem;"><?php  echo $date;  ?></h6>
            </div>
            <form style="display: flex; padding-bottom: 0.5rem;" action="details.php" method="post">
            	<input type="hidden" name="view" value="<?php echo $aid_id; ?>" >
            	<button style="margin-left:auto; margin-right: auto; font-size: 1.2rem; background: white;">View</button>
            </form>

	    </div>

	<?php } ?>