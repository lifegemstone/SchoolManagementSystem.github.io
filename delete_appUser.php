<?php
include_once("includeFunction.php");
if(isset($_GET['usr_id'])&&isset($_GET['usrcd'])){
	
	$usr_id=$_GET['usr_id'];
	$usrcd=$_GET['usrcd'];
}
else{
	
		exit();
}
	
$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
if($conn->connect_error){
		die('could not connect to the database');
	}
else{
	
		$drop_user="DELETE FROM users WHERE user_id='$usr_id'";
		$query=$conn->query($drop_user);
		if($conn->affected_rows==1){
			header('location:app_users.php?usrcd='.$usrcd.'');
		}
}



?>