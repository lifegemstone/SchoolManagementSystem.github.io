<?php
session_start();
include_once("includeFunction.php");
$sum=0;
$count=0;
if($_SERVER['REQUEST_METHOD']=='POST'){
	
	if(isset($_POST['student_id'])){
		$student_id=$_POST['student_id'];
	}
	else{
		$student_id="";
	}
	
	if(isset($_POST['class_name'])){
		$class_name=$_POST['class_name'];
	}
	else{
		$class_name="";
	}
	if(isset($_POST['term'])){
		$term=$_POST['term'];
		
	}
	else{
		$term="";
	
	}
	
	if(isset($_POST['params'])){
		$params=json_decode($_POST['params']);
		$count_params=sizeof($params);
	//print_r($params);
	}
	if(isset($_POST['param_grade'])){
		$param_grade=$_POST['param_grade'];
		//print_r($param_grade);
	}
	$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
	if($conn->connect_error){
		die('could not connect to the database');
	}
	else{
		$select="SELECT * FROM observation_conduct_grades WHERE student_id='$student_id' AND class_name='$class_name' AND term='$term'";
		$query=$conn->query($select);
		if($query->num_rows>0){
			$_SESSION['error']="<i class='fa fa-check-circle'></i> Sorry a record already exist for this student";
			header("location:compute_observation_conduct_report.php?s_id=$student_id &c_name=$class_name &f_tr=$term");
		}
		else{
				
				for($i=0;$i<$count_params;$i++){
					
					$GLOBALS['count']++;
						$conduct_param=$params["$i"];
						$grade=$param_grade["$i"];
					$insert4="INSERT INTO observation_conduct_grades(student_id,params,grade,class_name,term,teachers_comment)VALUES('$student_id','$conduct_param','$grade','$class_name','$term','')";
					$query4=$conn->query($insert4); 
					if($conn->affected_rows>1){
						echo"";
					}
		else{
			
			//echo"An error has ocurred".$conn->error;
			
			
			
			}
			if($GLOBALS['count']+1==$count_params){
				
				$_SESSION['success']="<i class='fa fa-check-circle text-success'></i> Observation of Conduct Report was Successfully Posted";
				header("location:compute_observation_conduct_report.php?s_id=$student_id &c_name=$class_name &f_tr=$term");
				
				
			}
		
	}


}

}


}
?>