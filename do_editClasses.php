<?php
include_once("includeFunction.php");
if(isset($_POST['save_class'])){
	
	if(isset($_POST['class_name'])){
		$class_name=$_POST['class_name'];
	}
	if(isset($_POST['class_id'])){
		$class_id=$_POST['class_id'];
	}
	
	$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
	if($conn->connect_error){
		die('could not connect to the database');
	}
	else{
		
		$update="UPDATE school_classes SET class_name='$class_name' WHERE class_id='$class_id'";
		$query=$conn->query($update);
		if($conn->affected_rows==1){
			echo"success";
		}
		elseif($conn->affected_rows==0){
			echo"success";
		}
	}
}



if(isset($_POST['delete_class'])){
	
	if(isset($_POST['class_name'])){
		$class_name=$_POST['class_name'];
	}
	if(isset($_POST['class_id'])){
		$class_id=$_POST['class_id'];
	}
	
	$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
	if($conn->connect_error){
		die('could not connect to the database');
	}
	else{
		
		$delete="DELETE FROM school_classes WHERE class_id='$class_id'";
		$query=$conn->query($delete);
		if($conn->affected_rows==1){
			echo"success";
		}
		//elseif($conn->affected_rows==0){
		//	echo"success";
		//}
	}
}












?>