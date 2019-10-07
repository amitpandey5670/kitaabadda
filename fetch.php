<?php


    function fetch_post($page){
    	if($page){

    		    $category = $_POST['category'];
                $city     = $_POST['city'];


            include 'dbconnection.php';
    		$sql = "SELECT * FROM aid";
    		$run = mysqli_query($connect,$sql);

	    	$Num_Rows  = mysqli_num_rows($run);


	    	$per_page = 10;

	    	$page_start= (int)(($per_page*$page)-$per_page);

	    	if($Num_Rows <= $per_page){
	    		$num_pages = 1;
	    	}elseif(($Num_Rows % $per_page) == 0){
	    		$num_pages =  ($Num_Rows/$per_page);
	    	}else{
	    		$num_pages = ($Num_Rows/$per_page)+1;
	    		$num_pages = (int) $num_pages;

	    		if(isset($_POST['search'])){
	    			$search = $_POST['search'];
	    			$query = "SELECT aid_id,img_1,book_title,price,city,date FROM users,aid WHERE aid.user_id = users.userid AND city =  '$city' AND `book_title` LIKE '%{$search}%' ORDER BY aid_id DESC LIMIT ".$page_start.",".$per_page."";

	    		}elseif($category == 'Others'){
	    			$query = "SELECT aid_id,img_1,book_title,price,city,date FROM users,aid WHERE aid.user_id = users.userid AND city =  '$city' ORDER BY aid_id DESC LIMIT ".$page_start.",".$per_page."";
	    		}else{
	    			$query = "SELECT aid_id,img_1,book_title,price,city,date FROM users,aid WHERE aid.user_id = users.userid AND category = '$category' AND city =  '$city' ORDER BY aid_id DESC LIMIT ".$page_start.",".$per_page."";

	    		}
	    		$run = mysqli_query($connect,$query);
	    		$num = mysqli_num_rows($run);


	    		if($num >0){
	    			return $run;
	    		}else{
	    			return 'x';
	    		}

	    	}
        }
    }



    if(isset($_POST['page'])){
    	$page = $_POST['page'];

	    $return_data = fetch_post($page);
	    if($return_data != 'x'){
	        while ($row = mysqli_fetch_assoc($return_data)) {
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
	            <div style="display: flex;">
		            <form style=" padding-bottom: 0.5rem;" action="details.php" method="post">
		            	<input type="hidden" name="view" value="<?php echo $aid_id; ?>" >
		            	<button style="margin-left:auto; margin-right: auto; font-size: 1.2rem; background: white;">View</button>
		            </form>
		            <form style=" padding-bottom: 0.5rem;" action="save.php" method="post">
		            	<input type="hidden" name="save" value="<?php echo $aid_id; ?>" >
		            	<button style="margin-left:auto; margin-right: auto; font-size: 1.2rem; background: white;">Save</button>
		            </form>
	            </div>

		    </div>

		<?php } }else{
			?>
			<h3 >No Data Found....</h3>
	    <?php		
		}
    }
?>



