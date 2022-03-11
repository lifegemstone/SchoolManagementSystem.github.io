<?php

 include_once('validate_user.php');
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
			if(isset($_POST['submit'])){
				if(isset($_POST['teacher_id'])){
					$teacher_id=$_POST['teacher_id'];
				}
				$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
				if($conn->connect_error){
					die("could not connect to the database");
				}
				else{
					$delete="Delete  From teachers WHERE teacher_id='$teacher_id' ";
					$query=$conn->query($delete);
					if($conn->affected_rows>0){
						$select="SELECT subject FROM subjects WHERE teacher_id='$teacher_id'";
						$query=$conn->query($select);
						if($query->num_rows>0){
							while($results=$query->fetch_array(MYSQLI_ASSOC)){
								$update="UPDATE subjects SET teacher_id='0' WHERE teacher_id='$teacher_id' AND subject_id='{$results['subject_id']}'";
								$query=$conn->query($update);
							}
						$_SESSION["delete_success"]="Teacher has been successfully removed";
						header("location:teachers_statistics.php?usrcd=$usrcd");
						}
						else{
						$_SESSION["delete_success"]="Teacher has been successfully removed";
						header("location:teachers_statistics.php?usrcd=$usrcd");
						
						}
					}
					else{
							
							
							echo"an error has occurred".$conn->error;
							
					}
				
				
				}


			}
		}
	

?>