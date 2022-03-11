<?php 

include_once("validate_user.php");
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
	

?>
<!DOCTYPE HTML>
<html>
<head><title>Students Registration</title>
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
<?php  validateUser::heading2();
//heading();?>
<div class="container">
<div class="rows">
<div class="col-xs-12 col-sm-12 col-md-lg col-lg-12">
<ol class="breadcrumb"> 
<li><a href="#"><i class="fa fa-home"></i>ADMIN</a></li> 
<li class=""><i class='fa fa-graduation-cap'></i> DASHBOARD</li> 
<li class="active">STUDENTS REGISTRATION</li> 
</ol>
<?php if(isset($_SESSION['stud_success_msg'])){
	
		
			echo"<div class='alert alert-success'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h4 class='page-header'>SUCCESS</h4>";
	    echo"<p>".$_SESSION['stud_success_msg']."</p>
			</div>"; 
			unset($_SESSION['stud_success_msg']);
}
 if(isset($_SESSION['stud_error_msg'])){
	 echo "<div class='alert alert-danger'>
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true' href='#'> &times </button>
			<h4 class='page-header'><i class='fa fa-warning'></i> ERROR</h4>
			<p>Sorry the following errors occurred while trying to register patient. Kindly attend to these errors and try again!!!</p>";
	 foreach($_SESSION['stud_error_msg'] as $_SESSION['error'])
	  { 
			
			echo"<p><i class='fa fa-warning'></i> ".$_SESSION['error']." .</p>";
			
			
	  }
	
	  echo"</div>";
	    unset($_SESSION['stud_error_msg']);
 }
?>
<h4 class="page-header text-primary"><i class="fa fa-user"></i> Student Registration</h4>
<form  class="form-horizontal" action="do_students_registration.php" enctype='multipart/form-data' method="POST">
<div class="form-group">
<label for="surname" class="col-sm-3 control-label">Student Name *</label>
<div class="col-sm-7">
<input type="text" name="student_name" autocomplete="off"  placeholder="Student Name" class="form-control"/>
</div>
</div>
<div class="form-group">
<label for="sex" class="col-sm-3 control-label"><i class="fa fa-child"></i> SEX *</label>
<div class="col-sm-7">
<input type="radio" name="sex" value="M" /> Male <input type="radio" name="sex" value="F" /> Female
</div>
</div>
<div class="form-group">
<label for="d.o.b" class="col-sm-3 control-label"><i class="fa fa-calendar"></i> D.O.B * </label>
<div class="col-sm-5">
<input type="text" name="date_birth"  id="datepicker" autocomplete="off" placeholder="Date of Birth" class="form-control calendar"/>
</div>
</div>
<div class="form-group">
<label for="class" class="col-sm-3 control-label"><i class="fa fa-building"></i> Class *</label>
<div class="col-sm-5">
<select name="class_name" class="form-control">
<?php
$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
$select="SELECT class_name FROM school_classes ORDER BY class_name";
$query=$conn->query($select);
while($results=$query->fetch_array(MYSQLI_ASSOC)){
		echo"<option>{$results['class_name']}</option>";
}


?>
</select>
</div>
</div>
<div class="form-group">
<label for="class" class="col-sm-3 control-label"><i class="fa fa-calendar"></i> Current Session *</label>
<div class="col-sm-5">
<input type="text" name="class_session"  value='<?php  $now=time();
$start_year=date('Y',$now);
$end_year=$start_year+1;
echo"$start_year"."/"."$end_year";?>' disabled class="form-control" />
</div>
</div>
<h5 class='page-header text-danger'><i class='fa fa-info-circle'></i> Parents Information</h5>
<div class="form-group">
<label for="occupation" class="col-sm-3 control-label">Parent's Name *</label>
<div class="col-sm-5">
<input type="text" name="parent_name" autocomplete="off"  placeholder="Parent Name" class="form-control"/>
</div>
</div>
<div class="form-group">
<label for="address" class="col-sm-3 control-label">Home Address *</label>
<div class="col-sm-7">
<input type="text" name="home_address" autocomplete="off"  placeholder="Address" class="form-control"/>
</div>
</div>
<div class="form-group">
<label for="telephone" class="col-sm-3 control-label">Telepone Number *</label>
<div class="col-sm-5">
<input type="text" name="telephone_no" autocomplete="off" placeholder="Telephone Number" class="form-control"/>
</div>
</div>
<input type="hidden" name="usrcd" value='<?php echo"$usrcd";?>' />
<h5 class='page-header text-danger'><i class='fa fa-image'></i> Upload Image</h5>
<div class="form-group">
<label for="image" class="col-sm-3 control-label">Upload Picture *</label>
<input type="file" name="img"/><br>
<label  class="col-sm-3 control-label">
<button type="submit" class="btn btn-md btn-primary"><i class='fa fa-user-plus'></i>ADD Student</button></label><br><br><br><br>
</div>
</form>
			 </div>
			 </div>
			 </div>
<div class="footer">
		<footer>
<p align="center"> <strong>&copy <?php echo date('Y');?>  Vinebranch School Management System </strong></p>
</footer>
<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/bootstrap.js"></script>
<script type="text/javascript" src="dist/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">


$("#datepicker").datepicker();
</script>
</body>
</html>
</body>
</html>