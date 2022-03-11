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
if(isset($_GET['s_id'])){
	
	
	$student_id=$_GET['s_id'];
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>
Id Card Generator
</title>
<link href="css/font-awesome.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/bootstrap.js"></script>
 <script src="printarea/js/jquery.printarea.js" type="text/JavaScript"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	$("#printButton1").click(print1);
	
});
	function print1(){
		var mode='iframe';
var close=mode=='popup';
var options={mode:mode,popClose:close};
$("div.printableArea1").printArea(options);
		
	};
</script>

<style type="text/css">
.footer{background:black;color:white;position:fixed;bottom:0;margin:0px;width:100%;}
.link{text-decoration:none;color:white}
a:hover{text-decoration:none;color:red}
</style>
 
</head>
<body>
<?php  validateUser::heading2()?>
<h3 class='page-header' align="center"><i class='fa fa-credit-card'></i> ID CARD GENERATOR</h3>
<div style="margin:0 30% 0 30%;min-width:50%">
<a href="#"  id="printButton1"><i class='fa fa-print' style="font-size:2em"></i> print Back Page</a><br>
<div style="width:235px;height:384px;border:2px solid blue;" class='printableArea1' ><!--3.375inch X 2.125inch standard id card size-->
<p  style="margin-top:20px" align="center"> This Identity Card certifies that the holder whose Name and Passport Photograph Appear Overleaf is a student Of
<h4 align="center"><strong> Vinebranch School</strong></h4>
<p style="padding-left:4px;padding-right:4px" align="center">If found kindly return to Vinebranch School,Mokola,Ibadan,Oyo State or kindly call the number affix the Overleaf. Thanks
<br>
<strong>Signed Management</strong></p>

</div>
</div><br><br><br><br><br>
<div class="footer" >
		<footer>
<p align="center"> <strong>&copy <?php echo date('Y');?>  Vinebranch School Management System </strong></p>
</footer>
</div>
</body>
</html>