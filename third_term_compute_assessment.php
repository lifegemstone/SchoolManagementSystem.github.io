<?php 

include_once("validate_user.php");
//include_once('functions.php');
if(isset($_GET['s_id'])){
	$student_id=$_GET['s_id'];
	
}
else{
	
		exit();
}
if(isset($_GET['c_name'])){
	$class_name=$_GET['c_name'];
	
}
if(isset($_GET['f_tr'])){
	$third_term=$_GET['f_tr'];
}
$subjects_name=array();
$params=array();
?>
<!DOCTYPE HTML>
<html>
<head><title>Compute Third Term Assessment Report</title>
<meta name="viewport" content="width=device-width initial-scale=1">
<link href="MDB-Free_4.7.1/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.css" rel="stylesheet" type="text/css">
<link href="MDB-Free_4.7.1/css/mdb.min.css" rel="stylesheet" type="text/css">
<link href="MDB-Free_4.7.1/css/style.css" rel="stylesheet" type="text/css">
<link href="css/eportalstyle.css" rel="stylesheet" type="text/css">
<link href="css/sb-admin-2.css" rel="stylesheet" type="text/css">
  <link href="css/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
	<script type="text/javascript" src="MDB-Free_4.7.1/js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="MDB-Free_4.7.1/js/popper.min.js"></script>
	<script type="text/javascript" src="MDB-Free_4.7.1/js/bootstrap.js"></script>
	<script type="text/javascript" src="MDB-Free_4.7.1/js/mdb.min.js"></script>
<style type='text/css'>
.footer{background:black;
color:white;
position:fixed;
bottom:0px;
width:100%;}
.link{text-decoration:none;color:white}
a:hover{text-decoration:none;color:black}
body{position:relative;}
.end_term{text-align:center!important}
.start_term{text-align:center!important}
.spacing{padding-top:0!important}
.conduct{padding-top:0!important}
</style>
</head>
<body>
<?php  validateUser::heading4();
//heading();?><br>
<div class="container">
<div class="rows">
<div class="col-xs-12 col-sm-12 col-md-lg col-lg-12">
<ol class="breadcrumb"> 
<li class='breadcrumb-item'><a href="#"><i class="fa fa-home"></i>TEACHERS</a></li> 
<li class="breadcrumb-item"><i class='fa fa-dashboard'></i> DASHBOARD</li> 
<li class="breadcrumb-item active">Compute Third Term Assessment Report</li>  
</ol><br>
<h5 style='border-bottom:1px solid #eee;line-height:180%'><i class="fa fa-edit"></i>  Third Term  Assessments Reports </h5><br>
<?php  if(isset($_SESSION['error'])){
	
	echo"<div class='alert alert-warning'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h5 style='border-bottom:1px solid #eee;line-height:180%'><i class='fa fa-warning'></i> ERROR</h4>
			<p>".$_SESSION['error']."</p>
			</div>"; 
			unset($_SESSION['error']);
}

