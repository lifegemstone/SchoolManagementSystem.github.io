<?php
//include('C:/wamp/dbconn_vbsms.php');
include_once('validate_user.php');
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
<head><title>ADMIN</title>
<meta name="viewport" content="width=device-width initial-scale=1">
<link href="MDB-Free_4.7.1/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.css" rel="stylesheet" type="text/css">
<link href="MDB-Free_4.7.1/css/mdb.min.css" rel="stylesheet" type="text/css">
<link href="MDB-Free_4.7.1/css/style.css" rel="stylesheet" type="text/css">
<link href="css/eportalstyle.css" rel="stylesheet" type="text/css">
<link href="css/sb-admin-2.css" rel="stylesheet" type="text/css">
  <link href="css/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
	<script type="text/javascript" src="MDB-Free_4.7.1/js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="MDB-Free_4.7.1/js/popper.min.js"></script>
	<script type="text/javascript" src="MDB-Free_4.7.1/js/bootstrap.js"></script>
	<script type="text/javascript" src="MDB-Free_4.7.1/js/mdb.min.js"></script>
<style type='text/css'>
.footer{background:black;
color:white;
position:fixed;
bottom:0;
width:100%;}
.link{text-decoration:none;color:white}
a:hover{text-decoration:none;color:white}

</style>
</head>
<body>
<?php validateUser::heading3();?>
<br>
<div class="container">
<ol class="breadcrumb"> 
<li class="breadcrumb-item"><a href="#"><i class="fa fa-user"></i> ADMIN</a></li> 
<li class=" breadcrumb-item"><i class='fa fa-dashboard'></i> DASHBOARD</li> 
<li class=" breadcrumb-item active"><i class='fa fa-building'></i> ADD CLASS/CLASSES</li> 
</ol>
<?php

if(isset($_SESSION['class_error'])){
	
	echo"<div class='alert alert-danger'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h5 style='border-bottom:1px solid #eee;line-height:180%'><i class='fa fa-bell'></i> ERROR</h5>
			<p>".$_SESSION['class_error']."</p>
			</div>"; 
			unset($_SESSION['class_error']);
}
if(isset($_SESSION['class_insert_success'])){
	
	echo"<div class='alert alert-success'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h5 style='border-bottom:1px solid #eee;line-height:180%'><i class='fa fa-check'></i> SUCCESS</h5>
			<p>".$_SESSION['class_insert_success']."</p>";
			if(isset($_SESSION['list_classes'])){
					foreach($_SESSION['list_classes'] as $class_list){
				echo"
					<p><i class='fa fa-check'></i> ".$class_list." was successfully added.</p>";
			}
			unset($_SESSION['list_classes']);
	}
			echo"</div>"; 
			unset($_SESSION['class_insert_success']);
}
if(isset($_SESSION['class_duplication_error'])){
	echo"<div class='alert alert-danger'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h5 style='border-bottom:1px solid #eee;line-height:180%'><i class='fa fa-bell'></i> ERROR</h5>
			<p>".$_SESSION['class_duplication_error']."</p>";
			if(isset($_SESSION['error_classes'])){
					foreach($_SESSION['error_classes'] as $error_class){
								echo"
									<p><i class=''></i><strong>*</strong> ".$error_class."</p>";
					}
			
			unset($_SESSION['error_classes']);
	}
	echo"</div>";
			if(isset($_SESSION['list_classes'])){
				echo"<div class='alert alert-success'> 
				 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
				<h5 style='border-bottom:1px solid #eee;line-height:180%'><i class='fa fa-check'></i>SUCCESS</h5>";
					foreach($_SESSION['list_classes'] as $class_list){
				echo"
					<p><i class='fa fa-check'></i> ".$class_list." was successfully added.</p>";
			}
			echo"</div>";
			unset($_SESSION['list_classes']);
	}
			unset($_SESSION['class_duplication_error']);
}
/*if(isset($_SESSION['list_classes'])){
	
	echo"<div class='alert alert-danger'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h5 style='border-bottom:1px solid #eee;line-height:180%'><i class='fa fa-bell'></i> ERROR</h5>";
	foreach($_SESSION['list_classes'] as $class_list){
		echo"
			<p>".$class_list." was successfully added.</p>";
	}
			echo"</div>"; 
			unset($_SESSION['list_classes']);
}*/
if(isset($_SESSION['class_insert_error'])){
	
	echo"<div class='alert alert-danger'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h5 style='border-bottom:1px solid #eee;line-height:180%'><i class='fa fa-bell'></i> ERROR</h5>
			<p>".$_SESSION['class_insert_error']."</p>
			</div>"; 
			unset($_SESSION['class_insert_error']);
}
?>
<h5 style='border-bottom:1px solid #eee;line-height:180%' class='text-danger'><i class='fa fa-plus-circle'></i> ADD CLASS/CLASSES</h5>
<form action="do_create_class.php" method="POST">
<?php
for($i=1;$i<7;$i++){
	echo'<div class="form-group">
<label for="class_name" class="col-md-3 control-label"><strong>CLASSNAME '.$i.':</strong></label>
<div class="col-sm-12 col-md-7 col-lg-7">
<input type="text" name="class_name[]" placeholder="ENTER CLASSNAME '.$i.'"  class="form-control"/>
</div>
</div>';
}
echo"<input type='hidden' name='usrcd' value='$usrcd' />";
?>
<button class="btn btn-sm aqua-gradient" type="submit">Create Class/Classes</button></br></br></br>
</form>
	</div>
<div class="footer">
		<footer>
<p align="center"> <strong>&copy <?php echo date('Y');?> Vinebranch School Management System </strong></p>
</footer>
</body>
</html>
</body>
</html>