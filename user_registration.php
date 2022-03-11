<?php 
session_start(); 
include_once("includeFunction.php");
if($_SERVER['REQUEST_METHOD']=='POST')
				
			{ 
				$errors=array();
				
					if(empty($_POST['name']))
					{ 
						$errors[]='please enter your name';
					
					}
					else
					{
							$name=$_POST['name'];
							
					}
					
					if(empty($_POST['email']))
						
						{
							
							$errors[]='please enter your email';
							
							
						}
						else
						{ 
							$email=$_POST['email'];
						}
						if(empty($_POST['role']))
						
						{
							
							$errors[]='please enter user role';
							
							
						} 
						else
						{ 
							$role=strtolower($_POST['role']);
							if(ucWords($role)=="Parent"){
								if(empty($_POST["tel_num"])){
									$errors[]="please enter telephone number";
								}
								else{
										$tel_num=$_POST['tel_num'];
								}
								
							}
						}
					if(empty($_POST['default_password']))
					{
						$errors[]='please enter default password';
					}
					else{$default_password=sha1($_POST['default_password']);}
					if(empty($errors)){
						$mysqli=mysqli_connect(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME) or die('could not connect to the database'.mysqli_connect_error());
										$name=mysqli_real_escape_string($mysqli,$name);
										$role=mysqli_real_escape_string($mysqli,$role);
										$email=mysqli_real_escape_string($mysqli,$email);
										$tel_num=mysqli_real_escape_string($mysqli,$tel_num);
										$default_password=mysqli_real_escape_string($mysqli,$default_password);
										$insert="INSERT INTO users(user_id,name,email,tel_num,default_password,role,date) VALUES('','$name','$email','tel_num','$default_password','$role',NOW())";
										$query=mysqli_query($mysqli,$insert);
										if(mysqli_affected_rows($mysqli)==1)
										{ 
											$_SESSION['user_success_msg']="User has been Successfully Created";
											header('location:admin.php');
										}
										else{
											echo"error".mysqli_error($mysqli);
										}
						
						
					}
					else{
							$_SESSION['user_error_msg']=$errors;
								header('location:admin.php');
							}
						
						
					}
				

?>