<?php
session_start();
include('includeFunction.php');
if($_SERVER['REQUEST_METHOD']=="POST"){
	
	if(!empty($_POST['percentage'])){
		$percentage=$_POST['percentage'];
			
	}
	else{
			$percentage=0;
	}
	
	
	$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
	if($conn->connect_error){
		die("could not connect to the database");
	}
	else{
		
			$update="UPDATE grading_percent SET percentage='$percentage'";
			$query=$conn->query($update);
			if($conn->affected_rows==1){
				$_SESSION['success']="Default Settings has been changed";
				header('location:set_grading.php');
			}
		
		
		
	}
		
	
}


?>