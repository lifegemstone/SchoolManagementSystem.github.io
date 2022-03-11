<?php 

include_once("validate_user.php");
include_once('functions.php');
if(isset($_GET['stud_id'])){
	$student_id=$_GET['stud_id'];
}
else{
	
		exit();
}
if(isset($_GET['class_name'])){
	$class_name=$_GET['class_name'];
}
$subjects_name=array();
$params=array();
?>
<!DOCTYPE HTML>
<html>
<head><title>Create Report Card</title>

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
<li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i>TEACHERS</a></li> 
<li class="breadcrumb-item"><i class='fa fa-dashboard'></i> DASHBOARD</li> 
<li class="breadcrumb-item active">Create Report Card</li>  
</ol>
<h5 style="border-bottom:1px solid #eee;line-height:180%"><i class="fa fa-edit"></i> Create Report Card</h5><br>
<?php
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
		<img src='studentImages/{$results['student_img']}' class='img-fluid rounded z-depth-2'>
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

		<br><br>
<h5 style="border-bottom:1px solid #eee;line-height:180%"> ASSESSMENTS REPORTS</h5>
<?php
echo"<button class='btn blue-gradient btn-lg'><a href='first_term.php?f_tr=1st Term&c_name=$class_name&s_id=$student_id' style='text-decoration:none;color:white'>Create 1st Term Report</a></button>
<button class='btn peach-gradient btn-lg'><a href='second_term.php?f_tr=2nd Term&c_name=$class_name&s_id=$student_id'  style='text-decoration:none;color:white'>Create 2nd Term Report</a></button>
<button class='btn aqua-gradient btn-lg'><a href='third_term.php?f_tr=3rd Term&c_name=$class_name&s_id=$student_id' style='text-decoration:none;color:white'>Create 3rd Term Report</a></button>";
?>
			</div>
			 </div>
			 </div><br><br><br>
<div class="footer">
		<footer>
<p align="center"> <strong>&copy  <?php echo''.date("Y").'';?> Vinebranch School Management System </strong></p>
</footer>
</body>
</html>
</body>
</html>