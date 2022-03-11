<?php
session_start();
include_once("includeFunction.php");
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
if(isset($_GET['s_id'])){
	$subject_id=$_GET['s_id'];
	$subject_id=json_decode(base64_decode($subject_id));
	print_r($subject_id);
}
if(isset($_GET['t_id'])){
	$teacher_id=$_GET['t_id'];
}
$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
	foreach($subject_id as $id){
	$select="SELECT class_name,subject_name FROM assign_subjects WHERE id='$id'";
	$query1=$conn->query($select);
	$results=$query1->fetch_array(MYSQLI_ASSOC);
	$update="UPDATE assign_subjects set teacher_id='$teacher_id' WHERE id='$id'";
	$query=$conn->query($update);
	$update="UPDATE  time_table set teacher_id='$teacher_id' WHERE class_name='{$results['class_name']}' AND subject_name='{$results['subject_name']}'";
	$query=$conn->query($update);
	}
	$_SESSION['undo_success']="<i class='fa fa-check-square'></i> Subject/Subjects have been successfully restored";
	header('location:unassign_teacher.php?t_id='.$teacher_id.' &usrcd='.$usrcd.'');


?>