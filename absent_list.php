<?php 

include_once("validate_user.php");
 //include_once('functions.php');

?>
<!DOCTYPE HTML>
<html>
<head><title>Attendance Absent List</title>
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
</style>
<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/bootstrap.js"></script>
<script  src="dist/js/bootstrap-datepicker.js"></script>
<script src="datatables/js/jquery.dataTables.min.js"></script>
<script src="datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="datatables-responsive/dataTables.responsive.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#custom_form').submit(function(e){
		e.preventDefault();
		var url=$(this).attr('action');
		var type=$(this).attr('method');
		var formdata=$(this).serialize();
		console.log(formdata);
		$.ajax({
			type:type,
			url:url,
			data:formdata,
			cache:false,
			contentType:false,
		})
		.done(function(data){
			
		$('#div_table').html(data);	
			
			
			
			
		});	
	
	
	});
})
</script>
</head>
<body>
<?php  validateUser::heading();
//heading();?>
<div class="container">
<div class="rows">
<div class="col-xs-12 col-sm-12 col-md-lg col-lg-12">
<ol class="breadcrumb"> 
<li><a href="#"><i class="fa fa-home"></i>ADMIN</a></li> 
<li class=""><i class='fa fa-graduation-cap'></i> DASHBOARD</li> 
<li class="active">ATTENDANCE ABSENT LIST</li> 
</ol>
<?php if(isset($_SESSION['stud_success_msg'])){
	
	echo"<div class='alert alert-success'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h4 class='page-header'>SUCCESS</h4>
			<p>".$_SESSION['stud_success_msg']."</p>
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
 if(isset($_SESSION['username'])){
		$username=$_SESSION['username'];
		$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
		if($conn->connect_error)
			die('could not connect to the database');
		else{
				$select="SELECT email From users WHERE name='$username'";
				$query=$conn->query($select);
				$results=$query->fetch_array(MYSQLI_ASSOC);
				$email=$results['email'];
				$select1="SELECT teacher_id From teachers WHERE email='$email'";
				$query1=$conn->query($select1);
				$results1=$query1->fetch_array(MYSQLI_ASSOC);
				$teacher_id=$results1['teacher_id'];
		}
}
?>
<h4 class="page-header text-primary"><i class="fa fa-calendar"></i>Custom Filter</h4>
<form  class="form-horizontal" action="do_absent_list.php" id="custom_form"  method="GET">
<div class="form-group">
<label for="class_name" class="col-sm-2 control-label">Select a Class *</label>
<div class="col-sm-6">
<select name="class_name"   class="form-control" >
<option selected>--SELECT--</option>
<?php
$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
if($conn->connect_error){
	die('could not connect to the database');
}
else{
		$classes=array();
		$select="SELECT class_name FROM assign_subjects WHERE teacher_id='$teacher_id'";
		$query=$conn->query($select);
		while($results=$query->fetch_array(MYSQLI_ASSOC)){
			$classes[]=$results['class_name'];
		}

}
	$classes=array_unique($classes);
	foreach($classes as $class){
		echo"<option>$class</option>";
	}
	?>
	</select>
	</div>
	</div>
<div class="form-group">
<label for="start_date" class="col-sm-3 control-label"><i class="fa fa-calendar"></i> Start Date* </label>
<div class="col-sm-5">
<input type="text" name="start_date"  required class="datepicker" autocomplete="off" placeholder="Start Date" class="form-control calendar"/>
</div>
</div>
<div class="form-group">
<label for="end_date" class="col-sm-3 control-label"><i class="fa fa-calendar"></i> End Date* </label>
<div class="col-sm-5">
<input type="text" name="end_date"  required class="datepicker" autocomplete="off" placeholder="End Date" class="form-control calendar"/>
</div>
</div>
<label  class="col-sm-3 control-label">
<button type="submit" class="btn btn-md btn-primary"><i class='fa fa-filter'></i>Custom Filter</button></label><br><br><br><br>
</div>
</form>
			
<div id="div_table">
</div>

			</div>
			 </div>
			 </div>
<br><br><br>
<div class="footer">
		<footer>
<p align="center"> <strong>&copy <?php echo date('Y');?>  Vinebranch School Management System </strong></p>
</footer>

<script type="text/javascript">
$(".datepicker").datepicker();
</script>
</body>
</html>
</body>
</html>