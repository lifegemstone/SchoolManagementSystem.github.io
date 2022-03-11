<?php
//include_once("C:/wamp/dbconn_vbsms.php");
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
//include_once('functions.php');
if(isset($_GET['t_id'])){
	
	
	$teacher_id=$_GET['t_id'];
}

?>
<!DOCTYPE HTML>
<html>
<head><title>Id card generator</title>
<meta name="viewport" content="width=device-width initial-scale=1">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.css" rel="stylesheet" type="text/css">
<link href="css/sb-admin-2.css" rel="stylesheet" type="text/css">
  <link href="css/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
	<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="datatables/js/jquery.dataTables.min.js"></script>
    <script src="datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="datatables-responsive/dataTables.responsive.js"></script>
	  <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
<style type='text/css'>
.footer{background:black;color:white;position:fixed;bottom:0;margin:0px;width:100%;}
.link{text-decoration:none;color:white}
a:hover{text-decoration:none;color:white}

</style>
</head>
<body>
<?php validateUser::heading2()?>
			 <ol class="breadcrumb"> 
<li><a href="#"><i class="fa fa-home"></i>Vinebranch School Management System</a></li> 
<li class="active">Id Card Generator</li> 
</ol>
<div class="container">
<div class="rows">
<div class="col-sm-4 col-md-4 col-lg-4">
 <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class=""></i>
              </div>
			   <?PHP echo'<div class="mr-5" style="font-size:1.5em;"><p style="padding:17px"><a href="teacherfront_page.php?t_id='.$teacher_id.'&usrcd='.$usrcd.'" class="link"><i class="fa  fa-credit-card"></i> FRONT OF ID CARD</a></p></div>';
            
			?></div>
			  </div>
			 </div>
<div class="col-sm-4 col-md-4 col-lg-4">
 <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class=""></i>
              </div>
			<?php   echo'<div class="mr-5" style="font-size:1.5em;"><p style="padding:17px"><a href="teacherback_page.php?t_id='.$teacher_id.'&usrcd='.$usrcd.'" class="link"><i class="fa fa-credit-card"></i> BACK OF ID CARD</a></p></div>';?>
            </div>
			  </div>
			 </div>
			
</div>
</div>			
	
		<div class="footer">
		<footer>
<p align="center"> <strong>&copy <?php echo date('Y');?>  Vinebranch School Management System </strong></p>
</footer>
</body>
</html>