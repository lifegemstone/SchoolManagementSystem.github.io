<?php
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
		$firstTerm_score=$_POST['firstTerm_score'];
	}
	else{
		$firstTerm_score="";
	}
	if(isset($_POST['grade_firstTerm'])){
		$firstTerm_grade=$_POST['grade_firstTerm'];
	}
	else{
		$firstTerm_grade="";
	}
	if(isset($_POST['remarks'])){
		$remarks=$_POST['remarks'];
		print_r($remarks);
	}
	else{
		$remarks="";
	}
	if(isset($_POST['subject_name'])){
		$subject_name=json_decode($_POST['subject_name']);
		$count=sizeof($subject_name);
	
	}
	if(isset($_POST['params'])){
		$params=json_decode($_POST['params']);
		$count_params=sizeof($params);
	print_r($params);
	}
	if(isset($_POST['param_grade'])){
		$param_grade=$_POST['param_grade'];
		print_r($param_grade);
	}
	$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
	if($conn->connect_error){
		die('could not connect to the database');
	}
	else{
		
		for($i=0;$i<$count;$i++){
			$subject=$subject_name["$i"];
			$otherCA=$other_CA["$i"];
			$stud_CA=$CA["$i"];
			$stud_exam=$exams["$i"];
			$firsterm_score=$firstTerm_score["$i"];
			$firsterm_grade=$firstTerm_grade["$i"];
			$remark1=$remarks["$i"];
		$insert="INSERT INTO cognitive_results(id,subjects,other_CA,CA,exams,firstterm_score,firstterm_grade,remark1,secondterm_score,secondterm_grade,remark2,thirdterm_score,thirdterm_grade,remark3,student_id,class_name,term)VALUES('','$subject','$otherCA','$stud_CA','$stud_exam','$firsterm_score','$firsterm_grade','$remark1','$secondterm_score','$secondterm_grade','$remark2','$thirdterm_score','$thirdterm_grade','$remark3','$student_id','$class_name','$term')";
		$query=$conn->query($insert); 
		if($conn->affected_rows>1){
			echo"inserted successfully";
		}
		
	}
		
	
	$insert2="INSERT INTO other_params(id,times_schOpen,times_present,times_absent,term_begins,term_ends,teachers_comment,height_start,weight_start,height_end,weight_end,student_id,term,class_name)VALUES('','$sch_open','$num_present','$num_absent','$start_term','$end_term','$teacher_comment','$height_start','$weight_start','$height_end','$weight_end','$student_id','$term','$class_name')";
	$query=$conn->query($insert2);
	if($conn->affected_rows>1){
		echo"inserted successfully";
	}
	else{
			$conn->error;
		}


		
		for($i=0;$i<$count_params;$i++){
			$conduct_param=$params["$i"];
			print($conduct_param);
			$grade=$param_grade["$i"];
			print_r($grade);
		$insert="INSERT INTO observation_conduct_grades(id,student_id,params,grade,class_name,term,teachers_comment)VALUES('','$student_id','$conduct_param','$grade','$class_name','$term','')";
		$query=$conn->query($insert); 
		if($conn->affected_rows>1){
			echo"inserted successfully";
		}
		
	}


}

}
?>