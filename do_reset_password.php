<?php
session_start();
include_once("includeFunction.php");
if($_SERVER['REQUEST_METHOD']=="POST"){
	
	if(isset($_POST['usr_email'])){
		$email=$_POST['usr_email'];
	}
	if(isset($_POST['password'])){
		$password=sha1($_POST['password']);
	}
	if(isset($_POST['usrcd'])){
		$usrcd=$_POST['usrcd'];
	}
	$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
	if($conn->connect_error){
		die('could not connect to the database');
	}
	else{
			$update="UPDATE users  SET default_password='$password' WHERE email='$email'";
			$query=$conn->query($update);
			if($conn->affected_rows==1){
				$_SESSION['reset_success']="Password Reset Succcessful";
				header('location:app_users.php?usrcd='.$usrcd.'');
				//echo $conn->error;
			}
			if($conn->affected_rows==0){
				$_SESSION['reset_success']="No Changes Made. New Password is same as Old Password";
				header('location:app_users.php?usrcd='.$usrcd.'');
				//echo $conn->error;
			}
			else{
					$_SESSION['reset_error']="Password Reset Was Not Successful";
					header('location:app_users.php?usrcd='.$usrcd.'');
			//	echo"error".$conn->error;
			}
	}
}





?>	