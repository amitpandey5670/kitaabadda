<?php
  session_start();
  if($_SESSION['admin']){
  	  unset($_SESSION['admin']);
      session_destroy();
      header("location:login.php");  

  }


?>