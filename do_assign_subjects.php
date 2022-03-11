<?php 

include_once('validate_user.php');
if($_SERVER['REQUEST_METHOD']=='POST'){
			$error=array();
			
			if(isset($_POST['id'])){
				
				$subjects_id=$_POST['id'];
				//print_r($subjects_id);
			
			}
			else{
				
				$error[]="<i class='fa fa-warning'></i> No Subject/Subjects Selected";
				
			}
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
								$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
								if($conn->connect_error){
									die("could not connect to the database");
									
								}
							else{
								
								foreach($subjects_id as $subject_id){
								//echo $subject_id;
								$select="SELECT subject,class_name FROM subjects WHERE subject_id='$subject_id'";
								$query=$conn->query($select);
								if($results=$query->fetch_array(MYSQLI_ASSOC)){
									$select2="SELECT subject_name,class_name FROM assign_subjects WHERE subject_name='{$results['subject']}' AND class_name='{$results['class_name']}' AND teacher_id != 0 ";
									$query2=$conn->query($select2);
									if($query2->num_rows>0){
										$error[]="{<strong>Subject Name:</strong>{$results['subject']}}  {<strong>class name:</strong>{$results['class_name']} } has been Assigned already";
									}
									else{
										$select3="SELECT subject_name,class_name FROM assign_subjects WHERE subject_name='{$results['subject']}' AND class_name='{$results['class_name']}' AND teacher_id='0'";
										$query3=$conn->query($select3);
										if($query3->num_rows>0){
										$update="UPDATE assign_subjects set teacher_id='$teacher_id' WHERE class_name='{$results['class_name']}' AND subject_name='{$results['subject']}'";
										$update_query=$conn->query($update);
										}
										else{
												$insert="INSERT INTO assign_subjects(subject_name,subject_id,class_name,teacher_id)VALUES('{$results['subject']}','$subject_id','{$results['class_name']}','$teacher_id')";
												$query4=$conn->query($insert);
										}
									}
									
				
								}	
								
						}
						if(!empty($error)){
							$_SESSION['assign_err']=$error;
							header('location:assign_subjects.php?t_id='.$teacher_id.'&usrcd='.$usrcd.'');
						}
						else{
							
							$_SESSION['Assign_success']="Subject/Subjects has been successfully assigned to Teacher";
							header("location:assign_subjects.php?t_id=".$teacher_id."&usrcd=$usrcd");
							
						}
						
					}
				}
}