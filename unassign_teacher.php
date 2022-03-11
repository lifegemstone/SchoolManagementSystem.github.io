<?php

include_once("validate_user.php");
if(!isset($_SESSION['username'])){
	header('location:login.php');
}
if(isset($_GET['t_id'])){
$teacher_id=$_GET['t_id'];
}
else{
		exit();
}
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
$subjects=array();
$class_name=array();	
?>
<!DOCTYPE HTML>
<html>
<head><title>ADMIN</title>
<meta name="viewport" content="width=device-width initial-scale=1">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.css" rel="stylesheet" type="text/css">
<link href="css/eportalstyle.css" rel="stylesheet" type="text/css">
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
.footer{background:black;
color:white;
position:fixed;
bottom:0;
width:100%;}
.link{text-decoration:none;color:white}
a:hover{text-decoration:none;color:white}

</style>
</head>
<body>
<?php validateUser::heading2();?>
<div class="container">
<div class="rows">
<div class="col-xs-12 col-sm-12 col-md-lg col-lg-12">
<ol class="breadcrumb"> 
<li><a href="#"><i class="fa fa-home"></i>ADMIN</a></li> 
<li class="active">UNASSIGN SUBJECT FROM TEACHER</li> 
</ol>
<?php 
if(isset($_SESSION['unassign_success'])){
	
	echo"<div class='alert alert-success'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h4 class='page-header'>SUCCESS</h4>
			<p>".$_SESSION['unassign_success']."</p>
			</div>"; 
			unset($_SESSION['unassign_success']);
}
if(isset($_SESSION['undo_success'])){
	
	echo"<div class='alert alert-success'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h4 class='page-header'>SUCCESS</h4>
			<p>".$_SESSION['undo_success']."</p>
			</div>"; 
			unset($_SESSION['undo_success']);
}
 if(isset($_SESSION['unassign_error'])){
	
	echo"<div class='alert alert-danger'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h4 class='page-header'>ERROR</h4>
			<p>".$_SESSION['unassign_error']."</p>
			</div>"; 
			unset($_SESSION['unassign_error']);
}
?>
<h4 class="page-header text-primary"><i class="fa fa-minus-circle text-danger" ></i> UNASSIGN SUBJECT FROM TEACHER </h4>
<form action="unassign.php" method="POST">
	<button  class='btn btn-primary btn-xs' type="submit"><i class='fa fa-minus-circle'></i> UnAssign</button><br><br>
					 

<table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                <thead>
								
                                    <tr>
                                          
                                        <th> Check Box</th>
                                        <th>Subject Name</th>
                                        <th>Class Name</th> 
                                    </tr>
                                </thead>
                                <tbody>
						<?php 
								$id=1;
								$conn=mysqli_connect(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME)or die('could not connect to the databse'.mysqli_connect_error());
						$select1="SELECT * FROM assign_subjects WHERE teacher_id='$teacher_id' ";
						$query1=mysqli_query($conn,$select1);
					
						
						while($results=mysqli_fetch_array($query1,MYSQLI_ASSOC))
						{ 
							$teacher_id=$results['teacher_id'];
						
						echo '<tr>
                                  <td><input type="checkbox" name="id[]" value="'.$results['id'].'" class="checkbox"></td>
								   <td>'.$results['subject_name'].'</td>
								    <td>'.$results['class_name'].'</td>';
									
						 echo'</tr>';
						$id++;}
                                        
                                  
                       
							 ?>
                                
                                </tbody>
								
                            </table>
							<input type="hidden" name="teacher_id" value="<?php echo $teacher_id;?>" />
							<input type="hidden" name="usrcd" value="<?php echo $usrcd;?>" />
							</form>
					
							</div>
			 </div>
			 </div><br>
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
</body>
</html>