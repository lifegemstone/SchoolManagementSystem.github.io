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
	if(isset($_POST['second_term'])){
		$second_term=$_POST['second_term'];
	}
	else{
		$second_term="";
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

	if(isset($_POST['score_secondTerm'])){
		$score_secondTerm=explode(",",$_POST['score_secondTerm'][0]);//This converts the first value which is the only value from the score array gotten from the POST value inserted by JQUERY to a php array for us to work with

	}
	else{
		$score_secondTerm="";
	}
	if(isset($_POST['grade_secondTerm'])){
		$grade_secondTerm=explode(",",$_POST['grade_secondTerm'][0]);//This converts the first value which is the only value from the grade array gotten from the POST value inserted by JQUERY to a php array for us to work with

	}
	else{
		$grade_secondTerm="";
	}
	if(isset($_POST['remarks'])){
		$remarks=explode(",",$_POST['remarks'][0]);//This converts the first value which is the only value from the remark array gotten from the POST value inserted by JQUERY to a php array for us to work with
	}
	else{
		$remarks="";
	}
	if(isset($_POST['subject_name'])){
		$subject_name=json_decode($_POST['subject_name']);
		$count=sizeof($subject_name);
	
	}
	$current_time=time();
	$start_year=date("Y",$current_time);
	$end_year=$start_year+1;
	
	$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
	if($conn->connect_error){
		die('could not connect to the database');
	}
	else{
		
		$select1="SELECT * FROM second_term WHERE student_id='$student_id' AND class_name='$class_name'";
		$query1=$conn->query($select1);
		if($query1->num_rows>0){
			
			$_SESSION['error']='<i class="fa fa-warning"></i> Sorry a record already exists for this student';
			header("location:second_term_compute_cognitive_report.php?s_id=$student_id &c_name=$class_name &f_tr=$second_term");
			
			
			
			
		}
		else{
		
				for($i=0;$i<$count;$i++){
					$subject=$subject_name["$i"];
					$otherCA=$other_CA["$i"];
					$stud_CA=$CA["$i"];
					$stud_exam=$exams["$i"];
					$total_score=$score_secondTerm["$i"];
					$sum +=$total_score;
					$grade=$grade_secondTerm["$i"];
					$remark=$remarks["$i"];
				$insert="INSERT INTO second_term(subjects,other_CA,CA,exams,total_score,grade,remark,student_id,class_name,start_year,end_year)VALUES('$subject','$otherCA','$stud_CA','$stud_exam','$total_score','$grade','$remark','$student_id','$class_name','$start_year','$end_year')";
				$query=$conn->query($insert); 
				if($conn->affected_rows>1){
					//echo"";
				}
				else{
					
						//	echo "An error has occurred".$conn->error;
				}
	}
	$select2="SELECT * FROM totalscore WHERE student_id='$student_id' AND class_name='$class_name' AND term='$second_term'";
	$query2=$conn->query($select2);
	if($query2->num_rows>0){
		
		$_SESSION['totalscore_error']="Sorry a record has already been inserted for this student. ";
		header("location:second_term_compute_cognitive_report.php?s_id=$student_id &c_name=$class_name &f_tr=$second_term");
		
	}
	else{
			$insert3="INSERT INTO totalscore(student_id,totalscore,class_name,term,start_year,end_year)VALUES('$student_id','$sum','$class_name','$second_term','$start_year',$end_year)";
			$query3=$conn->query($insert3);
			if($conn->affected_rows==1){
				
				$_SESSION['success']="<i class='fa fa-check-circle text-success'></i>Cognitive Report was Successfully Posted";
				header("location:second_term_compute_cognitive_report.php?s_id=$student_id &c_name=$class_name &f_tr=$second_term");
				
	}
	else{
		
		//echo"An Error has Occurred".$conn->error;


				}	

			}
	
		}


	}
}
?>