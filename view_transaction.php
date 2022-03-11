<?php 
include_once("validate_user.php");
 //include_once('functions.php');

if(isset($_SESSION['username'])){
	$username=$_SESSION['username'];
}
else{
		echo "session not set";
}
	
if(isset($_GET['transac_ref'])){
	
	$transaction_reference=$_GET['transac_ref'];
}

$mysqli=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME) or die("could not connect to the database");
$select="SELECT transaction_id,amount,paid_by,phone_number,channel,date FROM transaction_data WHERE transaction_reference='$transaction_reference'";
$query=$mysqli->query($select);
$result=$query->fetch_array(MYSQLI_ASSOC);
$transactionId=$result['transaction_id'];
$amount=$result['amount'];
$paidBy=$result['paid_by'];
$paymentChannel=$result['channel'];
$transactionDate=$result['date'];
$phoneNumber=$result['phone_number'];
?>
<!DOCTYPE HTML>
<html>
<head><title>Pay School Fees</title>
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
	<script src="printarea/js/jquery.printarea.js" type="text/JavaScript"></script>
	
<style type='text/css'>
.footer{background:black;
color:white;
position:fixed;
bottom:0px;
width:100%;}
.link{text-decoration:none;color:white}
a:hover{text-decoration:none;color:white}
body{position:relative;}
</style>

<script type="text/javascript">
$(document).ready(function(){
	
	$("#printTransaction").click(printTransaction);
	function printTransaction(){
		var mode='iframe';
var close=mode=='popup';
var options={mode:mode,popClose:close};
$("div.printTransaction").printArea(options);
		
	};
	
});
</script>
</head>
<body>
<?php 
validateUser::heading4();
//heading();?>
<br>
<div class="container">
<div class="rows">
<div class="col-xs-12 col-sm-12 col-md-lg col-lg-12">
<ol class="breadcrumb"> 
<li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i>PARENT</a></li> 
<li class="breadcrumb-item"><i class='fa fa-graduation-cap'></i> DASHBOARD</li> 
<li class="active breadcrumb-item">TRANSACTION DETAILS</li> 
</ol>
<br>
<?php
echo"<a href='#' class='btn btn-primary' id='printTransaction'><i class='fa fa-print'></i> Print </a><br> 
	<div class='card printTransaction'> <h5 class='card-header'> TRANSACTION DETAILS </h5>
		<div class='card-body'><h5 class='card-title'>Payment Information</h5>
			<p class='card-text'> Transaction ID: ".$transactionId."</p>
			<p class='card-text'> Transaction Reference: ".$transaction_reference."</p>
			<p class='card-text'> Transaction Date: ".$transactionDate." </p> 
			<p class='card-text'> Payment Channel: ".$paymentChannel."</p>
			<p class='card-text'> Amount Paid: <strike>N</strike> ". number_format($amount)." </p>
			<p class='card-text'> Paid By: ".$paidBy."</p>
			<p class='card-text'> Phone Number: ".$phoneNumber."</p>
			</div>
			</div>";
			
			?>
			<br><br><br>
			 </div>
			 </div>
			 </div>
<div class="footer">
		<footer>
<p align="center"> <strong>&copy <?php echo date('Y');?>  Vinebranch School Management System </strong></p>
</footer>

</script>
</body>
</html>
</body>
</html>