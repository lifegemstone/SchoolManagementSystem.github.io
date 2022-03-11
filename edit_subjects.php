<?php 

include_once("validate_user.php");
//include_once('functions.php');
$array_className=array();
$array_subjects=array();
$restore_subjects=array();
if(isset($_POST["edit"])){
	if(isset($_POST['usrcd'])){
		$usrcd=$_POST['usrcd'];
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
	
	echo'<!DOCTYPE HTML>
<html>
<head><title>Subjects</title>
<meta name="viewport" content="width=device-width initial-scale=1">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.css" rel="stylesheet" type="text/css">
<link href="css/eportalstyle.css" rel="stylesheet" type="text/css">
<link href="css/sb-admin-2.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="dist/css/bootstrap-datepicker.css"/>
  <link href="css/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
	
<style type="text/css">
.footer{background:black;
color:white;
position:fixed;
bottom:0px;
width:100%;}
.link{text-decoration:none;color:white}
a:hover{text-decoration:none;color:white}
body{position:relative;}
.save{display:none}
#show_less{display:none}
</style>
</head>
<body>';
ValidateUser::heading2();
echo'
<div class="container">
<div class="rows">
<div class="col-xs-12 col-sm-12 col-md-lg col-lg-12">
<ol class="breadcrumb"> 
<li><a href="#"><i class="fa fa-home"></i>ADMIN</a></li> 
<li class=""><i class="fa fa-users"></i> DASHBOARD</li> 
<li class="active">Edit Teacher"s Subject/Classes</li>  
</ol>';

echo'
<h4 class="page-header text-primary"><i class="fa fa-pencil"></i> Edit Subjects/Classes</h4>';

	if(isset($_POST['checked'])){
		echo'<form  class="form-horizontal" action="do_edit_subjects.php" onsubmit="event.preventDefault();" method="POST" >
<table class="table table-striped table-bordered" id="dataTables-example">
<thead>
<tr><td align="center" class="text-danger">SUBJECT</td>
<td align="center" class="text-danger" >CLASS NAME</td>
<td align="center" class="text-danger">EDIT CELLS</td>
</tr></thead>';
		$subject_id=$_POST['checked'];
$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
 if($conn->connect_error){
	 die('could not connect to the database');
 }
 else{
	 foreach($subject_id as $id){
	 $select="SELECT * FROM subjects WHERE subject_id='$id'";
	 $query=$conn->query($select);
	while($results=$query->fetch_array(MYSQLI_ASSOC)){
		echo"<tr><td class='tbl' id='subject{$results['subject_id']}'>{$results['subject']}</td>
		<td class='tbl' id='class_name{$results['subject_id']}'>{$results['class_name']}</td>
		<td align='center'><button type='button' class='btn btn-primary btn-sm edit' id='edit{$results['subject_id']}' onclick='edit_row({$results['subject_id']});'>EDIT</button><button type='submit'  id='save{$results['subject_id']}' class='btn btn-success btn-sm save' onclick='save_row({$results['subject_id']});'>SAVE</button></td></tr>";
					}
				}
			}
		echo'
		</table>
		</form><br><br>
		</div>
		</div>
		</div>
		';
}
	else{
		
		echo'<span style="color:red"><i class="fa fa-warning"></i> No Subject/Subjects Selected</span>
		</div>
		</div>
		</div>';
		
		
	}
}
if(isset($_POST['delete'])){
		if(isset($_POST['usrcd'])){
		$usrcd=$_POST['usrcd'];
		
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
ob_start();
echo'<!DOCTYPE HTML>
<html>
<head><title>Edit Teachers Information</title>
<meta name="viewport" content="width=device-width initial-scale=1">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.css" rel="stylesheet" type="text/css">
<link href="css/eportalstyle.css" rel="stylesheet" type="text/css">
<link href="css/sb-admin-2.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="dist/css/bootstrap-datepicker.css"/>
  <link href="css/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
	
<style type="text/css">
.footer{background:black;
color:white;
position:fixed;
bottom:0px;
width:100%;}
.link{text-decoration:none;color:white}
a:hover{text-decoration:none;color:white}
body{position:relative;}
.save{display:none}
#show_less{display:none}
</style>
</head>
<body>';
ValidateUser::heading2();
echo'
<div class="container">
<div class="rows">
<div class="col-xs-12 col-sm-12 col-md-lg col-lg-12">
<ol class="breadcrumb"> 
<li><a href="#"><i class="fa fa-home"></i>ADMIN</a></li> 
<li class=""><i class="fa fa-users"></i> DASHBOARD</li> 
<li class="active">Drop Subject/Subjects</li>  
</ol>';

echo'
<h4 class="page-header text-primary"><i class="fa fa-pencil"></i> Drop Subject/Subjects</h4>';
  


$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
 if($conn->connect_error){
	 die('could not connect to the database');
 }
 else{
	 
	if(isset($_POST['checked'])){
		$subject_id=$_POST['checked'];
		$num_id=sizeof($subject_id);
		$status=false;
	 foreach($subject_id as $id){
	$select="SELECT * FROM assign_subjects WHERE subject_id='$id' AND teacher_id !='0'";
	 $query=$conn->query($select);
	 if($query->num_rows>0){
	 while($results=$query->fetch_array(MYSQLI_ASSOC)){
		 $class_name=$results['class_name'];
			$array_subjects[]=$results['subject_name'];
			$array_className[]=$class_name;
			$json1=json_encode($array_subjects);
			$json2=json_encode($array_className);
			
	 }		
	 //$delete="Delete  FROM subjects WHERE subject_id='$id'";
	 //$query=$conn->query($delete);
		$_SESSION['subjects_assigned']=json_decode($json1);
		$_SESSION['class_assigned']=json_decode($json2);
	header('location:all_subjects.php?usrcd='.$usrcd.'');
		}
		else{
			
			$select="SELECT * FROM subjects WHERE subject_id='$id'";
			$query=$conn->query($select);
			while($results=$query->fetch_array(MYSQLI_ASSOC)){
								$class_name=$results['class_name'];
								$restore_subjects[]=$results['subject'];
								$array_className[]=$class_name;
								$json1=json_encode($restore_subjects);
								$json2=json_encode($array_className);
		}
		$delete="DELETE FROM subjects WHERE subject_id='$id'";
		$query=$conn->query($delete);
		$delete="DELETE FROM assign_subjects WHERE subject_id='$id'";
		$query=$conn->query($delete);
		$delete="DELETE FROM time_table WHERE subject_id='$id'";
		$query=$conn->query($delete);
		$id++;
		$status=true;
			}
	 }
		if($status==true){
		$_SESSION['delete_success']="Subject/Subjects were deleted successfully <a href='undo_subject_delete.php?s_id=".base64_encode($json1)."&c_name=".base64_encode($json2)."&usrcd=$usrcd&usr_nxmx=$username'><i class='fa fa-reply'></i> undo</a>";
		header('location:all_subjects.php?usrcd='.$usrcd.'');	
		ob_flush();
		}
		else{echo"An error has occurred";}
	}
	else{
		
		
		echo"<span style='color:red'>No Subject/Subjects Selected</span>";
	}
 
 }
echo'
</table>
</form><br><br>
</div>
</div>
</div>
';
}	

?>
<div class="footer">
		<footer>
<p align="center"> <strong>&copy <?php echo date('Y');?>  Vinebranch School Management System </strong></p>
</footer>
</div>
<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="datatables/js/jquery.dataTables.min.js"></script>
    <script src="datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="datatables-responsive/dataTables.responsive.js"></script>
	  <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
<script type="text/javascript" src="dist/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
$("#datepicker").datepicker();
</script>
<script>
	
	 function edit_row(id){
		 var subject_name=document.getElementById("subject"+id).innerHTML;
		 var class_name=document.getElementById("class_name"+id).innerHTML;
		 document.getElementById("subject"+id).innerHTML="<input type='text' id='subject_update"+id+"' value='"+subject_name+"' />";
		 document.getElementById("class_name"+id).innerHTML="<input type='text' id='class_update"+id+"' value='"+class_name+"' />";
		 document.getElementById('edit'+id).style.display="none";
		 document.getElementById('save'+id).style.display="block";
	 } 
	 
	 function save_row(id){
		  document.getElementById('edit'+id).style.display="block";
		 document.getElementById('save'+id).style.display="none";
		 var  subject_name=document.getElementById("subject_update"+id).value;
		 var  class_name=document.getElementById("class_update"+id).value;
		 $.ajax({
			 
			 type:'POST',
			 url:'do_edit_subjects.php',
			 data:{
				 edit_row:'edit_row',
				 subject_name:subject_name,
				 class_name:class_name,
				 td_id:id
			 },
			 
			 success:function(response){
				 if(response=="success"){
					 document.getElementById("subject"+id).innerHTML=subject_name;
					 document.getElementById("class_name"+id).innerHTML=class_name;
					 }  
			 }
			 
		 });
		 
	 }
	 
</script>
</body>
</html>