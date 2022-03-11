<?php
include_once("includeFunction.php");
include_once('validate_user.php');
if(isset($_POST['edit_row'])){
		
	if(isset($_POST['subject_name'])){
		$subject_name=$_POST['subject_name'];
		
	}
		if(isset($_POST['class_name'])){
		$class_name=$_POST['class_name'];
		
	}
		if(isset($_POST['start_time'])){
		$start_time=$_POST['start_time'];
		
	}
		if(isset($_POST['end_time'])){
		$end_time=$_POST['end_time'];
		
	}
	if(isset($_POST['td_id'])){
		$td_id=$_POST['td_id'];
		
	}
	$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
	if($conn->connect_error){
		die('could not connect to the database');
	}
	else{
		
		$update="UPDATE time_table SET class_name='$class_name', subject_name='$subject_name',start_time='$start_time',end_time='$end_time' WHERE day_id='$td_id'";
		$query=$conn->query($update);
		if($conn->affected_rows==1){
			echo"success";
		}
		elseif($conn->affected_rows==0){
			echo"success";
		}
	}
}

//delete from database
if(isset($_POST['delete_row'])){
	if(isset($_POST['td_id'])){
		$td_id=$_POST['td_id'];
		
	}
	$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
	if($conn->connect_error){
		die('could not connect to the database');
	}
	else{
		
		$delete="DELETE FROM time_table WHERE day_id='$td_id'";
		$query=$conn->query($delete);
		if($conn->affected_rows==1){
			echo"success";
		
		
			}
	}
}



		


?>