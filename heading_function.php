<?php
function heading(){
	echo'
<!DOCTYPE HTML>
<html>
<head><title>e-port::Tutors Home</title>
<meta name="viewport" content="width=device-width initial-scale=1">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.css" rel="stylesheet" type="text/css">
<link href="css/eportalstyle.css" rel="stylesheet" type="text/css">
<link href="css/sb-admin-2.css" rel="stylesheet" type="text/css">
  <link href="css/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
	<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/bootstrap.js"></script>

	<script type="text/javascript">
$(document).ready(function(){
$("#option_form").submit(function(e){
var form=$(this);
var url=form.attr("action");
var type=form.attr("method");
var formdata=form.serialize();
e.preventDefault();
	console.log(formdata);
$.ajax({
	
	type:type,
	url:url,
	data:formdata,
	cache:false,
	contentType:false,
	
})
.done(function(data){
	
	$("#options").html(data);
	
});
});
		
});
</script>
</head>
<body>
<div class="header-one">
	<div class="container">
		<div class="rows">
			<div class="col-sm-12 col-md-12 col-lg-12">
			
				<div class="rows">
				<div class="col-sm-3 col-md-3 col-lg-3">
				<h4 class="text-primary">E-portal</h4>
				<em >Education at its best!!</em>
				</div>
				<div class="col-sm-5 col-md-5 col-lg-5">
				
				<i class="fa fa-map-marker" style="color:blue;padding-top:12px"></i> Address: Bodija,alubarika plaza,Ibadan,Oyo State.<br>
				<i class="fa fa-envelope" style="color:blue"></i> Email:e-portalmail@yahoo.com</div>
				<div class="col-sm-4 col-md-4 col-lg-4">
				<i class="fa fa-phone" style="color:blue;padding-top:12px"></i> Tel:+2348027595286
				
				</div>
				</div>
				</div>

			</div>
	</div>
</div>
<nav class="navbar navbar-inverse" role="navigation">
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse">
<span class="icon-bar"></span> 
<span class="icon-bar"></span> 
<span class="icon-bar"></span> 
</button>
</div>
<div class="collapse navbar-collapse" id="example-navbar-collapse">
<ul class="nav navbar-nav">
<li class="active"><a href="tutors_home.php"><i class="fa fa-dashboard"></i>HMO</a></li>
<li class="dropdown"> 
	<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-tasks"></i> My Tasks <b class="caret"></b> </a> 
	<ul class="dropdown-menu"> 
		<li><a href="create_class.php"><i class="fa fa-edit"></i> Create Class</a></li> 
		<li class="divider"></li>
		<li><a href="add_student.php"><i class="fa fa-plus"></i> Add Student to Class</a></li>
		<li class="divider"></li>		
		<li><a href="tutor_view_classes.php"><i class="fa fa-eye"></i> View Your Classes</a></li>
		<li class="divider"></li>
		<li><a href="#"><i class="fa fa-eye"></i> View Your Students</a></li>
		<li class="divider"></li>
		<li><a href="#"><i class="fa fa-calendar"></i> Schedule Task</a></li>
	</ul> 
	<li class="dropdown">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-tasks"></i> Evaluation <b class="caret"></b></a>
	<ul class="dropdown-menu">
	<li><a href="create_assignments.php"><i class="fa fa-edit"></i> Create Quiz/Assignment</a></li> 
		<li class="divider"></li>
		<li><a href="#"><i class="fa fa-plus"></i> View submitted Quiz</a></li>
		<li class="divider"></li>		
		<li><a href="#"><i class="fa fa-eye"></i> View All Quiz</a></li>
	</ul>
	</li>
	<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-folder"></i> Content Library <b class="caret"></b></a>
	<ul class="dropdown-menu">
	<li><a href="#"><i class="fa fa-play"></i> upload videos</a></li> 
		<li class="divider"></li>
		<li><a href="#"><i class="fa fa-upload"></i> Upload pdf files</a></li>
		<li class="divider"></li>
		<li><a href="#"><i class="fa fa-eye"></i> View files </a></li>
	</ul>
	</li>
	<li><a href="#"><i class="fa fa-bullhorn"></i> Send Broadcast </a></li>
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> Settings <b class="caret"></b></a>
		<ul class="dropdown-menu">
		<li><a href="#"><i class="fa fa-image"></i> Upload profile picture</a></li>
		<li class="divider"></li>
		<li><a href="#"><i class="fa fa-unlock"></i> Change your password</a></li>
		<li class="divider"></li>
		<li><a href="#"><i class="fa fa-user"></i> My Profile</a></li>	
			<li class="divider"></li>
		<li><a href="#"><i class="fa fa-database"></i> Backup Options</a></li>	
		</ul>
		</li>
	<li><a href="#"><i class="fa fa-power-off"></i> Logout</a></li>
</li>
</ul>
</div>
</nav>';
}

function footer(){
	
	echo'</div></div></div><div class="footer">
		<footer>
<p align="center"> &copy '.date("Y").' e-portal 
</footer>
			</div>

</body>
</html>';
	
	
	
	
}




?>