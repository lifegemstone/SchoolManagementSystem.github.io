<?php

include_once("validate_user.php");
	if(isset($_GET['usrcd'])){
		$usrcd=$_GET['usrcd'];
	
	}
else{
	
		exit();
}
if(isset($_GET['usr_nxmx'])){//'usr_nxmx' denotes user_name
	$username=$_GET['usr_nxmx'];
}
else{
	
	  
	    echo "Username is not set";
	   
}
	$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
	$select="SELECT user_token FROM users WHERE name='$username'";
	$query=$conn->query($select);
	$results=$query->fetch_array(MYSQLI_ASSOC);
	$user_token=$results['user_token'];
	if($usrcd!=$user_token){
			validateUser::logout();
		}
if(isset($_GET['s_id'])){
	$subjects_name=$_GET['s_id'];
	$subjects_name=json_decode(base64_decode($subjects_name));
	//print_r($subjects_name);
}
if(isset($_GET['c_name'])){
	$class_name=$_GET['c_name'];
	$class_name=json_decode(base64_decode($class_name));
    //print_r($class_name);
}
$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
	$i=0;
	foreach($subjects_name as $key=>$value){
		$className=$class_name["$i"];
	$INSERT="INSERT INTO subjects(subject,class_name)VALUES('$value','$className')";
	$query=$conn->query($INSERT);
	$i++;
	}
	$_SESSION['undo_success']="<i class='fa fa-check-square'></i> Subject/Subjects have been successfully restored";
	header('location:all_subjects.php?usrcd='.$usrcd.'');
    
?>