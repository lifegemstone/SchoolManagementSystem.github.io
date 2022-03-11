<?php
//include_once("C:/wamp/dbconn_vbsms.php");
include_once("validate_user.php");
	$s_id=array();
	if(isset($_POST['teacher_id'])){
		$teacher_id=$_POST['teacher_id'];
	}
	 if(isset($_POST['usrcd'])){
		$usrcd=$_POST['usrcd'];
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
if(isset($_POST['id'])){
	$id=$_POST['id'];
	$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
	foreach($id as $subject_id){
				$select="SELECT class_name,subject_name FROM assign_subjects WHERE id='$subject_id'";
				$query=$conn->query($select);
				while($results=$query->fetch_array(MYSQLI_ASSOC)){
						$update1="UPDATE assign_subjects set teacher_id='0' WHERE id='$subject_id'";
						$query1=$conn->query($update1);
						$s_id[]=$subject_id;
						$delete="DELETE FROM time_table WHERE class_name='{$results['class_name']}' AND subject_name='{$results['subject_name']}'";
						$query2=$conn->query($delete);
				}
				$json=json_encode($s_id);
				$_SESSION['unassign_success']="<i class='fa fa-check-square'></i> Subject/Subjects have been successfully unassigned From Teacher <a href='undo_unassign.php?s_id=".base64_encode($json)." &t_id=".$teacher_id." &usrcd=".$usrcd."'> 
				<i class='fa fa-reply'></i> Undo</a>";
				header("location:unassign_teacher.php?t_id=$teacher_id&usrcd=$usrcd");
			
			
			}
		}		
		else{
				$_SESSION['unassign_error']="<i class=''fa fa-warning></i> No Subject/Subjects Selected";
				header("location:unassign_teacher.php?t_id=$teacher_id&usrcd=$usrcd");
				
		
		
		
		
			}
		}

?>