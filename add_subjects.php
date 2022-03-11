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
<head><title>Create Subjects</title>
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
position:fixed;
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
<?php validateUser::heading2();?>
<div class="container">
<div class="rows">
<div class="col-xs-12 col-sm-12 col-md-lg col-lg-12">
<ol class="breadcrumb"> 
<li><a href="#"><i class="fa fa-home"></i>ADMIN</a></li> 
<li class=""><i class='fa fa-users'></i> DASHBOARD</li> 
<li class="active">ASSIGN SUBJECTS TO TEACHER</li> 
</ol>
<?php if(isset($_SESSION['subject_success'])){
	
	echo"<div class='alert alert-success'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h4 class='page-header'>SUCCESS</h4>
	The following subject/subjects Where added successfully:";
	foreach($_SESSION['subject_success'] as $subject){
		echo"
			<p><i class='fa fa-check'></i> $subject</p>";
	}
			echo"</div>"; 
			unset($_SESSION['subject_success']);
}

 if(isset($_SESSION['subject_error'])){
	 echo "<div class='alert alert-danger'>
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true' href='#'> &times </button>
			<h4 class='page-header'><i class='fa fa-warning'></i> ERROR</h4>
			<p>Sorry the following subject/subjects could not be added.Subject/Subjects name already exists, change the Subject/Subjects Name and try again..</p>";
	 foreach($_SESSION['subject_error'] as $error)
	  { 
			
			echo"<p>* $error</p>";
			
			
	  }
	
	  echo"</div>";
	    unset($_SESSION['subject_error']);
 }
  if(isset($_SESSION['subjects_error_msg'])){
	 echo "<div class='alert alert-danger'>
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true' href='#'> &times </button>
			<h4 class='page-header'><i class='fa fa-warning'></i> ERROR</h4>
			<p>Sorry the following errors occurred while trying to Create Subjects. Kindly attend to these errors and try again!!!</p>";
	 foreach($_SESSION['subjects_error_msg'] as $error)
	  { 
			
			echo"<p><i class='fa fa-warning'></i> $error</p>";
			
			
	  }
	
	  echo"</div>";
	    unset($_SESSION['subjects_error_msg']);
 }
?>
<h4 class="page-header text-primary"><i class="fa fa-plus-circle"></i> Create Subjects</h4>
<form  class="form-horizontal" action="do_create_subjects.php" enctype='multipart/form-data' method="POST">
<div class="form-group">
<label for="class" class="col-sm-3 control-label">Class:</label>
<div class='col-sm-12 col-md-6 col-lg-6'>
<select class="form-control" name="class_name">
<option value="">--SELECT A CLASS--</option>
<?php
$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
$select="SELECT * FROM school_classes ORDER BY class_name";
$query=$conn->query($select);
while($fetch_results=$query->fetch_array(MYSQLI_ASSOC)){
	echo"<option>{$fetch_results['class_name']}</option>";
}

?>
</select>
</div>
</div>
<div class="form-group">
<label for="subject" class="col-sm-3 control-label">Subject 1: </label>
<div class="col-sm-4">
<input type="text" name="subject[]"  autocomplete="off"  placeholder="Subject Name" class="form-control"/>
</div>
<div class="col-sm-4">
</div>
</div>
<div class="form-group">
<label for="subject" class="col-sm-3 control-label">Subject 2: </label>
<div class="col-sm-4">
<input type="text" name="subject[]"  autocomplete="off"  placeholder="Subject Name" class="form-control"/>
</div>
<div class="col-sm-4">

</div>
</div>
<div class="form-group">
<label for="subject" class="col-sm-3 control-label">Subject 3: </label>
<div class="col-sm-4">
<input type="text" name="subject[]"  autocomplete="off"  placeholder="Subject Name" class="form-control"/>
</div>
<div class="col-sm-4">
</div>
</div>
<div class="form-group">
<label for="subject" class="col-sm-3 control-label">Subject 4: </label>
<div class="col-sm-4">
<input type="text" name="subject[]"  autocomplete="off"  placeholder="Subject Name" class="form-control"/>
</div>
<div class="col-sm-4">
</div>
</div>
<div class="form-group">
<label for="subject" class="col-sm-3 control-label">Subject 5: </label>
<div class="col-sm-4">
<input type="text" name="subject[]"  autocomplete="off"  placeholder="Subject Name" class="form-control"/>
</div>
<div class="col-sm-4">
</div>
</div>
<!-- hide div-->
<div id="hide">
<div class="form-group">
<label for="subject" class="col-sm-3 control-label">Subject 6: </label>
<div class="col-sm-4">
<input type="text" name="subject[]"  autocomplete="off"  placeholder="Subject Name" class="form-control"/>
</div>
<div class="col-sm-4">
</div>
</div>
<div class="form-group">
<label for="subject" class="col-sm-3 control-label">Subject 7: </label>
<div class="col-sm-4">
<input type="text" name="subject[]"  autocomplete="off"  placeholder="Subject Name" class="form-control"/>
</div>
<div class="col-sm-4">

</div>
</div>
<div class="form-group">
<label for="subject" class="col-sm-3 control-label">Subject 8: </label>
<div class="col-sm-4">
<input type="text" name="subject[]"  autocomplete="off"  placeholder="Subject Name" class="form-control"/>
</div>
<div class="col-sm-4">
</div>
</div>
</div><!--end of div hide-->
<button type="button" class='btn btn-primary btn-sm col-sm-offset-5' id='add_more'><i class='fa fa-plus-circle'></i> Add More Subjects</button>
<button type="button" class='btn btn-primary btn-sm col-sm-offset-5' id='show_less'><i class='fa fa-eye'></i> Show Less</button>
<div class="form-group">
<br>
<label  class="col-sm-3 control-label">
<input type="hidden" name="usrcd" value='<?php echo "$usrcd";?>' />
<button type="submit" class="btn btn-md btn-primary"><i class='fa fa-plus-circle'></i> ADD SUBJECTS</button></label><br><br><br><br>
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