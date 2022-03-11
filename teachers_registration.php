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
<head><title>Teachers Registration</title>
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
#hide{display:none}
#show_less{display:none}
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
<li class="active">TEACHERS REGISTRATION</li> 
</ol>
<?php if(isset($_SESSION['success_msg'])){
	
	echo"<div class='alert alert-success'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h4 class='page-header'>SUCCESS</h4>
			<p>".$_SESSION['success_msg']."</p>
			</div>"; 
			unset($_SESSION['success_msg']);
}
 if(isset($_SESSION['error_msg'])){
	 echo "<div class='alert alert-danger'>
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true' href='#'> &times </button>
			<h4 class='page-header'><i class='fa fa-warning'></i> ERROR</h4>
			<p>Sorry the following errors occurred while trying to Add Teacher to the database. Kindly attend to these errors and try again!!!</p>";
	 foreach($_SESSION['error_msg'] as $_SESSION['error'])
	  { 
			
			echo"<p><i class='fa fa-warning'></i> ".$_SESSION['error']." .</p>";
			
			
	  }
	
	  echo"</div>";
	    unset($_SESSION['error_msg']);
 }
?>
<h4 class="page-header text-primary"><i class="fa fa-user"></i> Teachers Registration</h4>
<form  class="form-horizontal" action="do_teachers_registration.php" enctype='multipart/form-data' method="POST">
<div class="form-group">
<label for="surname" class="col-sm-3 control-label">Teacher Name *</label>
<div class="col-sm-7">
<input type="text" name="teacher_name" autocomplete="off"  placeholder="Teacher Name" class="form-control"/>
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
<label for="address" class="col-sm-3 control-label"><i class='fa fa-map-marker'></i> Home Address *</label>
<div class="col-sm-7">
<input type="text" name="home_address" autocomplete="off"  placeholder="Address" class="form-control"/>
</div>
</div>
<div class="form-group">
<label for="telephone" class="col-sm-3 control-label"><i class='fa fa-phone'></i> Telepone Number *</label>
<div class="col-sm-5">
<input type="text" name="telephone" autocomplete="off" placeholder="Telephone Number" class="form-control"/>
</div>
</div>
<div class="form-group">
<label for="email" class="col-sm-3 control-label"><i class='fa fa-envelope'></i> E-mail Address *</label>
<div class="col-sm-5">
<input type="text" name="email" autocomplete="off" placeholder="E-mail Address" class="form-control"/>
</div>
</div>
<input type="hidden" name="usrcd" value='<?php echo"$usrcd";?>' />
<h5 class='page-header text-danger'><i class='fa fa-image'></i> Upload Image</h5>
<div class="form-group">
<label for="image" class="col-sm-3 control-label">Upload Picture *</label>
<input type="file" name="img"/><br>
<label  class="col-sm-3 control-label">
<button type="submit" class="btn btn-md btn-primary"><i class='fa fa-user-plus'></i> ADD Teacher</button></label><br><br><br><br>
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
<script type='text/javascript'>
$(document).ready(function(){
	
	$('#add_more').click(function(){
		$('#hide').show();
		$('#show_less').show();
		$(this).hide();
		
	});
	
	$('#show_less').click(function(){
		$('#hide').hide();
		$('#add_more').show();
		$(this).hide();
		
	});
})
</script>
</body>
</html>
</body>
</html>