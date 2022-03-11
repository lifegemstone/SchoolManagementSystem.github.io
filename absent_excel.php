<?php
if(isset($_GET['c_name'])){
	
	$class_name=$_GET['c_name'];
	$class_name=base64_decode($class_name);
	
}
if(isset($_GET['x_date'])){ // x_date indicates the start date
	
	$start_date=$_GET['x_date'];
		$start_date=base64_decode($start_date);
}
if(isset($_GET['y_date'])){ // y_date indicates the end date
	
	$end_date=$_GET['y_date'];
	$end_date=base64_decode($end_date);
}
include_once("includeFunction.php");
$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
if($conn->connect_error){
	
	die('could not connect to the database');
}
else{
		$select="SELECT s.student_name as student_name,a.class_name as class_name,a.attendance_status,a.attendance_date  FROM students AS s INNER JOIN attendance as a  ON s.student_id=a.student_id WHERE a.class_name='$class_name' AND attendance_date BETWEEN '$start_date' AND '$end_date' AND attendance_status='Absent' ORDER BY attendance_date";				
	$query=$conn->query($select);
	$filename="absent_list.xls";
	header("Content-Disposition:attachment;filename=\"$filename\"");
	header("Content-Type:application/vnd.ms-excel");
	$flags=false;
	while($results=$query->fetch_array(MYSQLI_ASSOC)){
		if(!$flags){
			
			echo implode("\t",array_keys($results))."\r\n";
			$flags=true;
		}
		echo implode("\t",array_values($results))."\r\n";
	}
}

?>