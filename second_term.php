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
	$second_term=$_GET['f_tr'];
	
}
$subjects_name=array();
$params=array();
?>
<!DOCTYPE HTML>
<html>
<head><title>Create Second Term Report Card</title>
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
<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/bootstrap.js"></script>
<script  src="dist/js/bootstrap-datepicker.js"></script>
<script src="datatables/js/jquery.dataTables.min.js"></script>
<script src="datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="datatables-responsive/dataTables.responsive.js"></script>
<body>
<?php  //validateUser::heading();
validateUser::heading4();?><br>
<div class="container">
<div class="rows">
<div class="col-xs-12 col-sm-12 col-md-lg col-lg-12">
<form method="POST" action="do_firstTerm.php">
<ol class="breadcrumb"> 
<li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i>TEACHERS</a></li> 
<li class="breadcrumb-item"><i class='fa fa-dashboard'></i> DASHBOARD</li> 
<li class="breadcrumb-item active">Create Report Card</li>  
</ol><br>
<h5 style="border-bottom:1px solid #eee;line-height:180%"><i class="fa fa-edit"></i> Create Second Term Report Card</h5><br>
<?php
$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
if($conn->connect_error){
	die('could not connect to the database');
}
else{
		
		$select="SELECT student_name,class_name,sex,date_birth,student_img FROM students  WHERE student_id='$student_id'";
		$query=$conn->query($select);
		echo "<div class='row'>";
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
		<div class='alert alert-danger'>
		
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
		
		<h5 style="border-bottom:1px solid #eee;line-height:180%">HELP <i class='fa fa-question'></i></h5>
		<p>Computing a complete Student report card involves three(3) steps;<br>
		<strong>STEP 1</strong>:Computing Assessment Reports</p>
		<p><strong>STEP 2</strong>:Computing Cognitive Records</p>
		<p><strong>STEP 3</strong>:Computing Observation of Conduct assessment</p>
		</div>
		<button type='button' class='btn btn-md blue-gradient'><?php echo"<a href='second_term_compute_assessment.php?s_id=$student_id &c_name=$class_name &f_tr=$second_term' style='color:white'><i class='fa fa-edit'></i> Compute Assessment Report</a></button>"; ?> 
		<button type='button' class='btn btn-md purple-gradient'><?php echo"<a href='second_term_compute_cognitive_report.php?s_id=$student_id &c_name=$class_name &f_tr=$second_term' style='color:white'><i class='fa fa-table'></i> Compute Cogntive Report</a></button>"; ?> 
		
		<button type='button' class='btn btn-md aqua-gradient'><?php echo"<a href='second_term_observation_conduct_report.php?s_id=$student_id &c_name=$class_name &f_tr=$second_term' style='color:white'><i class='fa fa-edit'></i> Compute Observation of Conduct Report</a></button>"; ?> 
		
		
	

<!----End First Term---->

	
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