<?php
session_start();
include_once("includeFunction.php");
if($_SERVER['REQUEST_METHOD']=="POST"){
	
	

	
	if(isset($_POST['class_name'])){
		$class_name=$_POST['class_name'];
		
	}
	
	
	if(isset($_POST['student_id'])){
		$student_id=$_POST['student_id'];
		$student_id=json_decode($student_id);
		
	}
	
	
	if(isset($_POST['term'])){
		$term=$_POST['term'];
	
		
	}
	
	if(isset($_POST['count'])){
		$count=$_POST['count'];
		
	}
	
	
	if(isset($_POST['date'])){
		$attendance_date=$_POST['date'];
		
	}
	
	if(isset($_POST['present'])){
		$present_array=$_POST['present'];
	}
	else{
			$present_array=array();
	
	}
	if(isset($_POST['note'])){
		$note=$_POST['note'];
	}
	else{
		
			$note="";
		
	}
	
	$day=1;
	$countWeekDays=0;
	$currentMonth=date('m');
	$noDaysInCurrentMonth=date('t');
	$currentYear=date('Y');
	$date=new DateTime($currentYear."-".$currentMonth."-".$day);
	for($i=0;$i<$noDaysInCurrentMonth;$i++){
		if(($date->format('l')!="Sunday")&& ($date->format('l')!="Saturday")){
			$countWeekDays++;
			
		}
		$date->modify('+1day');
		
		
	}
	$attendancePercent=round((100/$countWeekDays),2);
	$date2= date("l",strtotime($attendance_date));
	if($date2=="Sunday"){
		$_SESSION['dayError']="Sorry Attendance Cannot Be Taken On a Sunday Please Change The Date And Then Try Again!!!";
		header("location:daily_attendance.php");
	}
	elseif($date2=="Saturday"){
		$_SESSION['dayError']="Sorry Attendance Cannot Be Taken On a Saturday Please Change The Date And Then Try Again!!!";
		header("location:daily_attendance.php");
	}
	else{
			$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
			if($conn->connect_error){
				die('could not connect to the database');
			}
			else{
				$select="SELECT attendance_date FROM attendance WHERE attendance_date='$attendance_date'";
				$query=$conn->query($select);
				if($query->num_rows>0){
					$_SESSION['attendance_error']="Sorry an attendance for this date already exists pls check the date and try again";
					header('location:daily_attendance.php');
				}
				else{
					
				foreach($student_id  as $id){
					if(in_array($id,$present_array)){
						$status="Present";
						$attendance_rating=$attendancePercent;
				$insert="INSERT INTO attendance(student_id,attendance_status,note,term,attendance_date,month,class_name,attendance_rating)VALUES('$id','$status','','$term','$attendance_date','$currentMonth','$class_name','$attendance_rating')";
				$query=$conn->query($insert);
				if($conn->affected_rows>0){
					
					//echo"attendance success";
				}
				else{
					//echo"error".$conn->error;
				}
				
				
			}
			else{
				$insert="INSERT INTO attendance(student_id,attendance_status,note,term,attendance_date,month,class_name,attendance_rating)VALUES('$id','Absent','','$term','$attendance_date','$currentMonth','$class_name','0')";
				$query=$conn->query($insert);
						if($conn->affected_rows>0){
					
							//echo"attendance success";
						}
						else{
								//echo"error".$conn->error;
							}
				
				
						}
					
					}
					
					$_SESSION['attendanceSuccess']="Attendance Successful";
				header("location:daily_attendance.php");
				}
			
			
			
			}

	}
			
}


?>