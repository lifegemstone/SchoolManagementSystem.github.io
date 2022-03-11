<?php
	include_once("includeFunction.php");
	if(isset($_POST['check'])){
	$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
	if($conn->connect_error){
		die("could not connect to the database");
		}
		else{
				$select="SELECT * FROM grading_percent";
				$query=$conn->query($select);
				if($query->num_rows==1){
					$results=$query->fetch_array(MYSQLI_ASSOC);
					$update="UPDATE grading_percent SET status='ON' WHERE id='{$results['id']}'";
					$query_update=$conn->query($update);
					echo"Percentage Grading System Has Been Turned ON";
				}
		}
	}

if(isset($_POST['notChecked'])){
	$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
	if($conn->connect_error){
		die("could not connect to the database");
		}
		else{
				$select="SELECT * FROM grading_percent";
				$query=$conn->query($select);
				if($query->num_rows==1){
					$results=$query->fetch_array(MYSQLI_ASSOC);
					$update="UPDATE grading_percent SET status='OFF' WHERE id='{$results['id']}'";
					$query_update=$conn->query($update);
					echo"Percentage Grading System Has Been Turned OFF";
				}
		}
	}



?>