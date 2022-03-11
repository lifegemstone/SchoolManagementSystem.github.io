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
	$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
	$select="SELECT email FROM users WHERE name='".$username."'";
	$query=$conn->query($select);
	$results=$query->fetch_array(MYSQLI_ASSOC);
	$user_email=$results['email'];
	
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
	<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="datatables/js/jquery.dataTables.min.js"></script>
    <script src="datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="datatables-responsive/dataTables.responsive.js"></script>
	  <script>
	  var transactionReference;
	  var userEmail="<?php echo base64_encode($user_email); ?>";
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
		$(".reference").on("click",function(){
					transactionReference=$(this).data("id");
				$("#modalTitle").html("TRANSACTION REFERENCE:: "+transactionReference);
				
			
		});
		
		$("#close").on("click",function(){
			
				$("#modal").modal('hide');
		});
		
		$("#delete").on("click",function(e){
			e.preventDefault();
			
			window.location="deleteTransaction.php?transacRef="+transactionReference;
		});
		
		$("#deleteAll").on("click",function(e){
			e.preventDefault();
			
			window.location="deleteAllTransactions.php?email="+userEmail;
		});
		
		
    });
    </script>
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
<div id="modal" class="modal fade" role="dailog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times </button>
				<h5 class="modal-title" id="modalTitle"></h5>
			</div>
			<div class="modal-body">
			<p> Are you sure you want to delete this transaction from your Transaction History</p>
			</div>
			<div class="modal-footer">
			<a href="#" class="btn btn-sm btn-primary" id="delete">DELETE</a> <button type="button" class="btn btn-sm btn-success" id="close">CLOSE</button>
			</div>
		</div>
	</div>
</div>

<?php
		if(isset($_SESSION["transactionDeleteSuccess"])){
		
		echo"<div class='alert alert-success'> 
		 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
		<h4 class='page-header'><i class='fa fa-check'></i> SUCCESS</h4>
				<p>".$_SESSION['transactionDeleteSuccess']."</p>
				</div>"; 
				unset($_SESSION['transactionDeleteSuccess']);
		}
		
		
		if(isset($_SESSION["allTransactionDeleteSuccess"])){
		
		echo"<div class='alert alert-success'> 
		 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
		<h4 class='page-header'><i class='fa fa-check'></i> SUCCESS</h4>
				<p>".$_SESSION['allTransactionDeleteSuccess']."</p>
				</div>"; 
				unset($_SESSION['allTransactionDeleteSuccess']);
		}
		
?>
<a href="#" class="btn btn-primary btn-sm" id="deleteAll" >Delete All Transactions</a><br><br>
<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
								
                                    <tr>
                                          
                                        <th> S/N </th>
                                        <th>Transaction Reference</th>
                                        <th>(<strike>N</strike>) Amount Paid</th>
										<th>Transaction Date</th>
										<th>View Transaction</th>
										<th>Delete Transaction</th>
                                    </tr>
                                </thead>
                                <tbody>
						<?php 
								$id=1;
								$conn=mysqli_connect(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME)or die('could not connect to the databse'.mysqli_connect_error());
						$select1="SELECT transaction_reference,amount,date FROM transaction_data WHERE email='$user_email'";
						$query1=mysqli_query($conn,$select1);
						while($results=mysqli_fetch_array($query1,MYSQLI_ASSOC))
						{ 
							
						echo '<tr>
                                  <td>'.$id.'</td>
								   <td>'.$results['transaction_reference'].'</td>
								    <td align="center">'.number_format($results['amount']).'</td>
									<td align="center">';
									$position=strpos($results['date'],"T");
									$newString=substr($results['date'],0,$position);
									$formatDate=date("d/M/Y",strtotime($newString));
									echo $formatDate;
									echo'</td>
									<td align="center"><a href="view_transaction.php?transac_ref='.$results['transaction_reference'].'"><i class="fa fa-eye"></i></a></td>
									<td align="center"><a href="#"  id="'.$results['transaction_reference'].'" class="reference" data-toggle="modal"  data-target="#modal" data-id="'.$results['transaction_reference'].'"><i class="fa fa-trash"></i></a></td>
						 
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
</html>