<?php
//include('C:/wamp/dbconn_vbsms.php');
include_once("validate_user.php");

if(isset($_SESSION['username'])){
	$username=$_SESSION['username'];
}
else{
		echo "session not set";
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
a:hover{text-decoration:none;color:red}

</style>
</head>
<body>
<?php 
	validateUser::heading4();
?>
<br>
<div class="container">
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<ol class="breadcrumb"> 
<li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> <?php echo strtoUpper(validateUser::getRole());?></a></li> 
<li class="active breadcrumb-item"><i class='fa fa-dashboard'></i> DASHBOARD</li> 
<li class="active breadcrumb-item"><i class='fa fa-credit-card'></i> TRANSACTION</li>
</ol>


<h5 style="border-bottom:1px solid #eee;line-height:180%" class='text-danger' ><i class='fa fa-list'></i> Transaction Action </h5>

	<p><a href="payFees.php">Pay SchoolFees</a></p>

	<p><a href="transactionHistory.php">Transactions History</a></p>
</div>
			 </div>
		</div>
		<br><br>
<div class="footer">
		<footer>
<p align="center"> <strong>&copy <?php echo date('Y');?> Vinebranch School Management System </strong></p>
</footer>
</body>
</html>
