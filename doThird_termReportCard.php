<?php
include_once("includeFunction.php");
$sum_total=0;
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
	if(isset($_POST['third_term'])){
		$third_term=$_POST['third_term'];
	}
	else{
		$third_term="";
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

	if(isset($_POST['score_thirdTerm'])){
		$score_thirdTerm=$_POST['score_thirdTerm'];
	}
	else{
		$score_thirdTerm="";
	}
	if(isset($_POST['grade_thirdTerm'])){
		$grade_thirdTerm=$_POST['grade_thirdTerm'];
	}
	else{
		$grade_thirdTerm="";
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
	if(isset($_POST['first_term'])){
		$first_term=json_decode($_POST['first_term']);
		
	
	}
	if(isset($_POST['second_term'])){
		$second_term=json_decode($_POST['second_term']);
	
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
			$first_term_score=$first_term["$i"];
			$second_term_score=$second_term["$i"];
			$total_score=$score_thirdTerm["$i"];
			$avg=($first_term_score+$second_term_score+$total_score)/3; //$total_score is total score per subject for third_term
			$sum_total+=$avg;
			$grade=$grade_thirdTerm["$i"];
			$remark=$remarks["$i"];
		$insert="INSERT INTO third_term(id,subjects,other_CA,CA,exams,total_score,grade,remark,first_term,second_term,third_term,sum_avg,student_id,class_name,term_status)VALUES('','$subject','$otherCA','$stud_CA','$stud_exam','$total_score','$grade','$remark','$first_term_score','$second_term_score','$total_score','$avg','$student_id','$class_name','0')";
		$query=$conn->query($insert); 
		if($conn->affected_rows>1){
			echo"inserted successfully";
		}
		else{
				$conn->error;
		}
		
	}
		
	
	$insert2="INSERT INTO totalscore(id,student_id,totalscore,class_name,term)VALUES('','$student_id','$sum_total','$class_name','$third_term')";
	$query2=$conn->query($insert2);

$insert3="INSERT INTO other_params(id,times_schOpen,times_present,times_absent,term_begins,term_ends,teachers_comment,height_start,weight_start,height_end,weight_end,student_id,term,class_name)VALUES('','$sch_open','$num_present','$num_absent','$start_term','$end_term','$teacher_comment','$height_start','$weight_start','$height_end','$weight_end','$student_id','$third_term','$class_name')";
	$query3=$conn->query($insert3);
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
		$insert="INSERT INTO observation_conduct_grades(id,student_id,params,grade,class_name,term,teachers_comment)VALUES('','$student_id','$conduct_param','$grade','$class_name','$third_term','')";
		$query=$conn->query($insert); 
		if($conn->affected_rows>1){
			echo"inserted successfully";
		}
		
	}


}

