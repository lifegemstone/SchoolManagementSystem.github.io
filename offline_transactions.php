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
	$conn=new mysqli("localhost","root","","vbsms");
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
<head><title>Offline Transaction</title>
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
position:absolute;
bottom:0px;
width:100%;}
.link{text-decoration:none;color:white}
a:hover{text-decoration:none;color:white}
body{position:relative;}
#selectedResults{display:none}
</style>
</head>
<body>
<?php  validateUser::heading2();
//heading();?>
<div class="container">
<div class="rows">
<div class="col-xs-12 col-sm-12 col-md-lg col-lg-12">
<ol class="breadcrumb"> 
<li><a href="#"><i class="fa fa-home"></i>ADMIN</a></li> 
<li class=""><i class='fa fa-graduation-cap'></i> DASHBOARD</li> 
<li class="active">Offline Transaction</li> 
</ol>
<br><br>
<?php if(isset($_SESSION['offlinePaymentSuccess'])){
			echo" <div class='alert alert-success'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h4 class='page-header'>SUCCESS</h4>
	<p>".$_SESSION['offlinePaymentSuccess']."</p>";
	echo"</div>";
			unset($_SESSION['offlinePaymentSuccess']);
}
 if(isset($_SESSION['offlinePaymentError'])){
	 echo "<div class='alert alert-danger'>
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true' href='#'> &times </button>
			<h4 class='page-header'><i class='fa fa-warning'></i> ERROR</h4>
			<p>Sorry the following errors occurred while trying Input Offline Transaction. Kindly attend to these errors and try again!!!</p>";
	 foreach($_SESSION['offlinePaymentError'] as $_SESSION['error'])
	  { 
			
			echo"<p><i class='fa fa-warning'></i> ".$_SESSION['error']." .</p>";
			
			
	  }
	
	  echo"</div>";
	    unset($_SESSION['offlinePaymentError']);
 }
?>
<h4 class="page-header text-primary"><i class="fa fa-credit-card"></i> Offline Transaction</h4>
<form  class="form-horizontal" action="do_offlineTransaction.php" enctype='multipart/form-data' method="POST">
<div class="form-group">
<label for="date" class="col-sm-3 control-label">Transaction Date *</label>
<div class="col-sm-7">
<input type="date" name="date" autocomplete="off"  placeholder="Date Paid" class="form-control"/>
</div>
</div>
<div class="form-group">
<label for="bankName" class="col-sm-3 control-label"><i class="fa fa-bank"></i> Bank Name *</label>
<div class="col-sm-7">
<input type="text" name="bankName" autocomplete="off" placeholder="Bank Name" class="form-control" />
</div>
</div>
<div class="form-group">
<label for="amount" class="col-sm-3 control-label">(<strike>N</strike>) Amount * </label>
<div class="col-sm-5">
<input type="number" name="amount" min="1"  autocomplete="off" placeholder="Amount Paid" class="form-control"/>
</div>
</div>
<div class="form-group">
<label for="paidBy" class="col-sm-3 control-label">Paid By * </label>
<div class="col-sm-5">
<input type="text" name="paidBy" autocomplete="off" placeholder="Paid By Your Full Name" class="form-control"/>
</div>
</div>
<div class="form-group">
<label for="phoneNumber" class="col-sm-3 control-label">Phone Number * </label>
<div class="col-sm-5">
<input type="text" name="phoneNumber" autocomplete="off" placeholder="Enter Phone Number" class="form-control"/>
</div>
</div>
<div class="form-group">
<label for="recieptNumber" class="col-sm-3 control-label">Reciept Number* </label>
<div class="col-sm-5">
<input type="text" name="recieptNumber" autocomplete="off" placeholder="Enter Reciept Number" class="form-control"/>
</div>
</div>
<div class="form-group">
<label for="accademicSession" class="col-sm-3 control-label">Accademic Session * </label>
<div class="col-sm-5">
<input type="text" disabled min="1" autocomplete="off" value="<?php 
	$sessionStartYear=date("Y",time());
	$sessionEndYear=$sessionStartYear+1;
	$currentSession=$sessionStartYear."/".$sessionEndYear;
	echo $currentSession;

?>" class="form-control"/>
</div>
</div>
<div class="form-group">
<label for="payFor" class="col-sm-3 control-label">Payment Mode  *</label>
<div class="col-sm-5">
<select name="paymentMode" class="form-control paymentMode">
<option>Single Mode</option>
<option>Bulk Mode</option>
</select>
</div>
</div>
<div id="selectedResults">
</div>
<div id="ajaxLoad">
</div>

<h5 class='page-header text-danger'><i class='fa fa-image'></i> Upload Reciept of Payment*</h5>
<input type="hidden" name="usrcd" value='<?php echo"$usrcd";?>' />

<div class="form-group">
<label for="image" class="col-sm-3 control-label">Upload Reciept  *</label>
<input type="file" name="img"/><br>
<label  class="col-sm-3 control-label">
<button type="submit" class="btn btn-md btn-primary"><i class='fa fa-plus-circle'></i>Add Transaction</button></label><br><br><br><br>
</div>
</form>
			 </div>
			 </div>
			 </div>
<div class="footer">
		<footer>
<p align="center"> <strong>&copy <?php echo date('Y');?>  Vinebranch School Management System </strong></p>
</footer>
<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="datatables/js/jquery.dataTables.min.js"></script>
<script src="datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="datatables-responsive/dataTables.responsive.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	var paymentMode;
		paymentMode=$(".paymentMode").val()
	if(paymentMode!=""){
			paymentMode=encodeURIComponent($('.paymentMode').val());
			$("#ajaxLoad").load("getStudentList.php?mode="+paymentMode);
	}
		$('.paymentMode').on("change",function(){
		paymentMode=encodeURIComponent($(this).val());
		var selectedClass=encodeURIComponent($("#studentClass").val());
		$("#ajaxLoad").load("getStudentList.php?mode="+paymentMode);
		//alert(selectedClass);
		});
	
	$('#studentClass').on("change",function(){
		var paymentMode=$('.paymentMode').val();
		var paymentMode=encodeURIComponent(paymentMode);
		var selectedClass=encodeURIComponent($(this).val());
		$("#ajaxLoad").load("getStudentList.php?c_name="+selectedClass+"&mode="+paymentMode);
		//alert(selectedClass);
	});
	
	
	
})

</script>
</body>
</html>