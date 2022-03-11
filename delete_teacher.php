<?php
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
if(isset($_GET["t_id"])){
	$teacher_id=$_GET["t_id"];
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
.main-div{margin:auto;text-align:center;}
.inner-div{display:inline-block}
</style>
</head>
<body>
<?php validateUser::heading2();?>
<div class="container">
<div class="rows">
<div class="col-xs-12 col-sm-12 col-md-lg col-lg-12">
<ol class="breadcrumb"> 
<li><a href="#"><i class="fa fa-home"></i>Vinebranch School Management System</a></li> 
<li class="active"><i class='fa fa-trash'></i> Delete Teacher</li> 
</ol>
<div class='main-div'>
 <div class='inner-div'>
 <form action="do_delete_teacher.php" method="POST" style="background:lightgrey;box-shadow:3px 4px 4px black">
 <h4 class='page-header' style="padding: 2px 2px 2px 2px"><i class='fa fa-warning' style="color:red;padding 2px 2px 2px 2px"></i> Are You Sure you want to Delete this Teacher</h4>
 <input type="hidden" name="teacher_id" value='<?php echo $teacher_id;?>' />
  <input type="hidden" name="usrcd" value='<?php echo $usrcd;?>' />
 <button type='submit' name='submit' class='btn btn-xs btn-primary'><i class='fa fa-trash'></i> Delete</button> <button type='button' class='btn btn-xs btn-danger'><?php echo"<a href='teachers_statistics.php?usrcd=$usrcd' style='color:white;'>Cancel</a>";?></button>
 <br><br>
 </form>
 </div>
		</div>
			 </div>
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