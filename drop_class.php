<?php
session_start();
include_once("includeFunction.php");
if(isset($_GET['c_id'])){
	$class_id=$_GET['c_id'];
}
if(isset($_GET['usrcd'])){
	$usrcd=$_GET['usrcd'];
}
$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
if($conn->connect_error){
	die("could not connect to the database");
}
else{
		$delete="DELETE FROM school_classes WHERE class_id=$class_id";
		$query_delete=$conn->query($delete);
		if($conn->affected_rows==1){
			$_SESSION['deleted_successful']="Class has been Successfully Deleted";
			header('location:view_classes.php?usrcd='.$usrcd.'');
		}
		else{
				$_SESSION['deleted_error']="An error occurred while trying to delete class please try again";
				header('location:view_classes.php?usrcd='.$usrcd.'');
		}


}


?>