<?php

include_once("validate_user.php");
if(isset($_GET['s_id'])){
	$student_id=$_GET['s_id'];
	
}
if(isset($_GET['usrcd'])){
		$usrcd=$_GET['usrcd'];
	}
else{
	
		exit();
}
if(isset($_SESSION['username'])){
	$username=$_SESSION['username'];
}
else{
		echo "session not set";
}
	$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
	$select="SELECT user_token FROM users WHERE name='".$username."'";
	$query=$conn->query($select);
	$results=$query->fetch_array(MYSQLI_ASSOC);
	$user_token=$results['user_token'];
		if($usrcd != $user_token){
			validateUser::logout();
			
			
		}
	else{



$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
if($conn->connect_error){
	die('could not connect to the database');

}
else{
	
	$delete="DELETE FROM students WHERE student_id='$student_id'";
	$query=$conn->query($delete);
	if($conn->affected_rows==1){
		
	$_SESSION['stud_delete_success']="Student has been removed successfully from database";
	header('location:student_statistics.php?usrcd='.$usrcd.'');
	
	
		}

	}
}
?>