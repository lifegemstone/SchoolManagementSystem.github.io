<?php  

include_once('validate_user.php');
if($_SERVER['REQUEST_METHOD']=='POST')
				
			{ 
				$errors=array();
				$extension=array("image/jpeg","image/png","image/pjpeg","image/gif","image/jpg");
				$savepath= "C:\wamp\www\SMS\\teachersImages";
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
								if(isset($_POST['teacher_id'])){
									$teacher_id=$_POST['teacher_id'];
				
								}
								else{
									exit;
								}
								if(isset($_POST['teacher_img'])){
									$img=$_POST['teacher_img'];
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
									{ 
										if($_FILES['img']['type']!="" && !in_array($_FILES['img']['type'],$extension)){
											
												$errors[]='sorry file must be of either .jpeg .jpg .png .gif type';
												}
												else{
									
												$teacher_img=$img;
												
												}
										
									}
								}
								
								if(empty($errors)){
									$mysqli=mysqli_connect(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME) or die('could not connect to the database'.mysqli_connect_error());	
														$update="UPDATE teachers SET teacher_name='$teacher_name',sex='$sex',date_birth='$date_birth',home_address='$home_address',telephone='$telephone',email='$email',teacher_img='$teacher_img' WHERE teacher_id='$teacher_id'";
														$query=mysqli_query($mysqli,$update);
														if(mysqli_affected_rows($mysqli)==1){
														$_SESSION['infoEdit_msg']="Teacher personal information was successfully edited";
														header("location:edit_teacher.php?t_id=$teacher_id&usrcd=$usrcd");
														}
												
														else{
																
																$_SESSION['noEdit_msg']="No Changes Where Made";
													header("location:edit_teacher.php?t_id=$teacher_id&usrcd=$usrcd");
														
														}
									
								}
								else{
										$_SESSION['infoEditError_msg']=$errors;
										header("location:edit_teacher.php?t_id=$teacher_id&usrcd=$usrcd");
										}
									
									
								}
				
					}
?>