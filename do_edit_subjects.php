<?php 
session_start(); 
include_once('includeFunction.php');
				
			if(isset($_POST['edit_row'])){
				
				if(isset($_POST['td_id'])){
					$class_id=$_POST['td_id'];
					
				}
					
					if(isset($_POST['subject_name'])){
					$subject_name=$_POST['subject_name'];
					
				}
				
					if(isset($_POST['class_name'])){
						$class_name=ucwords($_POST['class_name']);
					}
						
						$mysqli=mysqli_connect(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME) or die('could not connect to the database'.mysqli_connect_error());	
												$subject_name=mysqli_real_escape_string($mysqli,$subject_name);
												$class_name=mysqli_real_escape_string($mysqli,$class_name);
												$update="UPDATE subjects SET subject='$subject_name',class_name='$class_name' WHERE subject_id='$class_id'";
												$query=mysqli_query($mysqli,$update);
												if(mysqli_affected_rows($mysqli)==1|| mysqli_affected_rows($mysqli)==0){
													echo"success";
												}
		}	
		

?>