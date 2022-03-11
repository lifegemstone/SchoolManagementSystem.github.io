<?php 
session_start(); 
include_once("includeFunction.php");
if($_SERVER['REQUEST_METHOD']=='POST')
				
			{
			
				
				
				$errors=array();
				$extension=array("image/jpeg","image/png","image/pjpeg","image/gif","image/jpg");
				$savepath= "C:\wamp\www\SMS\studentImages";
					
					if(isset($_POST['usrcd'])){
						$usrcd=$_POST['usrcd'];
					}
					if(empty($_POST['student_name']))
					{ 
						$errors[]='please enter student name';
					
					}
					else
					{
							$student_name=$_POST['student_name'];
							
					}
					
					if(empty($_POST['sex']))
						
						{
							
							$errors[]='please enter sex';
							
							
						}
						else
						{ 
							$sex=$_POST['sex'];
						}
					if(empty($_POST['date_birth']))
					{
						$errors[]='please enter Date Of Birth';
					}
					else{$date_birth=$_POST['date_birth'];}
					if(empty($_POST['class_name']))
					{
						$errors[]='student must be assigned to a class';
					}
					else{$class_name=$_POST['class_name'];}
					if(empty($_POST['parent_name']))
					{
						$errors[]='parent name must be filled';
					}
					else{$parent_name=$_POST['parent_name'];}
					if(empty($_POST['home_address']))
					{
						$errors[]='home address must be filled';
					}
					else{$home_address=$_POST['home_address'];}
					if(empty($_POST['telephone_no']))
					{
						$errors[]='parent telephone number must be filled';
					}
					else{$telephone_no=$_POST['telephone_no'];}
					
					
					
					if(!empty($_FILES['img']))
					{
						if(in_array($_FILES['img']['type'],$extension))
						{ 
							if($_FILES['img']['size']>5000000)
							{$errors[]='image size should not be more than 5MB';}
							else{
									$filename=$savepath ."/".$_FILES['img']['name'];
									$student_img=$_FILES['img']['name'];
									if(move_uploaded_file($_FILES['img']['tmp_name'],$filename)) //logic that uploads image to the database
									{
										echo"";
									}
									else
									{$errors[]='sorry image could not be uploaded please try again';}
								}
						}
						else
						{ $errors[]='sorry file must be of either .jpeg .jpg .png .gif type';}
					}
					else{$errors[]='kindly select a picture to upload';}
					$now=time();
					$start_year=date('Y',$now);
					$end_year=$start_year+1;
					if(empty($errors)){
						$mysqli=mysqli_connect(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME) or die('could not connect to the database'.mysqli_connect_error());
										$insert="INSERT INTO students(student_name,sex,date_birth,class_name,parent_name,home_address,telephone_no,student_img,student_token,date) VALUES('$student_name','$sex','$date_birth','$class_name','$parent_name','$home_address','$telephone_no','$student_img','',NOW())";
										$query=mysqli_query($mysqli,$insert);
										$select="SELECT student_id FROM students WHERE student_name='$student_name' AND telephone_no='$telephone_no'";
										$query_select=mysqli_query($mysqli,$select);
										if(mysqli_num_rows($query_select)==1)
										{ 
									
											$result=mysqli_fetch_array($query_select,MYSQLI_ASSOC);
											$stud_id=$result['student_id'];
											$student_token=(substr("$student_name",0,5)."_$stud_id");
											$update="UPDATE students SET student_token='$student_token' WHERE student_id='$stud_id'";
											$query=mysqli_query($mysqli,$update);
											$select="SELECT student_id FROM class_session WHERE student_id='$stud_id'";
											$query=mysqli_query($mysqli,$select);
											if(mysqli_num_rows($query)<1){
											$insertIntoClassSession="INSERT INTO class_session(class_name,student_id,start_year,end_year)VALUES('$class_name','$stud_id','$start_year','$end_year')";
											$query=mysqli_query($mysqli,$insertIntoClassSession);
											if(mysqli_affected_rows($mysqli)==1){
											//$_SESSION['username']=$this->admin_name;
											$_SESSION['stud_success_msg']="Student was successfully added.";
											header('location:registration.php?usrcd='.$usrcd.'');
											}
												else{"echo an error occurred".mysqli_error($mysqli);}
											
											}
											/*else{"echo an error occurred".mysqli_error($mysqli);
											}*/
									
										}
						
					}
					else{
						   // foreach($errors as $error){
								
							//	echo"<li>$error</li>";
						//	}
							$_SESSION['stud_error_msg']=$errors;
							header('location:registration.php?usrcd='.$usrcd.'');
							}
						
						
					}
				

?>