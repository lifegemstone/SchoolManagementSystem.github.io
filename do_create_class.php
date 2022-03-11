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
		
if($_SERVER['REQUEST_METHOD']=="POST"){
	if(!array_filter($_POST['class_name'])){
		$_SESSION['class_error']="Please at least one Class Name Must Be Filled";
		header('location:create_class.php?usrcd='.$usrcd.'');
	}

			
	else{
			$class_name=$_POST['class_name'];
			$classes=array();
			$error_class=array();
			$size=sizeof($class_name);
			$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
			if($conn->connect_error){
				die("Could not connect to the database");
			}
			else{	$error_flag=false;
					$count=0;
					foreach($class_name as $class){
						if(!empty($class)){
						$class=$conn->real_escape_string($class);
						$class=strtoupper($class);
						$select="SELECT class_name FROM school_classes WHERE class_name='$class'";
						$query_select=$conn->query($select);
						if($query_select->num_rows>0){
							$error_flag=true;
							$error_class[]=$class;//this is the class that has already been assigned...
							
						}
						else{
								$insert="INSERT INTO school_classes(class_name,form_teacher)VALUES('$class','')";
								$query=$conn->query($insert);
								if($conn->affected_rows==1){
									$success_flag=true;
									$classes[]=$class;
									$count++;
								}
						}
					}
				}
						if($error_flag==true){
							if($count==0){
							$_SESSION['error_classes']=$error_class;
							$_SESSION['class_duplication_error']="The following class/classes could not be added.A class name already exsits for the class/classes, change the class name and try again...";
							header('location:create_class.php?usrcd='.$usrcd.'');
							}
							elseif($count>0){ 
							$_SESSION['error_classes']=$error_class;
							$_SESSION['list_classes']=$classes;
							$_SESSION['class_duplication_error']="The following class/classes could not be added.A class name already exsits for the class/classes, change the class name and try again...";
							header('location:create_class.php?usrcd='.$usrcd.'');
							
							}
						}
						elseif($success_flag==true){
								$_SESSION['list_classes']=$classes;
								$_SESSION['class_insert_success']="$count Class/Classes was created successfully";
								header('location:create_class.php?usrcd='.$usrcd.'');
						}
					}
					
		}




}



?>