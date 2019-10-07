<?php 
   session_start();
   if(!isset($_SESSION['admin'])){
   	  $_SESSION['save'] = $_POST['save'];
   	  header("location:login.php");
   }


   include 'dbconnection.php';

   if(isset($_SESSION['save'])){
   	    $aid_id = $_SESSION['save'];
   }else{
   	    $aid_id  = $_POST['save'];
   }
    	$email = $_SESSION['admin'];
        $sql = "SELECT userid FROM users WHERE email = '$email'";
    	$run = mysqli_query($connect,$sql);
    	$result = mysqli_fetch_assoc($run);
    	$user_id = $result['userid'];

    	$sql = "SELECT * FROM save_list WHERE user_id = '$user_id'";
    	$run = mysqli_query($connect,$sql);
    	 while ($result = mysqli_fetch_assoc($run)) {

    	      $aidid = $result['aid_id'];
              if($aidid == $aid_id){
    		  $_SESSION['save_message'] = 'This aid is already present in your save list';
    		  exit(header("location:my_profile.php"));
    		}
    	} 

    	$sql = "INSERT INTO save_list (user_id,aid_id) VALUES ('$user_id','$aid_id') ";
    	$run = mysqli_query($connect,$sql);
    	$message = "Aid saved successfully";
	    echo "<script type='text/javascript'>alert('$message');</script>";
	    header("location:my_profile.php");

?>