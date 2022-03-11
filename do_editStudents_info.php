<?php 
//session_start(); 

include_once('validate_user.php');
if($_SERVER['REQUEST_METHOD']=='POST')
				
	{ 
			
			
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
				$errors=array();
				$extension=array("image/jpeg","image/png","image/pjpeg","image/gif","image/jpg");
				$savepath= "C:\wamp\www\SMS\studentImages";
					if(isset($_POST['student_id'])){
						$student_id=$_POST['student_id'];
	
					}
					else{
						exit;
					}
					if(isset($_POST['student_img'])){
						$img=$_POST['student_img'];
					}
					else{
						exit();
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
						if(empty($_POST['class_name']))
						
						{
							
							$errors[]='please enter class name';
							
							
						}
						else
						{ 
							$class_name=$_POST['class_name'];
						}
					if(empty($_POST['date_birth']))
					{
						$errors[]='please enter Date Of Birth';
					}
					else{$date_birth=$_POST['date_birth'];}
					if(empty($_POST['parent_name']))
						
						{
							
							$errors[]='please enter parent name';
							
							
						}
						else
						{ 
							$parent_name=$_POST['parent_name'];
						}
					if(empty($_POST['home_address']))
					{
						$errors[]='please enter Home Address';
					}
					else{$home_address=$_POST['home_address'];}
					if(empty($_POST['telephone_no']))
					{
						$errors[]='please enter parents telephone number';
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
						
									$student_img=$img;
									//echo $student_img;
									}
						}
					}
					
					
					if(empty($errors)){
						$mysqli=mysqli_connect(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME) or die('could not connect to the database'.mysqli_connect_error());	
											$update="UPDATE students SET student_name='$student_name',sex='$sex',date_birth='$date_birth',class_name='$class_name',parent_name='$parent_name',home_address='$home_address',telephone_no='$telephone_no',student_img='$student_img' WHERE student_id='$student_id'";
											$query=mysqli_query($mysqli,$update);
											if(mysqli_affected_rows($mysqli)==1){
											$_SESSION['stud_edit_success_msg']="Student  information was successfully edited";
											header("location:edit_student.php?s_id=$student_id&usrcd=$usrcd");
											}
									
											else{
											$_SESSION['stud_edit_error_msg']="No Changes Where Made";
											header("location:edit_student.php?s_id=$student_id&usrcd=$usrcd");
											}
						
					}
					else{
							$_SESSION['stud_errors']=$errors;
							header("location:edit_student.php?s_id=$student_id&usrcd=$usrcd");
							}
						
						
					}
				

?>