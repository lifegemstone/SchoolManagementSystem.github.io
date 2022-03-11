<?php 
//include_once('C:/wamp/dbconn_vbsms.php');
include_once('validate_user.php');
//include_once('functions.php');

if(isset($_SESSION['username'])){
	$username=$_SESSION['username'];
}
else{
		echo "session not set";
}

if(isset($_GET['usrcd'])){
	$usrcd=$_GET['usrcd'];
}
else{
	
		exit();
}
	$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
	$select="SELECT user_token FROM users WHERE name='".$username."'";
	$query=$conn->query($select);
	$results=$query->fetch_array(MYSQLI_ASSOC);
	$user_token=$results['user_token'];
		if($usrcd != $user_token){
			validateUser::logout();
			
			
		}
		
		if(isset($_SESSION['token'])){
			$token=$_SESSION['token'];
	}
	
?>
<!DOCTYPE HTML>
<html>
<head><title>Transaction History</title>
<meta name="viewport" content="width=device-width initial-scale=1">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.css" rel="stylesheet" type="text/css">
<link href="css/sb-admin-2.css" rel="stylesheet" type="text/css">
  <link href="css/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

<style type='text/css'>
.footer{background:black;color:white;position:fixed;bottom:0;margin:0px;width:100%;}
.link{text-decoration:none;color:white}
a:hover{text-decoration:none;color:blue}

</style>
</head>
<body>
<?php  validateUser::heading2() ?>
<div class="container">
<div class="rows">
<div class="col-xs-12 col-sm-12 col-md-lg col-lg-12">
<ol class="breadcrumb"> 
<li><a href="#"><i class="fa fa-home"></i>DASHBOARD</a></li> 
<li>PARENT</li> 
<li class="active">Transaction History</li> 
</ol>

<a href="offline_transactions.php?usrcd=<?php echo $usrcd;?>" class="btn btn-success btn-xs"><i class="fa fa-plus-circle"></i> Add Offline Transactions</a><br><br>

		
<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
								
                                    <tr>
                                          
                                        <th> S/N </th>
                                        <th>Transaction Reference</th>
										<th>Payment Channel</th>
										<th>Payment Mode</th>
                                        <th>(<strike>N</strike>) Amount Paid</th>
										<th>Paid By</th>
										<th>Student Name</th>
										<th>Class </th>
										<th>Transaction Date</th>
										<th>View Transaction</th>
                                    </tr>
                                </thead>
                                <tbody>
						<?php 
								$id=1;
								$conn=mysqli_connect(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME)or die('could not connect to the databse'.mysqli_connect_error());
						$select1="SELECT transaction_id,transaction_reference,channel,payment_mode,amount,paid_by,student_name,date FROM transaction_admindata";
						$query1=mysqli_query($conn,$select1);
						while($results=mysqli_fetch_array($query1,MYSQLI_ASSOC))
						{ 
							
						echo '<tr>
                                  <td>'.$id.'</td>
								   <td>'.$results['transaction_reference'].'</td>
								   <td>'.$results['channel'].'</td>
								   <td>';
										if($results['channel']=="card"){
											echo"<span class='text-success'><strong> Debit Card</strong></span>";
										}
										elseif($results['payment_mode']=="Single Mode"){
											echo"<span class='text-danger'><strong>".$results['payment_mode']."</strong></span>";
										}
										else{
											
												echo"<span class='text-primary'><strong>".$results['payment_mode']."</strong></span>";
										}
								    echo'</td><td align="center">'. number_format($results['amount']).'</td>
									 <td align="center">'. $results['paid_by'].'</td>
									 <td align="center">'. $results['student_name'].'</td>
									 <td align="center">'. $results[''].'
									<td align="center">';
									$position=strpos($results['date'],"T");
									if($position !=""){
										$newString=substr($results['date'],0,$position);
									}
									else{
											$newString=$results['date'];
									}
									$formatDate=date("d/M/Y",strtotime($newString));
									echo $formatDate;
									echo'</td>
									<td align="center"><a href="view_adminTransaction.php?transac_ref='.$results['transaction_reference'].'&chan='.$results['channel'].'"><i class="fa fa-eye"></i></a></td>
						 </tr>';
						$id++;}
                                        
                                  
                       
							 ?>
                                
                                </tbody>
								
                            </table>
							</div>
			 </div>
			 </div><br>
			 
<div class="footer" >
		<footer>
<p align="center"> <strong>&copy <?php echo date('Y');?> Vinebranch School Management System </strong></p>
</footer>
</div>
</body>
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
</html>