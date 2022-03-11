<?php 
//include_once('C:/wamp/dbconn_vbsms.php');
include_once('validate_user.php');
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
?>
<!DOCTYPE HTML>
<html>
<head><title>Application Users</title>
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
		var tr_id;
		$('td.Email').click(function(){
			var email;
			var usr_email;
			email=$(this).attr('id');
			$('#email').val(email);
			$('#usr_email').val(email);
		});
		//reloads the page when the modal is closed
		$('#mymodal').on('hidden.bs.modal',function(){
			
			location.reload();
			
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
<li><a href="#"><i class="fa fa-home"></i>Vinebranch School Management System</a></li> 
<li>DASHBOARD</li> 
<li class="active">APPLICATION USERS</li> 
</ol>

<?php if(isset($_SESSION['stud_delete_success'])){
	
	echo"<div class='alert alert-success'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h4 class='page-header'><i class='fa fa-check-circle'></i> SUCCESS</h4>
			<p>".$_SESSION['stud_delete_success']."</p>
			</div>"; 
			unset($_SESSION['stud_delete_success']);
			
			
}


if(isset($_SESSION['reset_success'])){
	
	echo"<div class='alert alert-success'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h4 class='page-header'><i class='fa fa-check-circle'></i> SUCCESS</h4>
			<p>".$_SESSION['reset_success']."</p>
			</div>"; 
			unset($_SESSION['reset_success']);
			
			
}



if(isset($_SESSION['reset_error'])){
	
	echo"<div class='alert alert-danger'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h4 class='page-header'><i class='fa fa-bell'></i> ERROR</h4>
			<p>".$_SESSION['reset_error']."</p>
			</div>"; 
			unset($_SESSION['reset_error']);
			
			
}

?>		
<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
								
                                    <tr>
                                          
                                        <th> S/N </th>
                                        <th>Username</th>
                                        <th>Email</th>
										 <th>Reset Password</th>
										
										  
                                    </tr>
                                </thead>
                                <tbody>
						<?php 
								$id=1;
								$conn=mysqli_connect(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME)or die('could not connect to the databse'.mysqli_connect_error());
						$select1="SELECT * FROM users";
						$query1=mysqli_query($conn,$select1);
						while($results=mysqli_fetch_array($query1,MYSQLI_ASSOC))
						{ 
							
						echo '<tr>
                                  <td>'.$id.'</td>
								   <td>'.$results['name'].'</td>
								    <td>'.$results['email'].'</td>
									<td class="Email" id='.$results['email'].'><a href="#" data-toggle="modal" data-target="#mymodal">Reset Password</a></td>
									<div class="modal fade" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="mymodal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title"  style="color:green"><span class="fa fa-user" style="color:black" aria-hidden="true"></span> Reset User Account '.$results['user_id'].'</h4>
				</div>
				
				<div class="modal-body">
			<form action="do_reset_password.php" method="POST">
				<div class="form-group">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<label for="email" class="col-md-3 control-label">Enter Email:</label>
					<div class="col-sm-12 col-md-8 col-lg-8">
						<input type="text" name="email" id="email"  disabled  value="" class="form-control"/><br>
					</div>
				</div>
				<div class="form-group">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<label for="email" class="col-md-3 control-label">Reset Password:</label>
					<div class="col-sm-12 col-md-8 col-lg-8">
						<input type="text" name="password"  class="form-control"/><br>
					</div>
				</div>
				<input type="hidden" name="usr_email" value="" id="usr_email"/>
				<input type="hidden" name="usrcd" value="'.$usrcd.'" id="usr_email"/>
<button type="submit" class="btn btn-primary" >RESET</button>
<button type="button" class="btn btn-danger"  data-dismiss="modal">CANCEL</button>
</form>
</div>
				<div class="modal-footer">
				<p>&copy '.date("Y").' Vinebranch School Management System</p>
				</div>
			</div>
		</div>
		</div>
	</div>
			
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