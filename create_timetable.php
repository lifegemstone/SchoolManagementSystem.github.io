<?php
//require_once("C:/wamp/dbconn_vbsms.php");
include_once("validate_user.php");
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
//require_once("functions.php");
if(isset($_GET['t_id'])){
	$teacher_id=$_GET['t_id'];

}
$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
if($conn->connect_error){
	die('could not connect to the database');
}
else{
	
	
	$select="SELECT teacher_name from teachers WHERE teacher_id='$teacher_id'";
	$query=$conn->query($select);
	$result=$query->fetch_array(MYSQLI_ASSOC);
	$teacher_name=$result['teacher_name'];
}

?>
<!DOCTYPE HTML>
<html>
<head><title>Create Time-Table</title>
<meta name="viewport" content="width=device-width initial-scale=1">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.css" rel="stylesheet" type="text/css">
<link href="css/eportalstyle.css" rel="stylesheet" type="text/css">
<link href="css/sb-admin-2.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="dist/css/bootstrap-datepicker.css"/>
  <link href="css/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
	
<style type='text/css'>
.footer{background:black;
color:white;
position:absolute;
bottom:0px;
width:100%;}
.link{text-decoration:none;color:white}
a:hover{text-decoration:none;color:white}
body{position:relative;}
</style>
</head>
<body>
<?php  validateUser::heading2();?>
<div class="container">
<div class="rows">
<ol class="breadcrumb"> 
<li><a href="#"><i class="fa fa-graduation-cap"></i>Vinebranch School Management System</a></li> 
<li class="active"><i class="fa fa-table"></i> Create Time-Table</li> 
</ol>



<?php 
if(isset($_SESSION['success_msg'])){
	echo'<div class="alert alert-success">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times; </button> '.$_SESSION['success_msg'].'
</div>';
unset($_SESSION['success_msg']);}

if(isset($_SESSION['subject_exists'])){
	echo'<div class="alert alert-danger">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times; </button>  &times '.$_SESSION['subject_exists'].'
</div>';
unset($_SESSION['subject_exists']);}

if(isset($_SESSION['errors'])){
	echo'<div class="alert alert-danger">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times; </button> 
<h4 class="page-header"><i class="fa fa-warning"></i> Error</h4>
<p> The following error/errors occurred while trying create-time table pls kindly attend to these error/errors and then try again later.';

		foreach($_SESSION['errors'] as $error){
			echo "<li> $error </li>";
		}
echo'</div>';
unset($_SESSION['errors']);
}


if(isset($_SESSION['time_error'])){
	echo'<div class="alert alert-danger">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times; </button> 
<h4 class="page-header"><i class="fa fa-warning"></i> Error</h4> 
'.$_SESSION['time_error'].'
</div>';
unset($_SESSION['time_error']);}

if(isset($_SESSION['error_msg'])){
	echo'<div class="alert alert-danger">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times; </button>  &times '.$_SESSION['error_msg'].'
</div>';
unset($_SESSION['error_msg']);}

