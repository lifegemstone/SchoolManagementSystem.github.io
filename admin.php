<?php
include_once("validate_user.php");
if(!isset($_SESSION['username'])){
	header('location:login.php');
}
	
?>
<!DOCTYPE HTML>
<html>
<head><title>ADMIN</title>
<meta name="viewport" content="width=device-width initial-scale=1">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.css" rel="stylesheet" type="text/css">
<link href="css/eportalstyle.css" rel="stylesheet" type="text/css">
<link href="css/sb-admin-2.css" rel="stylesheet" type="text/css">
  <link href="css/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
	<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/bootstrap.js"></script>
<style type='text/css'>
.footer{background:black;
color:white;
position:fixed;
bottom:0;
width:100%;}
.link{text-decoration:none;color:white}
a:hover{text-decoration:none;color:white}
#tel_num_txt_field{display:none}

</style>
</head>
<body>
<?php validateUser::heading2();?>
<div class="container">
<div class="rows">
<div class="col-xs-12 col-sm-12 col-md-lg col-lg-12">
<ol class="breadcrumb"> 
<li><a href="#"><i class="fa fa-home"></i>ADMIN</a></li> 
<li class="active">PROFILE USER</li> 
</ol>
<?php 
if(isset($_SESSION['user_success_msg'])){
	
	echo"<div class='alert alert-success'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h4 class='page-header'>SUCCESS</h4>
			<p>".$_SESSION['user_success_msg']."</p>
			</div>"; 
			unset($_SESSION['user_success_msg']);
}
 if(isset($_SESSION['user_error_msg'])){
	 echo "<div class='alert alert-danger'>
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true' href='#'> &times </button>
			<h4 class='page-header'><i class='fa fa-warning'></i> ERROR</h4>
			<p>Sorry the following errors occurred while trying to register new user. Kindly attend to these errors and try again!!!</p>";
	 foreach($_SESSION['user_error_msg'] as $_SESSION['error'])
	  { 
			
			echo"<p><i class='fa fa-warning'></i> ".$_SESSION['error']." .</p>";
			
			
	  }
	  unset($_SESSION['user_error_msg']);
	  echo"</div>";
 }
  if(isset($_SESSION['backup_msg'])){
	
	echo"<div class='alert alert-success'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h4 class='page-header'><i class='fa fa-check'></i> SUCCESS</h4>
			<p><i class='fa fa-arrow-right'></i> ".$_SESSION['backup_msg']."</p>
			</div>"; 
			unset($_SESSION['backup_msg']);
} 
?>
<h4 class="page-header text-primary"><i class="fa fa-user"></i>  User  Profile Registration</h4>
<form  class="form-horizontal" action="user_registration.php" method="POST">
<div class="form-group">
<label for="name" class="col-sm-3 control-label">Name *</label>
<div class="col-sm-7">
<input type="text" name="name" autocomplete="off"  placeholder="e.g Ahmmed Musa" class="form-control"/>
</div>
</div>
<div class="form-group">
<label for="role" class="col-sm-3 control-label">User Role *</label>
<div class="col-sm-7">
<select name="role" id='role' class="form-control"  onChange='getValue();'>
<option disabled selected> -- SELECT A ROLE -- </option>
<option value="teacher">Teacher</option>
<option>Parent</option>
<option>Student</option>
</select>
</div>
</div>
<div class="form-group">
<label for="lastname" class="col-sm-3 control-label">Email *</label>
<div class="col-sm-7">
<input type="text" name="email" autocomplete="off" placeholder="Email" class="form-control"/>
</div>
</div>
<div class="form-group" id="tel_num_txt_field">
<label for="lastname" class="col-sm-3 control-label">Telephone Number *</label>
<div class="col-sm-7">
<input type="text" name="tel_num" autocomplete="off" placeholder="Telephone Number" class="form-control"/>
</div>
</div>
<div class="form-group">
<label for="othername" class="col-sm-3 control-label">Default Password *</label>
<div class="col-sm-7">
<input type="password" name="default_password" autocomplete="off"  placeholder="default_password" class="form-control"/>
</div>
</div>
<label  class="col-sm-3 control-label">
<button type="submit" class="btn btn-md btn-primary"><i class='fa fa-user-plus'></i> Add User</button></label><br><br><br><br>
</div>
</form>
			 </div>

			 </div>
			 </div>
			 </div>
<div class="footer">
		<footer>
<p align="center"> <strong>&copy <?php echo date('Y');?>  School Management System </strong></p>
</footer>
</body>
</html>
<script type="text/javascript">

function getValue(){
	var selectId=document.getElementById('role');
	if(selectId.value=="Parent"){
		var formId=document.getElementById('tel_num_txt_field');
		formId.style.display="block";
	}
	else{
			var formId=document.getElementById('tel_num_txt_field');
			formId.style.display="none";
	}
};
</script>
</body>
</html>