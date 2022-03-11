<?php
//include('C:/wamp/dbconn_vbsms.php');
include_once('validate_user.php');
/*if(isset($_GET['usrcd'])){
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
	$conn=new mysqli("localhost","root","","vbsms");
	$select="SELECT user_token FROM users WHERE name='".$username."'";
	$query=$conn->query($select);
	$results=$query->fetch_array(MYSQLI_ASSOC);
	$user_token=$results['user_token'];
		if($usrcd != $user_token){
			validateUser::logout();
			
			
		}
	
*/

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
#settings:hover{color:black}
#form2{display:none}
</style>
<script type="text/javascript">
$(document).ready(function(){
	$("#settings").click(function(e){
		e.preventDefault();
		$(".custom-switch").hide();
		$("#form2").show();
	
		
	});
		
		
	$("#customSwitch1").click(function(){
		
		if($(this).prop("checked")){
				var method=$("#form").attr('method');
				var action=$("#form").attr("action");
			$.ajax({
				type:method,
				url:action,
				data:{check:"checked"},
				success:function(data){
					alert(data);
				}
				
				});
			$("#settings").hide();
		}
		else{
			
				var method=$("#form").attr('method');
				var action=$("#form").attr("action");
				$.ajax({
				type:method,
				url:action,
				data:{notChecked:"notChecked"},
				success:function(data){
					alert(data);
				}
				
				});
			
			$("#settings").show();
		}
		
	});
	
})
</script>
</head>
<body>
<?php validateUser::heading3();?>
<br>
<div class="container">
<div class="rows">
<div class="col-xs-12 col-sm-12 col-md-lg col-lg-12">

<ol class="breadcrumb"> 
<li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i>ADMIN</a></li> 
<li class="breadcrumb-item active"><i class='fa fa-dashboard'></i> DASHBOARD</li> 
</ol>
<br>
<?php
if(isset($_SESSION['success'])){
	
echo"<div class='alert alert-success'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h6 style='border-bottom:1px solid #eee;line-height:180%'>SUCCESS</h5>
			<p>".$_SESSION['success']."</p>
			</div>"; 
			unset($_SESSION['success']);
}
?>
<i class='fa fa-power-off text-success'></i> Turn Percent Promotion System On/Off</h5>
<p class="text-danger">* By default a 50% based grading system is used. This can be changed by turning this settings off </p>

<form method="POST" id="form" action="do_set_grading_system.php">
		<div class="custom-control custom-switch">
			<input type="checkbox" name="check" class="custom-control-input" id="customSwitch1"  />
			<label class="custom-control-label" for="customSwitch1">Toggle to the left to turn Off/Toggle to the right to turn On</label><br><br>
			</div>
		</form>
		<a href="change_settings.php" id="settings"><i class="fa fa-cogs"></i> Change Settings</a>
		
			<form method="POST" id="form2" action="change_settings.php">
		<div class="form-group">
		<label for="control-label"><strong>ENTER NEW PERCENTAGE:</strong></label>
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<input type="number" name="percentage" min="0" max="100" class="form-control"/>
		</div>
		</div>
		<button type="submit" class="btn aqua-gradient btn-sm">Submit</button> 
		</form>

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