if(isset($_SESSION['not_assigned'])){
	echo'<div class="alert alert-danger">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times; </button>  '.$_SESSION['not_assigned'].'
</div>';
unset($_SESSION['not_assigned']);}
?>
	<div class="form-horizontal" role="form">
		<form action="do_createtimetable.php" method="POST">
		<div class="container">
		<div class="rows">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="form-group">
				<label for="teacher_name" class="col-sm-3 control-label"> TEACHER'S NAME:</label>
				<div class="col-xs-10 col-sm-7 col-md-7 col-lg-7">
					<input type='text' name='teacher_name'  value='<?php echo"$teacher_name";?>' class='form-control'/>
					<br>
			</div>
			</div>
			<div class="form-group">
				<label for="CLASS GRADE" class="col-sm-3 control-label"> CLASS NAME :</label>
				<div class="col-xs-10 col-sm-3 col-md-3 col-lg-3">
				<select name="class_name" id='class_select' class="form-control">
					<option selected value="">----SELECT CLASS---</option>
					<?php 
					$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
					if($conn->connect_error){
						die('could not connect to the database');
					}
					else{
						$select="SELECT * FROM assign_subjects WHERE teacher_id='$teacher_id'";
						$query=$conn->query($select);
						$subjects=array();
						while($results=$query->fetch_array(MYSQLI_ASSOC)){
							
							$classes[]=$results['class_name'];
							$subject_id=$results['subject_id'];
						}
							$classes=array_unique($classes);
							foreach($classes as $class){
							echo"
					<option>$class</option>";
								}
						}
					?>
					</select>
					
				</div>
			</div>
			
		<div class="form-group">
				<label for="SUBJECT NAME" class="col-sm-3 control-label"> SUBJECT NAME :</label>
				<div class="col-xs-10 col-sm-3 col-md-3 col-lg-3">
				<select name="subject_name" class="form-control" id='ajax_replace'>
				<option selected value="" >----SELECT SUBJECT---</option>
				
				</select>
				</div>
				</div>
				</div>
			</div>
			</div>
		</div>
		<div class="container">
		<h4 class="text-primary page-header"><i class="fa fa-calendar"></i> CLASS DAYS/WEEK</h4>
		</div>
		<div class="lecture_days" >
		<div class="container">
		<div class="rows">
			<div class="col-xs-8 col-sm-12 col-md-12 col-lg-12">
				<div class="form-inline" role="form">
				<input type="checkbox" class="" name="class_day[]" value="monday"><span style="color:red">Mon</span>
				<label for="start time" class="text-primary">Class Starts:</label>
				<input type="text" class="form-control" name="mon_class_start" placeholder="Start Time" />
				<label for="start time" class="text-primary">Class Ends:</label>
				<input type="text" class="form-control" name="mon_class_end" placeholder="End Time" />
				</div>
			</div>
		</div>
		</div>
		</div><br>
		<div class="lecture_days" >
		<div class="container">
		<div class="rows">
			<div class="col-xs-8 col-sm-12 col-md-12 col-lg-12">
				<div class="form-inline" role="form">
				<input type="checkbox" class="" name="class_day[]" value="tuesday"><span style="color:red">Tue</span>
				<label for="start time" class="text-primary">Class Starts:</label>
				<input type="text" class="form-control" name="tue_class_start" placeholder="Start Time" />
				<label for="start time" class="text-primary">Class Ends:</label>
				<input type="text" class="form-control" name="tue_class_end" placeholder="End Time" />
				</div>
			</div>
		</div>
		</div>
		</div><br>
		<div class="lecture_days" >
		<div class="container">
		<div class="rows">
			<div class="col-xs-8 col-sm-12 col-md-12 col-lg-12">
				<div class="form-inline" role="form">
				<input type="checkbox" class="" name="class_day[]" value="wednessday"><span style="color:red">Wed</span>
				<label for="start time" class="text-primary">Class Starts:</label>
				<input type="text" class="form-control" name="wed_class_start" placeholder="Start Time" />
				<label for="start time" class="text-primary">Class Ends:</label>
				<input type="text" class="form-control" name="wed_class_end" placeholder="End Time" />
				</div>
			</div>
		</div>
		</div>
		</div><br>
		<div class="lecture_days" >
		<div class="container">
		<div class="rows">
			<div class="col-xs-8 col-sm-12 col-md-12 col-lg-12">
				<div class="form-inline" role="form">
				<input type="checkbox" class="" name="class_day[]" value="thursday"><span style="color:red">Thu</span>
				<label for="start time" class="text-primary">Class Starts:</label>
				<input type="text" class="form-control" name="thu_class_start" placeholder="Start Time" />
				<label for="start time" class="text-primary">Class Ends:</label>
				<input type="text" class="form-control" name="thu_class_end" placeholder="End Time" />
				</div>
			</div>
		</div>
		</div>
		</div><br>
		<div class="lecture_days" >
		<div class="container">
		<div class="rows">
			<div class="col-xs-8 col-sm-12 col-md-12 col-lg-12">
				<div class="form-inline" role="form">
				<input type="checkbox" class="" name="class_day[]" value="friday"><span style="color:red">Fri</span>
				<label for="start time" class="text-primary">Class Starts:</label>
				<input type="text" class="form-control" name="fri_class_start" placeholder="Start Time" />
				<label for="start time" class="text-primary">Class Ends:</label>
				<input type="text" class="form-control" name="fri_class_end" placeholder="End Time" />
				</div>
			</div>
		</div>
		</div>
		</div>
		<br><br>
		<div class="container">
		<input type='hidden' name='teacher_id' id='teacher_id' value='<?php echo"$teacher_id";?>' />
		<input type='hidden' name='usrcd' value='<?php echo"$usrcd";?>' />
			<input type='hidden' name='subject_id' value='<?php echo"$subject_id";?>' />
		<button type="submit" class="btn btn-success">Create Time-Table</button>
		</div>
	</form>
	</div>
</div>
</div>	<br><br>
<div class="footer">
		<footer>
<p align="center"> &copy <?php echo date('Y');?>  Vinebranch School Management System </p>
</footer>
			</div>
	<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/bootstrap.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$('#class_select').change(function(){
	var teacher_id=$('#teacher_id').val();
	var option;
	var selected_option;
	selected_option=$(this).children('option:selected').val();
	
option=escape(selected_option);
	$("#ajax_replace").load('fetch_classname.php?c_name=' +option+'&t_id='+teacher_id);
	
	
	
	
});	
	
	
	
	
	
	
});


</script>
</body>
</html>
