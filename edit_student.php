<?php 

include_once("validate_user.php");
 //include_once('functions.php');
if(isset($_GET['s_id'])){
	$student_id=$_GET['s_id'];
}
else{
			exit();
}
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
<head><title>Edit Student Information</title>
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
#hidden{display:none}
</style>
</head>
<body>
<?php  //validateUser::heading();
 validateUser::heading2()?>
<div class="container">
<div class="rows">
<div class="col-xs-12 col-sm-12 col-md-lg col-lg-12">
<ol class="breadcrumb"> 
<li><a href="#"><i class="fa fa-home"></i>ADMIN</a></li> 
<li class=""><i class='fa fa-users'></i> DASHBOARD</li> 
<li class="active">Edit Student's Information</li>  
</ol>
<?php if(isset($_SESSION['stud_edit_success_msg'])){
	
	echo"<div class='alert alert-success'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h4 class='page-header'>SUCCESS</h4>
			<p>".$_SESSION['stud_edit_success_msg']."</p>
			</div>"; 
			unset($_SESSION['stud_edit_success_msg']);
}

if(isset($_SESSION['stud_edit_error_msg'])){
	
	echo"<div class='alert alert-success'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h4 class='page-header'>SUCCESS</h4>
			<p>".$_SESSION['stud_edit_error_msg']."</p>
			</div>"; 
			unset($_SESSION['stud_edit_error_msg']);
}

 if(isset($_SESSION['stud_errors'])){
	 echo "<div class='alert alert-danger'>
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true' href='#'> &times </button>
			<h4 class='page-header'><i class='fa fa-warning'></i> ERROR</h4>
			<p>Sorry the following errors occurred while trying to Edit Student personal information. Kindly attend to these errors and try again!!!</p>";
	 foreach($_SESSION['stud_errors'] as $_SESSION['stud_error'])
	  { 
			
			echo"<p><i class='fa fa-warning'></i> ".$_SESSION['stud_error']." .</p>";
			
			
	  }
	
	  echo"</div>";
	    unset($_SESSION['stud_errors']);
 }
?>
<h4 class="page-header text-primary"><i class="fa fa-user"></i> Students's Registered Information</h4>
<form  class="form-horizontal" action="do_editStudents_info.php" enctype='multipart/form-data' method="POST">
<?php
$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
if($conn->connect_error){
	die('could not connect to the database');
}
else{
		$select="SELECT * FROM students WHERE student_id='$student_id'";
		$query=$conn->query($select);
		while($results=$query->fetch_array(MYSQLI_ASSOC)){
			$student_img=$results['student_img'];
			echo'
<div class="form-group">
<label for="surname" class="col-sm-3 control-label">Student Name *</label>
<div class="col-sm-7">
<input type="text" name="student_name" value="'.$results['student_name'].'" autocomplete="off"  placeholder="Student Name" class="form-control"/>
</div>
</div>
<div class="form-group">
<label for="sex" class="col-sm-3 control-label"><i class="fa fa-child"></i> SEX *</label>
<div class="col-sm-7">';
if($results['sex']=="M"){
	echo'
<input type="radio" name="sex"  checked value="M" /> Male <input type="radio" name="sex" value="F" /> Female';}
elseif($results['sex']=="F"){
	echo'
	<input type="radio" name="sex"  value="M" /> Male <input type="radio" name="sex" checked value="F" /> Female
	';
}
echo'
</div>
</div>
<div class="form-group">
<label for="className" class="col-sm-3 control-label"><i class="fa fa-building"></i> Class Name *</label>
<div class="col-sm-7">
<select name="class_name" class="form-control">';
$select="SELECT * FROM school_classes";
$query=$conn->query($select);
while($query_result=$query->fetch_array(MYSQLI_ASSOC)){
	if($query_result['class_name']==$results['class_name']){
		echo"<option selected>{$query_result['class_name']}</option>";
	}
	else{
		
		echo"<option>{$query_result['class_name']}</option>";
	}
	
}
echo'</select>
</div>
</div>

<div class="form-group">
<label for="d.o.b" class="col-sm-3 control-label"><i class="fa fa-calendar"></i> D.O.B * </label>
<div class="col-sm-5">
<input type="text" name="date_birth" value="'.$results['date_birth'].'" id="datepicker" autocomplete="off" placeholder="Date of Birth" class="form-control calendar"/>
</div>
</div>
<div class="form-group">
<label for="d.o.b" class="col-sm-3 control-label">Parent Name * </label>
<div class="col-sm-5">
<input type="text" name="parent_name" value="'.$results['parent_name'].'" autocomplete="off" placeholder="Parent Namr" class="form-control"/>
</div>
</div>
<div class="form-group">
<label for="address" class="col-sm-3 control-label"><i class="fa fa-map-marker"></i> Home Address *</label>
<div class="col-sm-7">
<input type="text" name="home_address"  value="'.$results['home_address'].'"autocomplete="off"  placeholder="Address" class="form-control"/>
</div>
</div>
<div class="form-group">
<label for="telephone" class="col-sm-3 control-label"><i class="fa fa-phone"></i> Parent Telepone Number *</label>
<div class="col-sm-5">
<input type="text" name="telephone_no" value="'.$results['telephone_no'].'" autocomplete="off" placeholder="Telephone Number" class="form-control"/>
</div>
</div>
<input type="hidden"  name="student_img" value="'.$results['student_img'].'"  />';

echo"<div class='col-sm-offset-3'>
		<img src='studentImages/{$results['student_img']}' class='img-rounded' width='200px' height='200px' id='img_change' alt='image'><br><br><button type='button' class='btn btn-xs btn-success' id='change'>change picture</button>
	</div><br><br><br>";						
echo'<div id="hidden"><h5 class="page-header text-danger"><i class="fa fa-image"></i> Upload Image</h5>
<div class="form-group">
<label for="image" class="col-sm-3 control-label">Upload Picture *</label>
<input type="file" id="img" name="img"/></div></div><br>';
				}
			}
		
	?>
<label  class="col-sm-3 control-label">
	<input type="hidden"  name="student_id" value='<?php echo"$student_id";?>' >
	<input type="hidden"  name="usrcd" value='<?php echo"$usrcd";?>' >
<button type="submit" class="btn btn-md btn-primary"><i class="fa fa-pencil"></i> Edit Student's Information</button></label><br><br><br><br>
</div>
</form>

			 </div>
			 </div>
			 </div>
<div class="footer">
		<footer>
<p align="center"> <strong>&copy  <?php echo''.date("Y").'';?> Vinebranch School Management System </strong></p>
</footer>
<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/bootstrap.js"></script>
<script type="text/javascript" src="dist/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
$("#datepicker").datepicker();
</script>
<script>
$(document).ready(function(){
$('#change').click(function(){
	$('#hidden').show();
	
	$('#change').hide();
		});
		function readURL(input){
			if(input.files && input.files[0]){
				
				var reader=new FileReader();
				reader.onload=function(e){
					$('#img_change').attr('src',e.target.result);
				}
				
				reader.readAsDataURL(input.files[0]);
				
			}
			
		}
		$('#img').change(function(){
			readURL(this);
			});
			
			//reloads the page when the modal is closed
		
			
})
</script>
</body>
</html>
</body>
</html>