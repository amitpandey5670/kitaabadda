<?php

$server =  'localhost';
$username = "root";
$password = "";
$database = "kitaab_adda";

try{
	$connect = mysqli_connect($server,$username,$password,$database);
	if($connect){
	}
}catch(Exception $errormsg){
	echo $errormsg -> getMessage();
}

?>


