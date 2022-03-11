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
if(isset($_GET['t_id'])){
	$teacher_id=$_GET['t_id'];
}
else{
			exit();
}
?>
<!DOCTYPE HTML>
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
<?php  validateUser::heading2();
//heading();?>
<div class="container">
<div class="rows">
<div class="col-xs-12 col-sm-12 col-md-lg col-lg-12">
<ol class="breadcrumb"> 
<li><a href="#"><i class="fa fa-home"></i>ADMIN</a></li> 
<li class=""><i class='fa fa-users'></i> DASHBOARD</li> 
<li class="active">Edit Teacher's Information</li>  
</ol>
<?php if(isset($_SESSION['infoEdit_msg'])){
	
	echo"<div class='alert alert-success'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h4 class='page-header'>SUCCESS</h4>
			<p>".$_SESSION['infoEdit_msg']."</p>
			</div>"; 
			unset($_SESSION['infoEdit_msg']);
}

if(isset($_SESSION['noEdit_msg'])){
	
	echo"<div class='alert alert-success'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h4 class='page-header'>SUCCESS</h4>
			<p>".$_SESSION['noEdit_msg']."</p>
			</div>"; 
			unset($_SESSION['noEdit_msg']);
}

 if(isset($_SESSION['infoEditError_msg'])){
	 echo "<div class='alert alert-danger'>
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true' href='#'> &times </button>
			<h4 class='page-header'><i class='fa fa-warning'></i> ERROR</h4>
			<p>Sorry the following errors occurred while trying to Edit teachers personal information. Kindly attend to these errors and try again!!!</p>";
	 foreach($_SESSION['infoEditError_msg'] as $_SESSION['infoEditError'])
	  { 
			
			echo"<p><i class='fa fa-warning'></i> ".$_SESSION['infoEditError']." .</p>";
			
			
	  }
	
	  echo"</div>";
	    unset($_SESSION['infoEditError_msg']);
 }
?>
<h4 class="page-header text-primary"><i class="fa fa-user"></i> Teacher's Registered Information</h4>
<form  class="form-horizontal" action="do_editTeachers_info.php" enctype='multipart/form-data' method="POST">
<?php
$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
if($conn->connect_error){
	die('could not connect to the database');
}
else{
		$select="SELECT * FROM teachers WHERE teacher_id='$teacher_id'";
		$query=$conn->query($select);
		while($results=$query->fetch_array(MYSQLI_ASSOC)){
			$teacher_img=$results['teacher_img'];
			echo'
<div class="form-group">
<label for="surname" class="col-sm-3 control-label">Teacher Name *</label>
<div class="col-sm-7">
<input type="text" name="teacher_name" value="'.$results['teacher_name'].'" autocomplete="off"  placeholder="Teacher Name" class="form-control"/>
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
<label for="d.o.b" class="col-sm-3 control-label"><i class="fa fa-calendar"></i> D.O.B * </label>
<div class="col-sm-5">
<input type="text" name="date_birth" value="'.$results['date_birth'].'" id="datepicker" autocomplete="off" placeholder="Date of Birth" class="form-control calendar"/>
</div>
</div>
<div class="form-group">
<label for="address" class="col-sm-3 control-label"><i class="fa fa-map-marker"></i> Home Address *</label>
<div class="col-sm-7">
<input type="text" name="home_address"  value="'.$results['home_address'].'"autocomplete="off"  placeholder="Address" class="form-control"/>
</div>
</div>
<div class="form-group">
<label for="telephone" class="col-sm-3 control-label"><i class="fa fa-phone"></i> Telepone Number *</label>
<div class="col-sm-5">
<input type="text" name="telephone" value="'.$results['telephone'].'" autocomplete="off" placeholder="Telephone Number" class="form-control"/>
</div>
</div>
<div class="form-group">
<label for="email" class="col-sm-3 control-label"><i class="fa fa-envelope"></i> E-mail Address *</label>
<div class="col-sm-5">
<input type="text" name="email" value="'.$results['email'].'" autocomplete="off" placeholder="E-mail Address" class="form-control"/>
</div>
</div>
<input type="hidden"  name="teacher_img" value="'.$results['teacher_img'].'"  />';

echo"<div class='col-sm-offset-3'>
		<img src='teachersImages/{$results['teacher_img']}' class='img-rounded' width='200px' height='200px' id='img_change' alt='image'><br><br><button type='button' class='btn btn-xs btn-success' id='change'>change picture</button>
	</div><br><br><br>";						
echo'<div id="hidden"><h5 class="page-header text-danger"><i class="fa fa-image"></i> Upload Image</h5>
<div class="form-group">
<label for="image" class="col-sm-3 control-label">Upload Picture *</label>
<input type="file" id="img" name="img"/></div></div><br>';

				}
			}
		
	?>
<label  class="col-sm-3 control-label">
	<input type="hidden"  name="teacher_id" value='<?php echo"$teacher_id";?>' >
	<input type="hidden"  name="usrcd" value='<?php echo"$usrcd";?>' >
<button type="submit" class="btn btn-md btn-primary"><i class="fa fa-pencil"></i> Edit Teacher's Information</button></label><br><br><br><br>
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