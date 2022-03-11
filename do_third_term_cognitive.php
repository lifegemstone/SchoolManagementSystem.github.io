<?php
session_start();
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
		$grade_thirdTerm=explode(",",$_POST['grade_thirdTerm'][0]);
	}
	else{
		$grade_thirdTerm="";
	}
	if(isset($_POST['remark'])){
		$remarks=explode(",",$_POST['remark'][0]);
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
	$current_time=time();
	$start_year=date('Y',$current_time);
	$end_year=$start_year+1;
	$newStartYear=$end_year+1;
	$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
	if($conn->connect_error){
		die('could not connect to the database');
	}
	else{
		$select="SELECT * FROM third_term WHERE student_id='$student_id' AND class_name='$class_name'";
		$query=$conn->query($select);
		if($query->num_rows>0){
			
			$_SESSION['error']="<i class='fa fa-warning'></i> Sorry a record already exists  for this student";
			header("location:third_term_cognitive_report.php?s_id=$student_id &c_name=$class_name &f_tr=$third_term");
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
				$insert="INSERT INTO third_term(subjects,other_CA,CA,exams,total_score,grade,remark,first_term,second_term,sum_avg,student_id,class_name,start_year,end_year)VALUES('$subject','$otherCA','$stud_CA','$stud_exam','$total_score','$grade','$remark','$first_term_score','$second_term_score','$avg','$student_id','$class_name','$start_year','$end_year')";
				$query=$conn->query($insert); 
				if($conn->affected_rows==1){
					echo"";
				}
				else{
						echo"An Error has Occurred".$conn->error;
				}
				
			}

$select2="SELECT * FROM totalscore WHERE student_id='$student_id' AND class_name='$class_name' AND term='$third_term'";
	$query2=$conn->query($select2);
	if($query2->num_rows>0){
		
		$_SESSION['totalscore_error']="Sorry a record has already been inserted for this student. ";
		header("location:third_term_cognitive_report.php?s_id=$student_id&c_name=$class_name&f_tr=$third_term");
		
	}
	else{
	$insert3="INSERT INTO totalscore(student_id,totalscore,class_name,term,start_year,end_year)VALUES('$student_id','$sum_total','$class_name','$third_term','$start_year','$end_year')";
	$query3=$conn->query($insert3);
	if($conn->affected_rows==1){
		$total_sub_score=100*$count;
		$percent=($sum_total/$total_sub_score)*100;
		$select="SELECT * FROM grading_percent";
		$query=$conn->query($select);
		$results=$query->fetch_array(MYSQLI_ASSOC);
			if($results['status']=='ON'){
				if($percent>=$results['percentage']){
					$new_sessionYear=$end_year;
					$end_sessionYear=$new_sessionYear+1;
					switch($class_name){
					case "Basic 1":
						$update_class="UPDATE students SET class_name='Basic 2' WHERE student_id='$student_id'";
						$query=$conn->query($update_class);
						$insert="INSERT INTO class_session(class_name,student_id,start_year,end_year)VALUES('Basic 2','$student_id','$new_sessionYear','$end_sessionYear')";
						$query=$conn->query($insert);
				break;
				case "Basic 2":
						$update_class="UPDATE students SET class_name='Basic 3' WHERE student_id='$student_id'";
						$query=$conn->query($update_class);
						$insert="INSERT INTO class_session(class_name,student_id,start_year,end_year)VALUES('Basic 3','$student_id','$new_sessionYear','$end_sessionYear')";
						$query=$conn->query($insert);
						break;
						
					case "Basic 3":
						$update_class="UPDATE students SET class_name='Basic 4' WHERE student_id='$student_id'";
						$query=$conn->query($update_class);
						$insert="INSERT INTO class_session(class_name,student_id,start_year,end_year)VALUES('Basic 4','$student_id','$new_sessionYear','$end_sessionYear')";
						$query=$conn->query($insert);
						break;
							
						
					case "Basic 4":
						$update_class="UPDATE students SET class_name='Basic 5' WHERE student_id='$student_id'";
						$query=$conn->query($update_class);
						$insert="INSERT INTO class_session(class_name,student_id,start_year,end_year)VALUES('Basic 5','$student_id','$new_sessionYear','$end_sessionYear')";
						$query=$conn->query($insert);
						break;
					case "Basic 5":
						$update_class="UPDATE students SET class_name='Basic 6' WHERE student_id='$student_id'";
						$query=$conn->query($update_class);
						$insert="INSERT INTO class_session(class_name,student_id,start_year,end_year)VALUES('Basic 6','$student_id','$new_sessionYear','$end_sessionYear')";
						$query=$conn->query($insert);
						echo"";
						break;
						default:
								//echo"INVALID CLASS SELECTION";
						
						
					}
					
				}
				else{
				
						$repeat_year=$end_year;
						$end_year=$repeat_year+1;
						$select="SELECT * FROM class_session WHERE student_id='$student_id' AND class_name='$class_name' AND start_year='$repeat_year' AND end_year='$end_year'";
						$query=$conn->query($select);
						if($query->num_rows==0){
							$insert="INSERT INTO class_session(class_name,student_id,start_year,end_year)VALUES('$class_name','$student_id','$repeat_year','$end_year')";
								$query_insert=$conn->query($insert);
					}
				}
			}
			elseif($results['status']=='OFF'){
				if($percent>=50){
				switch($class_name){
					case "BASIC 1":
						$update_class="UPDATE students SET class_name='BASIC 2' WHERE student_id='$student_id'";
						$query=$conn->query($update_class);
						$insert="INSERT INTO class_session(class_name,student_id,start_year,end_year)VALUES('BASIC 2','$student_id','$end_year','$newStartYear')";
						$query=$conn->query($insert);
				break;
				case "BASIC 2":
						$update_class="UPDATE students SET class_name='BASIC 3' WHERE student_id='$student_id'";
						$query=$conn->query($update_class);
						$insert="INSERT INTO class_session(class_name,student_id,start_year,end_year)VALUES('BASIC 3','$student_id','$end_year','$newStartYear')";
						$query=$conn->query($insert);
						break;
						
					case "BASIC 3":
						$update_class="UPDATE students SET class_name='BASIC 4' WHERE student_id='$student_id'";
						$query=$conn->query($update_class);
						$insert="INSERT INTO class_session(class_name,student_id,start_year,end_year)VALUES('BASIC 4','$student_id','$end_year','$newStartYear')";
						$query=$conn->query($insert);
						break;
							
						
					case "BASIC 4":
						$update_class="UPDATE students SET class_name='BASIC 5' WHERE student_id='$student_id'";
						$query=$conn->query($update_class);
						$insert="INSERT INTO class_session(class_name,student_id,start_year,end_year)VALUES('BASIC 5','$student_id','$end_year','$newStartYear')";
						$query=$conn->query($insert);
						break;
					case "BASIC 5":
						$update_class="UPDATE students SET class_name='BASIC 6' WHERE student_id='$student_id'";
						$query=$conn->query($update_class);
						$insert="INSERT INTO class_session(class_name,student_id,start_year,end_year)VALUES('BASIC 6','$student_id','$end_year','$newStartYear')";
						$query=$conn->query($insert);
						echo"";
						break;
						default:
							//	echo"INVALID CLASS SELECTTION";
				}
			}
			else{
				
				$repeat_year=$end_year;
				$end_year=$repeat_year+1;
				$select="SELECT * FROM class_session WHERE student_id='$student_id' AND class_name='$class_name' AND start_year='$repeat_year' AND end_year='$end_year'";
				$query=$conn->query($select);
				if($query->num_rows==0){
					$insert="INSERT INTO class_session(class_name,student_id,start_year,end_year)VALUES('$class_name','$student_id','$repeat_year','$end_year')";
						$query_insert=$conn->query($insert);
					}
			}
		}			
		
		$_SESSION['success']="<i class='fa fa-check-circle text-success'></i> Cognitive Report was Successfully Posted";
	header("location:third_term_cognitive_report.php?s_id=$student_id&c_name=$class_name&f_tr=$third_term");
		
	}
	else{
		
		echo"An Error has Occurred".$conn->error;


				}	

			}
	
		}


		}
	}

?>