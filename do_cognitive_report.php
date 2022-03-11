<?php
session_start();
include_once("includeFunction.php");
$sum=0;
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
		//echo"$term";
	}
	else{
			$term="";
	
	}
	
	if(isset($_POST['other_CA'])){
		$other_CA=$_POST['other_CA'];
		
	}
	else{
		$other_CA="";
	}
	if(isset($_POST['CA'])){
		$CA=$_POST['CA'];
	}
	else{
		$CA="";
	}
	if(isset($_POST['EXAMS'])){
		$exams=$_POST['EXAMS'];
	}

	if(isset($_POST['firstTerm_score'])){
		$firstTerm_score=explode(",",$_POST['firstTerm_score'][0]);
	}
	else{
			$firstTerm_score="";
	}
	if(isset($_POST['grade_firstTerm'])){
		$firstTerm_grade=explode(",",$_POST['grade_firstTerm'][0]);
		//print_r($firstTerm_grade);
	}
	else{
		$firstTerm_grade="";
	}
	if(isset($_POST['remarks'])){
		$remarks=explode(",",$_POST['remarks'][0]);
		//print_r($remarks);
	}
	else{
		$remarks="";
	}
	if(isset($_POST['subject_name'])){
		$subject_name=json_decode($_POST['subject_name']);
		$count=sizeof($subject_name);
	
	}
	$now=time();
	$start_year=date('Y',$now);
	$end_year=$start_year+1;
	$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
	if($conn->connect_error){
		die('could not connect to the database');
	}
	else{
		
		
		$select="SELECT * FROM first_term WHERE student_id='$student_id' AND class_name='$class_name'";
		$query=$conn->query($select);
		if($query->num_rows>0){
			$_SESSION['error']="Sorry a record has already been inserted for this student. ";
			header("location:compute_cognitive_report.php?s_id=$student_id &c_name=$class_name &f_tr=$first_term");
		}
	else{
		for($i=0;$i<$count;$i++){
			$subject=$subject_name["$i"];
			$otherCA=$other_CA["$i"];
			$stud_CA=$CA["$i"];
			$stud_exam=$exams["$i"];
			$total_score=$firstTerm_score["$i"];
			$sum +=$total_score;
			$grade=$firstTerm_grade["$i"];
			$remark=$remarks["$i"];
		$insert1="INSERT INTO first_term(subjects,other_CA,CA,exams,total_score,grade,remark,student_id,class_name,start_year,end_year)VALUES('$subject','$otherCA','$stud_CA','$stud_exam','$total_score','$grade','$remark','$student_id','$class_name','$start_year','$end_year')";
		$query1=$conn->query($insert1); 
		if($conn->affected_rows>0){
			echo"";
			
		}
		else{
			 $conn->error;
		}
	
	}
	$select1="SELECT * FROM totalscore WHERE student_id='$student_id' AND class_name='$class_name' AND term='$term' AND start_year='$start_year' AND end_year='$end_year'";
	$query1=$conn->query($select1);
	if($query1->num_rows>0){
		
		$_SESSION['totalscore_error']="Sorry a record has already been inserted for this student. ";
		header("location:compute_cognitive_report.php?s_id=$student_id &c_name=$class_name &f_tr=$term");
		
	}
	else{
	$insert2="INSERT INTO totalscore(student_id,totalscore,class_name,term,start_year,end_year)VALUES('$student_id','$sum','$class_name','$term','$start_year','$end_year')";
	$query2=$conn->query($insert2);
	if($conn->affected_rows==1){
		
		$_SESSION['success']="<i class='fa fa-check-circle text-success'></i>Cognitive Report was Successfully Posted";
		header("location:compute_cognitive_report.php?s_id=$student_id &c_name=$class_name &f_tr=$term");
		
	}
	else{
		
		echo"An Error has Occurred".$conn->error;


				}	

			}
	
		}


	}
}
?>