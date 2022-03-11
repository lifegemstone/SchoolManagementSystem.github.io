<?php 
//include_once('C:/wamp/dbconn_vbsms.php');
include_once('validate_user.php');
//include_once('functions.php');
if(isset($_GET['usrcd'])){
		$usrcd=$_GET['usrcd'];
	}
else{
	
		exit();
}
if(isset($_SESSION['username'])){
	$username=$_SESSION['username'];
}
else{
		echo "session not set";
}
	$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
	$select="SELECT user_token FROM users WHERE name='".$username."'";
	$query=$conn->query($select);
	$results=$query->fetch_array(MYSQLI_ASSOC);
	$user_token=$results['user_token'];
		if($usrcd != $user_token){
			validateUser::logout();
			
			
		}
if(isset($_GET['t_id'])){
	$teacher_id=$_GET['t_id'];
}
else{
		exit();
}

?>
<!DOCTYPE HTML>
<html>
<head><title>Teachers Profile</title>
<meta name="viewport" content="width=device-width initial-scale=1">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.css" rel="stylesheet" type="text/css">
<link href="css/sb-admin-2.css" rel="stylesheet" type="text/css">
 <link href="css/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
	
<style type='text/css'>
.footer{background:black;color:white;position:fixed;bottom:0;margin:0px;width:100%;}
.link{text-decoration:none;color:white}
a:hover{text-decoration:none;color:white}
lecture_days{ padding-bottom:15px}
.table{margin-bottom:50px!important;
border:1px solid gray}
td{border:1px solid gray;}
.gray{background:gray}
.save{display:none}
</style>
</head>
<body>
<?php  validateUser::heading2() ?>
<div class="container">
<div class="rows">
<div class="col-xs-12 col-sm-12 col-md-lg col-lg-12">
<ol class="breadcrumb"> 
<li><a href="#"><i class="fa fa-home"></i>Vinebranch School Management System</a></li> 
<li class="">DASHBOARD</li> 
<li class="active">Teacher Profile</li> 
</ol>
			
	<h4 class="page-header"><i class='fa fa-user'></i> Personal Information <button class='btn btn-xs btn-primary'><?php echo"<a href='edit_teacher.php?t_id=$teacher_id&usrcd=$usrcd' style='color:white'>Edit Teacher Information</a>";?></button></h4>
						<?php 
								
								$conn=mysqli_connect(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME)or die('could not connect to the databse'.mysqli_connect_error());
						$select1="SELECT * FROM teachers WHERE teacher_id='$teacher_id'";
						$query1=mysqli_query($conn,$select1);
						
						while($results=mysqli_fetch_array($query1,MYSQLI_ASSOC))
						{ 	
							echo"<div class='col-sm-4'>
							<img src='teachersImages/{$results['teacher_img']}' class='img-rounded' width='220px' height='220px' alt='image'>
							</div>
							<div class='col-sm-8'>
							<h4><strong>TEACHER NAME:</strong> {$results['teacher_name']}</h4>
							<h4><strong>SEX:</strong> {$results['sex']}</h4>
							<h4><strong>ADDRESS:</strong> {$results['home_address']}</h4>
							<h4><strong>TELEPHONE N<span style='text-decoration:underline'>O</span>:</strong> {$results['telephone']}</h4>
							<h4><strong>REG DATE:</strong> ".date('jS M Y',strtotime($results['date']))."</h4>
							</div>";
							
						}
						
							 ?>
							 </div>
                  <div class='col-sm-12 col-md-12 col-lg-12'>          
                 <h4 class="page-header"><i class='fa fa-edit'></i> Classes & Subject</h4>
				 <?php
				 $j=0;
				 $class_array=array();
				 $select="SELECT * FROM school_classes";
				 $query=$conn->query($select);
				 while($queryResults=$query->fetch_array(MYSQLI_ASSOC)){
					 $class_array[]=$queryResults['class_name'];
				 }
				 $select="SELECT * FROM assign_subjects WHERE teacher_id='$teacher_id'";
				 $query=mysqli_query($conn,$select);
				 if($query->num_rows>0){
				 while($results=mysqli_fetch_array($query,MYSQLI_ASSOC)){
					 $stored_classes[]=$results['class_name'];
				 }
				 $size=sizeof($class_array);
				 $new_array=array_unique($stored_classes);
					foreach($new_array as $value1){
							foreach($class_array as $value2){
								if($value1==$value2){
									echo"<div class='col-sm-4 col-md-4 col-lg-4'>";
									$select="SELECT subject_name FROM assign_subjects WHERE class_name='".$value1."' AND teacher_id='$teacher_id'";
									$query=mysqli_query($conn,$select);
									echo"<h4><i class='fa fa-building'></i> $value1</h4>";
									while($results=mysqli_fetch_array($query,MYSQLI_ASSOC)){
										echo"
												<p>&#9670{$results['subject_name']}</p>
												";//&#9670 is a unicode character for black diamond
									}
									echo"</div>";
								}
					
							}
				 
					}
				 }	
				else{
					 
							echo"<span style='color:red'>{N/A Teacher has not yet been assigned to a class}</span>";
				 }
				 ?>
				 </div>
				 <div class='col-sm-12 col-md-12 col-lg-12'>
				 <h4 class='page-header'><i class='fa fa-graduation-cap'></i>Student Statistics</h4>
				 <p><i class='fa fa-bar-chart text-success'></i><strong>Total Students in Class:</strong>
				 <?php
				 $conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
				 if($conn->connect_error){
					 die('could not connect to the database');
				 }
				 else{
					 
					 
					// $select="SELECT COUNT(s.student_id) AS student_id,s.class_name,c.class_name,c.teacher_id FROM students AS s INNER JOIN assign_subjects AS c ON s.class_name=c.class_name WHERE c.teacher_id='$teacher_id'";
					//$query=$conn->query($select);
					$select="SELECT class_name FROM assign_subjects WHERE teacher_id='$teacher_id'";
					$query=$conn->query($select);
					if($query->num_rows>0){
						while($results=$query->fetch_array(MYSQLI_ASSOC)){
							
							$class_name[]=$results['class_name'];
								
						}
					$class_name=array_unique($class_name);
					foreach($class_name as $className){
						
						$select2="SELECT COUNT(student_id) as stud_id FROM students WHERE class_name='$className'";
						$query=$conn->query($select2);
						$results2=$query->fetch_array(MYSQLI_ASSOC);
						
							
						echo"<h4><i class='fa fa-building'></i> $className</h4>
						<span style='color:blue'>N<span style='text-decoration:underline'>o</span> of Student/Students: <i class='fa fa-users'></i> {$results2['stud_id']}</span>";
					//while($results=$query->fetch_array(MYSQLI_ASSOC)){
						//echo $results['class_name'];
						//echo $results['student_id'];
						//$stud_array[]=$results['student_id'];
				
						
					}
				// $stud_array=array_unique($stud_array);
				// $stud_array_size=sizeof($stud_array);
				// echo $stud_array_size;
					}
					else{
						
						echo"<span style='color:red'>N/A {Teacher has not yet been assigned to a class}</span>";
						
						
						
					}
				}
				?>
				 </p>
					</div><br><br>
					
						
							<div class='col-sm-12'>
												<h4 class='page-header'><i class='fa fa-table'></i> Teacher Time Table</h4>
							<?php
							
							try{
	$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
	if($conn->connect_error)
	{
		
		throw new Exception("sorry connection to the database failed try again");
		
	}
	else{
		
		$database_days=array();
		$days=array('monday','tuesday','wednessday','thursday','friday');
		$select="SELECT * FROM time_table WHERE teacher_id='$teacher_id'";
		$query=$conn->query($select);
		if(@$query->num_rows > 0)
		{
			echo "
			<table class='table table-responsive' id='$teacher_id'>
			<thead>
			<tr>
				<td class='text-success'>Week Day</td>
				<td class='text-success'>Subject Name</td>
				<td class='text-success'>Class Name</td>
				<td class='text-success'>Start Time</td>
				<td class='text-success'>End Time</td>
				</tr>
				</thead>
				<tbody>";
			while($results=$query->fetch_array(MYSQLI_ASSOC)){
				
				$database_days[]=$results['week_day'];
				
				
			}
			 foreach($days as $day){
				
				if(!in_array($day,$database_days)){
					echo "";
					
				}
				else{
				echo"
				
				<tr>
				<td class='text-primary'>$day</td>
				<td  class='gray'></td>
				<td  class='gray'></td>
				<td  class='gray'></td>
				<td  class='gray'></td>
				
				</tr>";
				switch($day){
					case "monday":
					$select2="SELECT * FROM time_table WHERE week_day='$day' AND teacher_id='$teacher_id' ORDER BY week_day ASC";
					$query2=$conn->query($select2);
					while($results2=$query2->fetch_array(MYSQLI_ASSOC))
					{
						echo"<tr id='{$results2['day_id']}'><form action='do-edit-cells.php' onsubmit='event.preventDefault();' method='POST'><td class='gray'></td>
				<td class='text-danger tbl' id='subject_name{$results2['day_id']}'>{$results2['subject_name']}</td>
				<td class='text-danger tbl' id='class_name{$results2['day_id']}'>{$results2['class_name']}</td>
				<td class='text-danger tbl' id='start_time{$results2['day_id']}'>{$results2['start_time']}</td>
				<td class='text-danger tbl' id='end_time{$results2['day_id']}'>{$results2['end_time']}</td>
				</form></tr>";
					}
					break;
					case "tuesday":
					$select2="SELECT * FROM time_table WHERE week_day='$day' AND teacher_id='$teacher_id' ORDER BY week_day ASC";
					$query2=$conn->query($select2);
					while($results2=$query2->fetch_array(MYSQLI_ASSOC))
					{
						echo"<tr  id='{$results2['day_id']}'><form action='do-edit-cells.php' onsubmit='event.preventDefault();' method='POST'><td class='gray'></td>
				<td class='text-danger tbl' id='subject_name{$results2['day_id']}'>{$results2['subject_name']}</td>
				<td class='text-danger tbl' id='class_name{$results2['day_id']}'>{$results2['class_name']}</td>
				<td class='text-danger tbl' id='start_time{$results2['day_id']}'>{$results2['start_time']}</td>
				<td class='text-danger tbl' id='end_time{$results2['day_id']}'>{$results2['end_time']}</td>
				</form></tr>";
					}
					break;
					case "wednessday":
					$select2="SELECT * FROM time_table WHERE week_day='$day' AND teacher_id='$teacher_id' ORDER BY week_day ASC";
					$query2=$conn->query($select2);
					while($results2=$query2->fetch_array(MYSQLI_ASSOC))
					{
						echo"
						<tr id='{$results2['day_id']}'><form action='do-edit-cells.php' onsubmit='event.preventDefault();' method='POST'><td class='gray'></td>
				<td class='text-danger tbl' id='subject_name{$results2['day_id']}'>{$results2['subject_name']}</td>
				<td class='text-danger tbl' id='class_name{$results2['day_id']}'>{$results2['class_name']}</td>
				<td class='text-danger tbl' id='start_time{$results2['day_id']}'>{$results2['start_time']}</td>
				<td class='text-danger tbl' id='end_time{$results2['day_id']}'>{$results2['end_time']}</td>
				</form></tr>";
					}
					break;
					case "thursday":
					$select2="SELECT * FROM time_table WHERE week_day='$day' AND teacher_id='$teacher_id' ORDER BY week_day ASC";
					$query2=$conn->query($select2);
					while($results2=$query2->fetch_array(MYSQLI_ASSOC))
					{
						echo"<tr id='{$results2['day_id']}'><form action='do-edit-cells.php' onsubmit='event.preventDefault();' method='POST'><td class='gray'></td>
				<td class='text-danger tbl' id='subject_name{$results2['day_id']}'>{$results2['subject_name']}</td>
				<td class='text-danger tbl' id='class_name{$results2['day_id']}'>{$results2['class_name']}</td>
				<td class='text-danger tbl ' id='start_time{$results2['day_id']}'>{$results2['start_time']}</td>
				<td class='text-danger tbl' id='end_time{$results2['day_id']}'>{$results2['end_time']}</td>
				</form></tr>";
					}
					break;
				case "friday":
					$select2="SELECT * FROM time_table WHERE week_day='$day' AND teacher_id='$teacher_id' ORDER BY week_day ASC";
					$query2=$conn->query($select2);
					while($results2=$query2->fetch_array(MYSQLI_ASSOC))
					{
						echo"<tr id='{$results2['day_id']}'><form action='do-edit-cells.php'  onsubmit='event.preventDefault();' method='POST'><td class='gray'></td>
				<td class='text-danger tbl' id='subject_name{$results2['day_id']}'>{$results2['subject_name']}</td>
				<td class='text-danger tbl' id='class_name{$results2['day_id']}'>{$results2['class_name']}</td>
				<td class='text-danger tbl' id='start_time{$results2['day_id']}'>{$results2['start_time']}</td>
				<td class='text-danger tbl' id='end_time{$results2['day_id']}'>{$results2['end_time']}</td>
				</form></tr>";
						}
							break;
							default:
							echo"";
				
					}
				
				}
			
			}
		}
		else{
			
			
				echo"<span style='color:red'>N/A {Time-Table Not Yet Created For Teacher}</span>";
			
			
		}
	}
}
	catch(Exception $e){
		
		echo $e->getMessage();
		
		
		
	}
	

							
							
							
							
							
							echo"</tbody>
							</table>";?>
							
							</div>
			 </div>
			 </div>
			 <br><br><br>
			 