$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
if($conn->connect_error){
	die('could not connect to the database');
}
else{
		
		$select="SELECT student_name,class_name,sex,date_birth,student_img FROM students  WHERE student_id='$student_id'";
		$query=$conn->query($select);
		echo"<div class='row'>";
		while($results=$query->fetch_array(MYSQLI_ASSOC)){
		echo"
		<div class='col-sm-12 col-md-4 col-lg-4'>
			<img src='studentImages/{$results['student_img']}' class='img-fluid rounded z-depth-2' alt='image'>
			<br><br>
		</div>
		<div class='col-sm-12 col-md-8 col-lg-8'>
			<h6><strong>STUDENT NAME:</strong> ".ucwords($results['student_name'])."</h6>
			<h6><strong>SEX:</strong> {$results['sex']}</h6>
			<h6><strong>AGE:</strong>";
			$current_timestamp=time();
									$current_year=date('Y',$current_timestamp);
									$birth_year=date('Y',strtotime($results['date_birth']));
									$age=$current_year-$birth_year;
									if($age>0){
									echo " $age yrs";
									}
									else{
										echo " $age yr";
									}
									echo"</h6>";
			echo"<h6><strong>CLASS:</strong> {$results['class_name']}</h6>
			</div>";
		}
	echo"</div>";
}
	
	?>

		<br>
	<?php
	
	
	if(!isset($_SESSION['success'])){
		echo"
		<form method='POST' action='do_third_term_compute_assessment.php'>
		<h5 style='border-bottom:1px solid #eee;line-height:180%'><i class='fa fa-arrow-circle-right' style='color:red'></i> ASSESSMENTS REPORTS</h5><br>
		<div class='row'>
		<div class='col-sm-4 col-md-4 col-lg-4'>
		<h6 class='text-primary'>ATTENDANCE RECORD</h6>
<div class='table-responsive'>
<table class='table table-bordered'>
<tr>
	<th>No of times School Opened</th>
	<th>No of times Present</th>
	<th>No of times School Absent</th>
</tr>
<tr>
	<td><input type='text' name='sch_open' class='form-control' /></td>
	<td><input type='text' name='num_present' class='form-control' /></td>
	<td><input type='text' name='num_absent' class='form-control' /></td>
</tr>
</table>
</div>
</div>
<div class='col-sm-4 col-md-4 col-lg-4'>
<h6 class='text-primary'><i class='fa fa-calendar'></i> CALENDAR</h6>
<div class='table-responsive'>
<table class='table table-bordered'>
<tr>
	<td><strong>Beginning of Term:</strong><input type='text' name='start_term' class='form-control datepicker' /></td>
	<td><strong>End of Term:</strong><input type='text' name='end_term' class='form-control datepicker' /></td>
	<td><strong>Teachers Comment:</strong><input type='text' name='teacher_comment' class='form-control' /></td>
</tr>
</table>
</div>
</div>
<div class='col-sm-4 col-md-4 col-lg-4'>
<h6 class='text-primary'> HEALTH & PHYSICAL DEVELOPMENT</h6>
<div class='table-responsive'>
<table class='table table-bordered'>
<tr>
	<th>HEIGHT(m)</th>
	<th>WEIGHT(kg)</th>
</tr>
<tr>
<th class='start_term' colspan='2'>Beginning Of Term</th></tr>
<tr>
	<td><input type='text' name='height_start' class='form-control' /></td>
	<td><input type='text' name='weight_start' class='form-control' /></td>
</tr>
<tr>
<th colspan='2' class='end_term'>End Of Term</th></tr>
<tr>
	<td><input type='text' name='height_end' class='form-control' /></td>
	<td><input type='text' name='weight_end' class='form-control' /></td>
</tr>
</table>
</div>
</div>
</div>
<input type='hidden' name='term' value='$third_term' />
<input type='hidden' name='student_id' value='$student_id' />
<input type='hidden' name='class_name' value='$class_name' />
<button type='submit' class='btn btn-md aqua-gradient'>SUBMIT</button>
</form>";
	}
	
	else{
		
		
		if(isset($_SESSION['success'])){
	
	echo"<div class='alert alert-success'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h5 style='border-bottom:1px solid #eee;line-height:180%'><i class='fa fa-check'></i> SUCCESS</h5>
			<p>".$_SESSION['success']."</p>
			</div>"; 
			unset($_SESSION['success']);
			echo"<button type='button' class='btn btn-sm btn-primary'><a href='third_term.php?s_id=$student_id &c_name=$class_name &f_tr=$third_term' style='color:white'><i class='fa fa-angle-double-left'></i> BACK</a></button>

			<button type='button' class='btn btn-sm btn-success'><a href='third_term_cognitive_report.php?s_id=$student_id &c_name=$class_name &f_tr=$third_term' style='color:white'> NEXT <i class='fa fa-angle-double-right'></i></a></button>";
				}
			
			}
		
		
		
?>
	
			</div>
			 </div>
			 </div><br><br><br>
<div class="footer">
		<footer>
<p align="center"> <strong>&copy  <?php echo''.date("Y").'';?> Vinebranch School Management System </strong></p>
</footer>
<script>
$(document).ready(function(){
	$('.datepicker').datepicker();
});
		</script>
</body>
</html>
</body>
</html>