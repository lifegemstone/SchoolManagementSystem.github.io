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
<li class="breadcrumb-item"><a href="#"><i class="fa fa-user"></i> Admin</a></li> 
<li class=" breadcrumb-item active"><i class='fa fa-dashboard'></i> DASHBOARD</li> 
</ol>
<div class="row">
<div class="col-sm-4 col-md-4 col-lg-4">
 <div class="card">
            <div class="card-body  aqua-gradient">
          <?php echo"<p class='card-text'><a href='registration.php?usrcd=$usrcd' class='white-text' ><i class='fa  fa-user-plus'></i> Register Students</a></p>";?>
		   </div>
            </div>
			<br>
			  </div>
			  
			  <div class="col-sm-4 col-md-4 col-lg-4">
 <div class="card">
            <div class="card-body peach-gradient">
          <?php echo"<p class='card-text'><a href='teachers_registration.php?usrcd=$usrcd' class='white-text' ><i class='fa  fa-user-plus'></i> Profile Teachers</a></p>";?>
		   </div>
            </div>
			<br>
			  </div>
<div class="col-sm-4 col-md-4 col-lg-4">
	<div class="card">
            <div class="card-body  aqua-gradient">
          <?php echo"<p class='card-text'><a href='add_subjects.php?usrcd=$usrcd' class='white-text' ><i class='fa  fa-plus-circle'></i> Add Subjects</a></p>";?>
		   </div>
            </div>
			<br>
			  </div> 
	 <div class="col-sm-4 col-md-4 col-lg-4">
 <div class="card">
            <div class="card-body  peach-gradient">
          <?php echo"<p class='card-text'><a href='all_subjects.php?usrcd=$usrcd' class='white-text' ><i class='fa  fa-list'></i> All  Subjects</a></p>";?>
		   </div>
            </div>
			<br>
			  </div>
		<div class="col-sm-4 col-md-4 col-lg-4">
	<div class="card">
            <div class="card-body  aqua-gradient">
          <?php echo"<p class='card-text'><a href='student_statistics.php?usrcd=$usrcd' class='white-text' ><i class='fa  fa-graduation-cap'></i>";
			   $conn=mysqli_connect(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME)or die('could not connect to the database'.mysqli_connect_error());
			   $select="SELECT COUNT(student_id) as id FROM students";
			   $query=mysqli_query($conn,$select);
			   $results=mysqli_fetch_array($query,MYSQLI_ASSOC);
			  echo "(<span style='color:white'>".$results['id']."</span>) ";
			  echo"Students Statistics</a></p>";
			  ?>
		   </div>
            </div>
			<br>
			  </div> 
	<div class="col-sm-4 col-md-4 col-lg-4">
	<div class="card">
            <div class="card-body  peach-gradient">
          <?php echo"<p class='card-text'><a href='teachers_statistics.php?usrcd=$usrcd' class='white-text' ><i class='fa  fa-users'></i>";
			   $conn=mysqli_connect(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME)or die('could not connect to the database'.mysqli_connect_error());
			   $select="SELECT COUNT(teacher_id) as id FROM teachers";
			   $query=mysqli_query($conn,$select);
			   $results=mysqli_fetch_array($query,MYSQLI_ASSOC);
			  echo "(<span style='color:white'>".$results['id']."</span>) ";
			  echo"Teachers Statistics</a></p>";
			  ?>
		   </div>
            </div>
			<br>
			  </div> 
	 <div class="col-sm-4 col-md-4 col-lg-4">
	<div class="card">
            <div class="card-body  aqua-gradient">
          <?php echo"<p class='card-text'><a href='create_class.php?usrcd=$usrcd' class='white-text' ><i class='fa  fa-building'></i> Create a Class </a></p>";?>
		   </div>
            </div>
			<br>
			  </div>
 <div class="col-sm-4 col-md-4 col-lg-4">
	<div class="card">
            <div class="card-body  peach-gradient">
            <?php echo"<p class='card-text'><a href='view_classes.php?usrcd=$usrcd' class='white-text' ><i class='fa  fa-eye-open'></i>";
			   $conn=mysqli_connect(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME)or die('could not connect to the database'.mysqli_connect_error());
			   $select="SELECT COUNT(class_id) as id FROM school_classes";
			   $query=mysqli_query($conn,$select);
			   $results=mysqli_fetch_array($query,MYSQLI_ASSOC);
			  echo "(<span style='color:white'>".$results['id']."</span>) ";
			  echo"View Classes</a></p>";
			  ?>
			</div>
            </div>
			<br>
			  </div>
			   <div class="col-sm-4 col-md-4 col-lg-4">
	<div class="card">
            <div class="card-body  aqua-gradient">
          <?php echo"<p class='card-text'><a href='generate_reports.php?usrcd=$usrcd' class='white-text' ><i class='fa  fa-table'></i> Generate Reports </a></p>";?>
		   </div>
            </div>
			<br>
			  </div>
<!--<div class="col-sm-4 col-md-4 col-lg-4">
 <div class="card">
            <div class="card-body  peach-gradient">
          <?php //echo"<p class='card-text'><a href='viewAllTransactions.php?usrcd=$usrcd' class='white-text' ><i class='fa  fa-credit-card'></i> Transactions </a></p>";?>
		   </div>
            </div>
			<br>
			  </div>-->
			  
<!--<div class="col-sm-4 col-md-4 col-lg-4">
 <div class="card">
            <div class="card-body  peach-gradient">
          <?php //echo"<p class='card-text'><a href='#' class='white-text' ><i class='fa  fa-credit-card'></i> </a></p>";?>
		   </div>
            </div>
			<br>
			  </div>-->
			  
			  
	</div>
	</div>
<div class="footer">
		<footer>
<p align="center"> <strong>&copy <?php echo date('Y');?> Vinebranch School Management System </strong></p>
</footer>
</body>
</html>
</body>
</html>