$total_sub_score=100*$count;
$percent=($sum_total/$total_sub_score)*100;
echo $percent;
/*$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
if($conn->connect_error){
	die('could not connect to the database');
}
else{
	
		$select="SELECT * FROM grading_percent";
		$query=$conn->query($select);
		$results=$query->fetch_array(MYSQLI_ASSOC);
			if($results['status']=='ON'){
				if($percent>=$results['percentage']){
					switch($class_name){
					case "BASIC 1":
						$update1="UPDATE first_term SET term_status='1' WHERE student_id='$student_id' AND class_name='BASIC 1'";
						$query=$conn->query($update1);
						$update2="UPDATE second_term SET term_status='1' WHERE student_id='$student_id' AND class_name='BASIC 1'";
						$query2=$conn->query($update2);
						$update3="UPDATE third_term SET term_status='1' WHERE student_id='$student_id' AND class_name='BASIC 1'";
						$query3=$conn->query($update3);
						$update_class="UPDATE students SET class_name='BASIC 2' WHERE student_id='$student_id' AND class_name='BASIC 1'";
						$query=$conn->query($update_class);
						$insert="INSERT INTO previous_classes(id,student_id,previous_class)VALUES('','$student_id','PLAY GROUP')";
						$query=$conn->query($insert);
				break;
				case "BASIC 2":
						$update1="UPDATE first_term SET term_status='1' WHERE student_id='$student_id' AND class_name='BASIC 2'";
						$query=$conn->query($update1);
						$update2="UPDATE second_term SET term_status='1' WHERE student_id='$student_id' AND class_name='BASIC 2'";
						$query2=$conn->query($update2);
						$update3="UPDATE third_term SET term_status='1' WHERE student_id='$student_id' AND class_name='BASIC 2'";
						$query3=$conn->query($update3);
						$update_class="UPDATE students SET class_name='BASIC 2' WHERE student_id='$student_id' AND class_name='BASIC 2'";
						$query=$conn->query($update_class);
						$insert="INSERT INTO previous_classes(id,student_id,previous_class)VALUES('','$student_id','BASIC 1')";
						$query=$conn->query($insert);
						break;
						
					case "BASIC 3":
						$update1="UPDATE first_term SET term_status='1' WHERE student_id='$student_id' AND class_name='BASIC 3'";
						$query=$conn->query($update1);
						$update2="UPDATE second_term SET term_status='1' WHERE student_id='$student_id' AND class_name='BASIC 3'";
						$query2=$conn->query($update2);
						$update3="UPDATE third_term SET term_status='1' WHERE student_id='$student_id' AND class_name='BASIC 3'";
						$query3=$conn->query($update3);
						$update_class="UPDATE students SET class_name='BASIC 2' WHERE student_id='$student_id' AND class_name='BASIC 3'";
						$query=$conn->query($update_class);
						$insert="INSERT INTO previous_classes(id,student_id,previous_class)VALUES('','$student_id','BASIC 2')";
						$query=$conn->query($insert);
						break;
							
						
					case "BASIC 4":
						$update1="UPDATE first_term SET term_status='1' WHERE student_id='$student_id' AND class_name='BASIC 4'";
						$query=$conn->query($update1);
						$update2="UPDATE second_term SET term_status='1' WHERE student_id='$student_id' AND class_name='BASIC 4'";
						$query2=$conn->query($update2);
						$update3="UPDATE third_term SET term_status='1' WHERE student_id='$student_id' AND class_name='BASIC 4'";
						$query3=$conn->query($update3);
						$update_class="UPDATE students SET class_name='BASIC 2' WHERE student_id='$student_id' AND class_name='BASIC 4'";
						$query=$conn->query($update_class);
						$insert="INSERT INTO previous_classes(id,student_id,previous_class)VALUES('','$student_id','BASIC 3')";
						$query=$conn->query($insert);
						break;
					case "BASIC 5":
						$update1="UPDATE first_term SET term_status='1' WHERE student_id='$student_id' AND class_name='BASIC 5'";
						$query=$conn->query($update1);
						$update2="UPDATE second_term SET term_status='1' WHERE student_id='$student_id' AND class_name='BASIC 5'";
						$query2=$conn->query($update2);
						$update3="UPDATE third_term SET term_status='1' WHERE student_id='$student_id' AND class_name='BASIC 5'";
						$query3=$conn->query($update3);
						$update_class="UPDATE students SET class_name='BASIC 2' WHERE student_id='$student_id' AND class_name='BASIC 5'";
						$query=$conn->query($update_class);
						$insert="INSERT INTO previous_classes(id,student_id,previous_class)VALUES('','$student_id','BASIC 5')";
						$query=$conn->query($insert);
						break;
						default:
								echo"INVALID CLASS SELECTTION";
						
						
					}
					
				}
			}
			if($results['status']=='OFF'){
				if($percent>=50){
				switch($class_name){
					case "BASIC 1":
						$update1="UPDATE first_term SET term_status='1' WHERE student_id='$student_id' AND class_name='BASIC 1'";
						$query=$conn->query($update1);
						$update2="UPDATE second_term SET term_status='1' WHERE student_id='$student_id' AND class_name='BASIC 1'";
						$query2=$conn->query($update2);
						$update3="UPDATE third_term SET term_status='1' WHERE student_id='$student_id' AND class_name='BASIC 1'";
						$query3=$conn->query($update3);
						$update_class="UPDATE students SET class_name='BASIC 2' WHERE student_id='$student_id' AND class_name='BASIC 1'";
						$query=$conn->query($update_class);
						$insert="INSERT INTO previous_classes(id,student_id,previous_class)VALUES('','$student_id','PLAY GROUP')";
						$query=$conn->query($insert);
				break;
				case "BASIC 2":
						$update1="UPDATE first_term SET term_status='1' WHERE student_id='$student_id' AND class_name='BASIC 2'";
						$query=$conn->query($update1);
						$update2="UPDATE second_term SET term_status='1' WHERE student_id='$student_id' AND class_name='BASIC 2'";
						$query2=$conn->query($update2);
						$update3="UPDATE third_term SET term_status='1' WHERE student_id='$student_id' AND class_name='BASIC 2'";
						$query3=$conn->query($update3);
						$update_class="UPDATE students SET class_name='BASIC 2' WHERE student_id='$student_id' AND class_name='BASIC 2'";
						$query=$conn->query($update_class);
						$insert="INSERT INTO previous_classes(id,student_id,previous_class)VALUES('','$student_id','BASIC 1')";
						$query=$conn->query($insert);
						break;
						
					case "BASIC 3":
						$update1="UPDATE first_term SET term_status='1' WHERE student_id='$student_id' AND class_name='BASIC 3'";
						$query=$conn->query($update1);
						$update2="UPDATE second_term SET term_status='1' WHERE student_id='$student_id' AND class_name='BASIC 3'";
						$query2=$conn->query($update2);
						$update3="UPDATE third_term SET term_status='1' WHERE student_id='$student_id' AND class_name='BASIC 3'";
						$query3=$conn->query($update3);
						$update_class="UPDATE students SET class_name='BASIC 2' WHERE student_id='$student_id' AND class_name='BASIC 3'";
						$query=$conn->query($update_class);
						$insert="INSERT INTO previous_classes(id,student_id,previous_class)VALUES('','$student_id','BASIC 2')";
						$query=$conn->query($insert);
						break;
							
						
					case "BASIC 4":
						$update1="UPDATE first_term SET term_status='1' WHERE student_id='$student_id' AND class_name='BASIC 4'";
						$query=$conn->query($update1);
						$update2="UPDATE second_term SET term_status='1' WHERE student_id='$student_id' AND class_name='BASIC 4'";
						$query2=$conn->query($update2);
						$update3="UPDATE third_term SET term_status='1' WHERE student_id='$student_id' AND class_name='BASIC 4'";
						$query3=$conn->query($update3);
						$update_class="UPDATE students SET class_name='BASIC 2' WHERE student_id='$student_id' AND class_name='BASIC 4'";
						$query=$conn->query($update_class);
						$insert="INSERT INTO previous_classes(id,student_id,previous_class)VALUES('','$student_id','BASIC 3')";
						$query=$conn->query($insert);
						break;
					case "BASIC 5":
						$update1="UPDATE first_term SET term_status='1' WHERE student_id='$student_id' AND class_name='BASIC 5'";
						$query=$conn->query($update1);
						$update2="UPDATE second_term SET term_status='1' WHERE student_id='$student_id' AND class_name='BASIC 5'";
						$query2=$conn->query($update2);
						$update3="UPDATE third_term SET term_status='1' WHERE student_id='$student_id' AND class_name='BASIC 5'";
						$query3=$conn->query($update3);
						$update_class="UPDATE students SET class_name='BASIC 2' WHERE student_id='$student_id' AND class_name='BASIC 5'";
						$query=$conn->query($update_class);
						$insert="INSERT INTO previous_classes(id,student_id,previous_class)VALUES('','$student_id','BASIC 5')";
						$query=$conn->query($insert);
						break;
						default:
								echo"INVALID CLASS SELECTTION";
				}
			}		
		}				
	}*/
}				
				
?>