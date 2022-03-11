<?PHP

include_once('validate_user.php');
if($_SERVER['REQUEST_METHOD']=='POST')
		{
			 if(isset($_POST['usrcd'])){
	$usrcd=$_POST['usrcd'];
}
else{
	
		exit();
}
if(isset($_POST['subject_id'])){
	
	$subject_id=$_POST['subject_id'];
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
			$flag=array();
			$errors=array();
			if(isset($_POST['teacher_id'])){
				$teacher_id=$_POST['teacher_id'];
			}
			else{
				echo"not set";
			}
			if(isset($_POST['teacher_name'])){
				
			
				$teacher_name=$_POST['teacher_name'];
			
				
			}
			if(empty($_POST['class_name']))
			{
				
				$errors[]="please enter a name for the class";
				
				
				
			}
			else{
				
				
				$class_name=strip_tags(trim($_POST['class_name']));
				
				
				
			}
			
			if(empty($_POST['subject_name']))
			{
				
				
				$errors[]="enter a subject name";
				
				
				
				
			}
			else{
				
				
				$subject_name=strip_tags(trim($_POST['subject_name']));
				
				
				
			}
			
			if(empty($_POST['class_day'])){
				
				$errors[]="No week days was selected";
				
				
			}
				else{
					$class_days=$_POST['class_day'];
					
					
					
				}
				
				
			
			
			 if(empty($errors)){

				try{
				$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
				if($conn->connect_error)
				{
					throw new Exception("could not connect  to the database");
						
				}

				else{
						
						foreach($_POST['class_day'] as $selected_days)
						{
							
					
							switch($selected_days)
								{
									
									case "monday":
									if(!empty($_POST['mon_class_start'])&& !empty($_POST['mon_class_end']))
									{
										$week_day=$selected_days;
										$mon_start_time=$_POST['mon_class_start'];
										$mon_end_time=$_POST['mon_class_end'];
										$select1="SELECT  subject_name,week_day FROM time_table WHERE class_name='$class_name' AND subject_name='$subject_name'  AND week_day='$week_day'";
										$query1=$conn->query($select1);
										if($query1->num_rows>0){
											$_SESSION['subject_exists']="$subject_name already exists for class in time-table.<br>
											You can make changes to it under teachers profile";
											header('location:create_timetable.php?t_id='.$teacher_id.'&usrcd='.$usrcd.'');
											}
											else{
														$insert2="INSERT INTO time_table(teacher_name,teacher_id,class_name,subject_id,subject_name,week_day,start_time,end_time)VALUES('$teacher_name','$teacher_id','$class_name','$subject_id','$subject_name','$week_day','$mon_start_time','$mon_end_time')";
														$query2=$conn->query($insert2);	
														$flag[]=true;
														
												}
									}
									elseif(empty($_POST['mon_class_start'] )|| empty($_POST['mon_class_end'])){
									$_SESSION['time_error']="start_time and end_time must be filled out";
									header("location:create_timetable.php?t_id=".$teacher_id."&usrcd=$usrcd");
										
									}
									break;
									case "tuesday":
									if(!empty($_POST['tue_class_start'])&& !empty($_POST['tue_class_end']))
									{
										
										$week_day= $selected_days;
										$tue_start_time=$_POST['tue_class_start'];
										$tue_end_time=$_POST['tue_class_end'];
										$select1="SELECT  subject_name,week_day  FROM time_table WHERE class_name='$class_name' AND subject_name='$subject_name' AND week_day='$week_day'";
										$query1=$conn->query($select1);
										if($query1->num_rows>0){
											$_SESSION['subject_exists']="subject already exists for class in time-table";
											header('location:create_timetable.php?t_id='.$teacher_id.'&usrcd='.$usrcd.'');
										}
										else{
											
									$insert3="INSERT INTO time_table(teacher_name,teacher_id,class_name,subject_id,subject_name,week_day,start_time,end_time)VALUES('$teacher_name','$teacher_id','$class_name','$subject_id','$subject_name','$week_day','$tue_start_time','$tue_end_time')";
									$query3=$conn->query($insert3);	
									$flag[]=true;
										
										}
									}
									elseif(empty($_POST['tue_class_start'] )|| empty($_POST['tue_class_end'])){
									$_SESSION['time_error']="start_time and end_time must be filled out";
									header("location:create_timetable.php?t_id=".$teacher_id."&usrcd=$usrcd");
										
									}
									break;
									case "wednessday":
									if(!empty($_POST['wed_class_start'])&& !empty($_POST['wed_class_end']))
									{
										
										$week_day= $selected_days;
										$wed_start_time=$_POST['wed_class_start'];
										$wed_end_time=$_POST['wed_class_end'];
										$select1="SELECT  subject_name,week_day  FROM time_table WHERE class_name='$class_name' AND subject_name='$subject_name' AND week_day='$week_day'";
										$query1=$conn->query($select1);
										if($query1->num_rows>0){
											$_SESSION['subject_exists']="subject already exists for class in time-table";
											header('location:create_timetable.php?t_id='.$teacher_id.'&usrcd='.$usrcd.'');
										}
										else{
														$insert4="INSERT INTO time_table(teacher_name,teacher_id,class_name,subject_id,subject_name,week_day,start_time,end_time)VALUES('$teacher_name','$teacher_id','$class_name','$subject_id','$subject_name','$week_day','$wed_start_time','$wed_end_time')";
														$query4=$conn->query($insert4);	
														$flag[]=true;
													
											}
										}
										elseif(empty($_POST['wed_class_start'] )|| empty($_POST['wed_class_end'])){
									$_SESSION['time_error']="start_time and end_time must be filled out";
									header("location:create_timetable.php?t_id=".$teacher_id."&usrcd=$usrcd");
										
									}
									break;
									case "thursday":
									if(!empty($_POST['thu_class_start'])&& !empty($_POST['thu_class_end']))
									{
										
										$week_day= $selected_days;
										$thu_start_time=$_POST['thu_class_start'];
										$thu_end_time=$_POST['thu_class_end'];
										$select1="SELECT  subject_name,week_day  FROM time_table WHERE class_name='$class_name' AND subject_name='$subject_name' AND week_day='$week_day'";
										$query1=$conn->query($select1);
											if($query1->num_rows>0){
											$_SESSION['subject_exists']="subject already exists for class in time-table";
											header('location:create_timetable.php?t_id='.$teacher_id.'&usrcd='.$usrcd.'');
										}
										else{
												
												$insert5="INSERT INTO time_table(teacher_name,teacher_id,class_name,subject_id,subject_name,week_day,start_time,end_time)VALUES('$teacher_name','$teacher_id','$class_name','$subject_id','$subject_name','$week_day','$thu_start_time','$thu_end_time')";
												$query5=$conn->query($insert5);	
												$flag[]=true;
												
											}
									}
									elseif(empty($_POST['thu_class_start'] )|| empty($_POST['thu_class_end'])){
									$_SESSION['time_error']="start_time and end_time must be filled out";
									header("location:create_timetable.php?t_id=".$teacher_id."&usrcd=$usrcd");
										
									}
									break;
									case "friday":
									if(!empty($_POST['fri_class_start'])&& !empty($_POST['fri_class_end']))
									{
										
										$week_day= $selected_days;
										$fri_start_time=$_POST['fri_class_start'];
										$fri_end_time=$_POST['fri_class_end'];
											$select1="SELECT  subject_name,week_day  FROM time_table WHERE class_name='$class_name' AND subject_name='$subject_name' AND week_day='$week_day'";
										$query1=$conn->query($select1);
											if($query1->num_rows>0){
											$_SESSION['subject_exists']="subject already exists for class in time-table";
											header('location:create_timetable.php?t_id='.$teacher_id.'&usrcd='.$usrcd.'');
										}
										else{
												$insert6="INSERT INTO time_table(teacher_name,teacher_id,class_name,subject_id,subject_name,week_day,start_time,end_time)VALUES('$teacher_name','$teacher_id','$class_name','$subject_id','$subject_name','$week_day','$fri_start_time','$fri_end_time')";
												$query6=$conn->query($insert6);	
												$flag[]=true;
													
											}
									}
									elseif(empty($_POST['fri_class_start'] )|| empty($_POST['fri_class_end'])){
									$_SESSION['time_error']="start_time and end_time must be filled out";
									header("location:create_timetable.php?t_id=".$teacher_id."&usrcd=$usrcd");
										
									}
									break;
									default:
									echo "nothing to show ";
								}
					
						}
						$count=0;
						foreach($flag as $indicator){
							if($indicator==true){
							$count++;
							}
						}
						$size=sizeof($flag);
						if(($count==$size)&& ($size!=0)){
					$success_msg="$subject_name was successfully added to Time Table";
					$_SESSION['success_msg']=$success_msg;
					header("location:create_timetable.php?t_id=".$teacher_id."&usrcd=$usrcd");
						}
					
					
					}		 
				}
				 catch(Exception $e)
				 {
					 
					echo $e->getMessage(); 
					 
				
				}
			 }
			 else{
				$_SESSION['errors']=$errors;	
					header('location:create_timetable.php?t_id='.$teacher_id.'&usrcd='.$usrcd.'');
			 }
			
		 }
			
		
	}
	
	
?>

