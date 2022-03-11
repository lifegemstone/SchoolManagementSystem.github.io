<?php
include_once("includeFunction.php");
if(isset($_GET['t_id'])){
	$teacher_id=$_GET['t_id'];
}
if(isset($_GET['c_name'])){
	
	$class_name=$_GET['c_name'];
	echo '<select name="subject_name" class="form-control">
	<option selected value="">----SELECT SUBJECT---</option>'; 
					$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
					if($conn->connect_error){
						die('could not connect to the database');
					}
					else{
						$select="SELECT * FROM assign_subjects WHERE class_name='$class_name' AND teacher_id='$teacher_id'";
						$query=$conn->query($select);
						$subjects=array();
						while($results=$query->fetch_array(MYSQLI_ASSOC)){
							
							$subjects[]=$results['subject_name'];
						}
							$subjects=array_unique($subjects);
							foreach($subjects as $subject){
							echo"
					<option>$subject</option>";
								}
						
				echo'</select>';


	}
}

?>