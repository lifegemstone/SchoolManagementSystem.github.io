<?php 
//include_once('C:/wamp/dbconn_vbsms.php');
include_once("validate_user.php");
//include_once('functions.php');
?>
<!DOCTYPE HTML>
<html>
<head><title>Generic:: Reports</title>
<meta name="viewport" content="width=device-width initial-scale=1">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.css" rel="stylesheet" type="text/css">
<link href="css/eportalstyle.css" rel="stylesheet" type="text/css">
<link href="css/sb-admin-2.css" rel="stylesheet" type="text/css">
  <link href="css/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
<style type='text/css'>
.footer{background:black;
color:white;
position:fixed;
bottom:0px;
width:100%;}
.link{text-decoration:none;color:white}
a:hover{text-decoration:none;color:black}
body{position:relative;}
.center{text-align:center}
</style>
</head>
<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="datatables/js/jquery.dataTables.min.js"></script>
<script src="datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="datatables-responsive/dataTables.responsive.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
		
	$('#class_form').submit(function(e){
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
<body>
<?php  validateUser::heading2();?>
<div class="container">
<div class="rows">
<div class="col-xs-12 col-sm-12 col-md-lg col-lg-12">
<ol class="breadcrumb"> 
<li><a href="#"><i class="fa fa-home"></i>ADMIN</a></li> 
<li class=""><i class='fa fa-dashboard'></i> DASHBOARD</li> 
<li class="active">GENERIC::REPORTS</li>  
</ol>
<h4 class="page-header text-primary"><i class="fa fa-edit"></i>GENERIC::REPORTS</h4>
<form  class="form-vertical" id='class_form' action="studentList_class.php" method="GET">
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
		$select="SELECT class_name FROM school_classes ORDER BY class_name";
		$query=$conn->query($select);
		while($results=$query->fetch_array(MYSQLI_ASSOC)){
			$classes[]=$results['class_name'];
		}

}
	
	foreach($classes as $class){
		echo"<option>$class</option>";
	}
	?>
	</select>
	</div>
	</div>
<label  class="col-sm-3 control-label">
	<input type="hidden"  name="teacher_id" value=''>
<button type="submit" class="btn btn-md btn-primary"><i class="fa fa-arrow-right-circle"></i>Fetch Students</button></label><br><br><br><br>
</form>
<div id='div_table'>
</div>
		<br>	 
			</div>
			 </div>
			 </div>
<div class="footer">
		<footer>
<p align="center"> <strong>&copy  <?php echo''.date("Y").'';?> Vinebranch School Management System </strong></p>
</footer>

</body>
</html>
</body>
</html>