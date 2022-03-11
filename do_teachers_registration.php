<?php 
session_start(); 
include_once("includeFunction.php");
if($_SERVER['REQUEST_METHOD']=='POST')
				
			{ 
				$errors=array();
				$extension=array("image/jpeg","image/png","image/pjpeg","image/gif","image/jpg");
				$savepath= "C:\wamp\www\SMS\\teachersImages";
					if(isset($_POST['usrcd'])){
						$usrcd=$_POST['usrcd'];
					}
					if(empty($_POST['teacher_name']))
					{ 
						$errors[]='please enter teacher name';
					
					}
					else
					{
							$teacher_name=$_POST['teacher_name'];
							
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
					if(empty($_POST['home_address']))
					{
						$errors[]='please enter Home Address';
					}
					else{$home_address=$_POST['home_address'];}
					if(empty($_POST['telephone']))
					{
						$errors[]='please enter telephone number';
					}
					else{$telephone=$_POST['telephone'];}
					if(empty($_POST['email']))
					{
						$email="";
					}
					else{$email=$_POST['email'];}
					
					
					if(!empty($_FILES['img']))
					{
						if(in_array($_FILES['img']['type'],$extension))
						{ 
							if($_FILES['img']['size']>5000000)
							{$errors[]='image size should not be more than 5MB';}
							else{
									$filename=$savepath ."/".$_FILES['img']['name'];
									$teacher_img=$_FILES['img']['name'];
									if(move_uploaded_file($_FILES['img']['tmp_name'],$filename))
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
					if(empty($errors)){
						$mysqli=mysqli_connect(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME) or die('could not connect to the database'.mysqli_connect_error());
										$insert="INSERT INTO teachers(teacher_name,sex,date_birth,home_address,telephone,email,teacher_img,date) VALUES('$teacher_name','$sex','$date_birth','$home_address','$telephone','$email','$teacher_img',NOW())";
										$query=mysqli_query($mysqli,$insert);
										if(mysqli_affected_rows($mysqli)==1)
										{ 
											//$_SESSION['username']=$this->admin_name;
											$_SESSION['success_msg']="Teacher was successfully added";
											header('location:teachers_registration.php?usrcd='.$usrcd.'');
										}
										else{"echo an error occurred".mysqli_error($mysqli);}
						
						
					}
					else{
						   // foreach($errors as $error){
								
							//	echo"<li>$error</li>";
						//	}
							$_SESSION['error_msg']=$errors;
							//header('location:teachers_registration.php?usrcd='.$usrcd.'');
							}
						
						
					}
				

?>