<?php
session_start();
include_once("includeFunction.php");
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
	
	if(isset($_POST['sch_open'])){
		$sch_open=$_POST['sch_open'];
	}
	else{
		$sch_open="";
	}
	if(isset($_POST['num_present'])){
		$num_present=$_POST['num_present'];
	}
	else{
		$num_present="";
	}
	if(isset($_POST['num_absent'])){
		$num_absent=$_POST['num_absent'];
	}
	else{
		$num_absent="";
	}
	if(isset($_POST['start_term'])){
		$start_term=$_POST['start_term'];
	}
	else{
		$start_term="";
	}
	if(isset($_POST['end_term'])){
		$end_term=$_POST['end_term'];
	}
	else{
		$end_term="";
	}
	if(isset($_POST['teacher_comment'])){
		$teacher_comment=$_POST['teacher_comment'];
	}
	else{
		$teacher_comment="";
	}
	if(isset($_POST['height_start'])){
		$height_start=$_POST['height_start'];
	}
	else{
		$height_start="";
	}
	if(isset($_POST['weight_start'])){
		$weight_start=$_POST['weight_start'];
	}
	else{
		$weight_start="";
	}
	if(isset($_POST['height_end'])){
		$height_end=$_POST['height_end'];
	}
	else{
		$height_end="";
	}
	if(isset($_POST['weight_end'])){
		$weight_end=$_POST['weight_end'];
	}
	else{
		$weight_end="";
	}
	
	
	
	$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
	if($conn->connect_error){
		die('could not connect to the database');
	}
	else{
		
		$select="SELECT * FROM other_params WHERE student_id='$student_id' AND term='$term' AND class_name='$class_name'";
		$query=$conn->query($select);
		if($query->num_rows>0){
			$_SESSION['error']="Sorry a record has already been inserted for this user. ";
		header("location:compute_assessment_report.php?s_id=$student_id &c_name=$class_name &f_tr=$term");
		}
		else{		
				$insert3="INSERT INTO other_params(times_schOpen,times_present,times_absent,term_begins,term_ends,teachers_comment,height_start,weight_start,height_end,weight_end,student_id,term,class_name)VALUES('$sch_open','$num_present','$num_absent','$start_term','$end_term','$teacher_comment','$height_start','$weight_start','$height_end','$weight_end','$student_id','$term','$class_name')";
				$query3=$conn->query($insert3);
				if($conn->affected_rows==1){
					$_SESSION['success']="<i class='fa fa-check-circle text-success'></i>Assessment Report Was Successfully Posted";
					header("location:compute_assessment_report.php?s_id=$student_id &c_name=$class_name &f_tr=$term ");
				}
			else{
					echo $conn->error;
				}


			}

		}

}
?>