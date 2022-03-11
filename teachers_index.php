<?php

include_once("validate_user.php");
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
<head><title>SMS</title>
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
<?php 
	validateUser::heading4();
?>
<br>
<div class="container">
<ol class="breadcrumb"> 
<li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> TEACHER <?php echo validateUser::getRole();?></a></li> 
<li class="active breadcrumb-item"><i class='fa fa-dashboard'></i> DASHBOARD</li> 
</ol>
<div class="row">

<div class="col-sm-4 col-md-4 col-lg-4">
 <div class="card">
            <div class="card-body  aqua-gradient">
          <?php echo"<p class='card-text'><a href='list_students.php' class='white-text' ><i class='fa  fa-users'></i> View Students</a></p>";?>
		   </div>
            </div>
			<br>
			  </div>
<div class="col-sm-4 col-md-4 col-lg-4">
 <div class="card">
            <div class="card-body  purple-gradient">
          <?php echo"<p class='card-text'><a href='daily_attendance.php' class='white-text' ><i class='fa  fa-calendar'></i> Daily Attendance</a></p>";?>
		   </div>
            </div>
			<br>
			  </div>
			  
			  <div class="col-sm-4 col-md-4 col-lg-4">
 <div class="card">
            <div class="card-body aqua-gradient">
          <?php echo"<p class='card-text'><a href='create_reportcard.php' class='white-text' ><i class='fa  fa-edit'></i> Create Report Card</a></p>";?>
		   </div>
            </div>
			<br>
			  </div>
<div class="col-sm-4 col-md-4 col-lg-4">
	<div class="card">
            <div class="card-body  purple-gradient">
          <?php echo"<p class='card-text'><a href='view_timeTable.php' class='white-text' ><i class='fa  fa-user'></i> Personal Profile</a></p>";?>
		   </div>
            </div>
			<br>
			  </div> 
<!--<div class="col-sm-4 col-md-4 col-lg-4">
	<div class="card">
            <div class="card-body  aqua-gradient">
          <?php //echo"<p class='card-text'><a href='assignments.php' class='white-text' ><i class='fa  fa-book'></i> Assignments</a></p>";?>
		   </div>
            </div>
			<br>
			  </div> -->

			 </div>
		</div><br><br>
<div class="footer">
		<footer>
<p align="center"> <strong>&copy <?php echo date('Y');?> Vinebranch School Management System </strong></p>
</footer>
</body>
</html>
</body>
</html>