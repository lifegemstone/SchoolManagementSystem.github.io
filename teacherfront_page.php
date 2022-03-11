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
<?php validateUser::heading2()?>
<h3 class='page-header' align="center"><i class='fa fa-credit-card'></i> ID CARD GENERATOR</h3>
<div style="margin:0 30% 0 30%;min-width:50%">
<a href="#"  id="printButton1"><i class='fa fa-print' style="font-size:2em"></i> print Front Page</a><br>
<div style="width:235px;height:384px;border:2px solid blue;" class='printableArea1' ><!--3.375inch X 2.125inch standard id card size-->
<h5 align="center" style="margin-top:5px"><strong>Vinebranch School</strong></h5>
<h6 align="center"><span style='background:black;color:white;font-size:1.3em;'>STAFF ID CARD</span></h6>
<?php
$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME) or die("could not connect to the database");
$select="SELECT * FROM teachers WHERE teacher_id='$teacher_id'";
$query=$conn->query($select);
while($results=$query->fetch_array(MYSQLI_ASSOC)){
	
	echo"
	<img style='margin-left:35px;' class='img-rounded' src='teachersImages/".$results['teacher_img']."' alt='img' width='170px' height='170px'>
	
		<h6 style='color:blue;margin-left:10px' align='center'>ID NO: t-ID ".$results['teacher_id']."</h6>
	<h6 style='margin-left:10px'><strong>NAME:</strong> ".strtoupper("".$results['teacher_name']."")." </h6>
	<h6 style='margin-left:10px'><strong>ROLE:</strong> Teacher</h6>
			<h6 style='margin-left:10px'><strong>GENDER:</strong> ".$results['sex']."</h6>
			<h6 style='margin-left:10px'><strong>PHONE NO:</strong> ".$results['telephone']."</h6>
			<h6 style='margin-left:10px;padding:0px'><strong>ISSUED DATE:</strong> ".date('d M Y',strtotime($results['date']))."</h6>
		
		";
	
	
	
}



?>
</div>
</div>
</div>
</div><br><br><br><br><br>
<div class="footer" >
		<footer>
<p align="center"> <strong>&copy <?php echo date('Y');?>  HMO </strong></p>
</footer>
</div>
</body>
</html>