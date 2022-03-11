<?php 
session_start(); 
include_once('includeFunction.php');
if($_SERVER['REQUEST_METHOD']=='POST')
				
			{ 	$subject_error=array();
				$subject_success=array();
				$errors=array();
				if(isset($_POST['usrcd'])){
					$usrcd=$_POST['usrcd'];
				}
				if(isset($_POST['teacher_id'])){
					$teacher_id=$_POST['teacher_id'];
					
				}
				if(!empty($_POST['class_name'])){
					
					$class_name=$_POST['class_name'];
				}
				else{
						$errors[]="Class Name cannot be empty";
					
					
				}
					
				if(!array_filter($_POST['subject'])){
						$errors[]='One or More Subjects must be Filled';
						
					}
				else{
						$subjects=$_POST['subject'];
				}
				
					if(empty($errors)){
						$mysqli=mysqli_connect(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME) or die('could not connect to the database'.mysqli_connect_error());	
												foreach($subjects as $subject){
													if(!empty($subject)){
														$subject=strtoupper($subject);
												$select="SELECT subject FROM subjects WHERE subject='$subject' and class_name='$class_name'";
												$query=mysqli_query($mysqli,$select);
												if(mysqli_num_rows($query)>0){
													$subject_error[]=$subject;
													
												}
												else{
												$insert="INSERT INTO subjects(subject,class_name)VALUES('$subject','$class_name')";
												$query=mysqli_query($mysqli,$insert);
													$subject_success[]=$subject;
												}
												if(sizeof($subject_error)!=0){
												$_SESSION['subject_error']=$subject_error;}
												if(sizeof($subject_success)!=0){
												$_SESSION['subject_success']=$subject_success;}
											header('location:add_subjects.php?usrcd='.$usrcd.'');
										}
							}
					}
					else{
						    
							$_SESSION['subjects_error_msg']=$errors;
							header('location:add_subjects.php?usrcd='.$usrcd.'');
						}
						
						
			}	
		

?>