<div class="footer" >
		<footer>
<p align="center"> <strong>&copy <?php echo date('Y');?>  Vinebranch School Management System </strong></p>
</footer>
</div>
<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/bootstrap.js"></script>
<script>
	
	 function edit_row(id){
		 var subject_name=document.getElementById("subject_name"+id).innerHTML;
		 var class_name=document.getElementById("class_name"+id).innerHTML;
		 var start_time=document.getElementById("start_time"+id).innerHTML;
		 var end_time=document.getElementById("end_time"+id).innerHTML;
		 
		document.getElementById("subject_name"+id).innerHTML="<input type='text' id='subject"+id+"' value='"+subject_name+"' />"
		 document.getElementById("class_name"+id).innerHTML="<input type='text' id='class"+id+"' value='"+class_name+"' />"
		document.getElementById("start_time"+id).innerHTML="<input type='text' id='start"+id+"' value='"+start_time+"' />"
		document.getElementById("end_time"+id).innerHTML="<input type='text' id='end"+id+"' value='"+end_time+"' />"
		
		 document.getElementById('edit'+id).style.display="none";
		 document.getElementById('save'+id).style.display="block";
		 
	 } 
	 
	 function save_row(id){
		  document.getElementById('edit'+id).style.display="block";
		 document.getElementById('save'+id).style.display="none";
		 var  subject_name=document.getElementById("subject"+id).value;
		 var  class_name=document.getElementById("class"+id).value;
		 var  start_time=document.getElementById("start"+id).value;
		 var  end_time=document.getElementById("end"+id).value;
		
		 $.ajax({
			 
			 type:'POST',
			 url:'do-edit-cells.php',
			 data:{
				 edit_row:'edit_row',
				 subject_name:subject_name,
				 class_name:class_name,
				 start_time:start_time,
				 end_time:end_time,
				 td_id:id
			 },
			 
			 success:function(response){
				 if(response=="success"){
					 document.getElementById("subject_name"+id).innerHTML=subject_name;
					 document.getElementById("class_name"+id).innerHTML=class_name;
					 document.getElementById("start_time"+id).innerHTML=start_time;
					 document.getElementById("end_time"+id).innerHTML=end_time;
					 }  
			 }
			 
		 });
		 
	 }
	 
	 function delete_row(id){
		 
		$.ajax({
					 
				type:'POST',
				url:'do-edit-cells.php',
				data:{
					delete_row:'delete_row',
					td_id:id
				},
				success:function(response){
					if(response=='success'){
						var tbl_tr=document.getElementById(id);
					 tbl_tr.parentNode.removeChild(tbl_tr);
				 
					}
				}
				 
				 
			 });
		 
		 
		 
		 
		 
		 
	 }
	
</script>
</body>
</html>