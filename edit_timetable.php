<?php 

include_once('validate_user.php');
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
//include_once('functions.php');
if(isset($_GET['t_id'])){
	$teacher_id=$_GET['t_id'];
}
else{
		exit();
}

?>
<!DOCTYPE HTML>
<html>
<head><title>Edit Time-Table</title>
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
<li class="active"> Edit Time-Table </li> 
</ol>
			
	
				 
					</div><br><br><br> 
					
							</div>
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
		if($query->num_rows > 0)
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
				<td class='text-success'>Edit Entire Row</td>
				<td class='text-success'>Delete Entire Row</td>
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
				<td class='text-danger' align='center'><button type='button' class='btn btn-primary btn-sm edit' id='edit{$results2['day_id']}' onclick='edit_row({$results2['day_id']})'>Edit</button><button type='submit' class='btn btn-success btn-sm save' id='save{$results2['day_id']}' onclick='save_row({$results2['day_id']})'>Save</button></td>
				<td class='text-danger'><button type='submit' class='btn btn-primary btn-sm' id='delete{$results2['day_id']}' onclick='delete_row({$results2['day_id']})'><i class='fa fa-trash'></i></button></td>
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
				<td class='text-danger' align='center'><button type='button' class='btn btn-primary btn-sm edit' id='edit{$results2['day_id']}' onclick='edit_row({$results2['day_id']})'>Edit</button><button type='submit' class='btn btn-success btn-sm save' id='save{$results2['day_id']}' onclick='save_row({$results2['day_id']})'>Save</button></td>
				<td class='text-danger'><button type='submit' class='btn btn-primary btn-sm' id='delete{$results2['day_id']}' onclick='delete_row({$results2['day_id']})'><i class='fa fa-trash'></i></button></td>
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
				<td class='text-danger' align='center'><button type='button' class='btn btn-primary btn-sm edit' id='edit{$results2['day_id']}' onclick='edit_row({$results2['day_id']})'>Edit</button><button type='submit' class='btn btn-success btn-sm save' id='save{$results2['day_id']}' onclick='save_row({$results2['day_id']})'>Save</button></td>
				<td class='text-danger'><button type='submit' class='btn btn-primary btn-sm' id='delete{$results2['day_id']}' onclick='delete_row({$results2['day_id']})'><i class='fa fa-trash'></i></button></td>
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
				<td class='text-danger' align='center'><button type='button' class='btn btn-primary btn-sm edit' id='edit{$results2['day_id']}' onclick='edit_row({$results2['day_id']})'>Edit</button><button type='submit' class='btn btn-success btn-sm save' id='save{$results2['day_id']}' onclick='save_row({$results2['day_id']})'>Save</button></td>
				<td class='text-danger'><button type='submit' class='btn btn-primary btn-sm' id='delete{$results2['day_id']}' onclick='delete_row({$results2['day_id']})'><i class='fa fa-trash'></i></button></td>
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
				<td class='text-danger' align='center'><button type='button' class='btn btn-primary btn-sm edit' id='edit{$results2['day_id']}' onclick='edit_row({$results2['day_id']})'>Edit</button><button type='submit' class='btn btn-success btn-sm save' id='save{$results2['day_id']}' onclick='save_row({$results2['day_id']})'>Save</button></td>
				<td class='text-danger'><button type='submit' class='btn btn-primary btn-sm' id='delete{$results2['day_id']}' onclick='delete_row({$results2['day_id']})'><i class='fa fa-trash'></i></button></td>
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
				echo"<span style='color:red'><i class='fa fa-warning'></i> Time-Table has not yet been created.</span>";
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
				 td_id:id,
				
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
					td_id:id,
					
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