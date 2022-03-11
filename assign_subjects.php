<?php
//include_once("C:/wamp/dbconn_vbsms.php");
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
<li class="active">ASSIGN SUBJECT/SUBJECTS TO TEACHER</li> 
</ol>
<?php 
if(isset($_SESSION['Assign_success'])){
	
	echo"<div class='alert alert-success'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h4 class='page-header'>SUCCESS</h4>
			<p>".$_SESSION['Assign_success']."</p>
			</div>"; 
			unset($_SESSION['Assign_success']);
}
if(isset($_SESSION['assign_err'])){
	
	echo"<div class='alert alert-danger'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h4 class='page-header'><i class='fa fa-bell'></i> ERROR</h4>
	<p> The following Error/Errors Occurred while trying to assign subjects to teacher!!!! </p>";
			foreach($_SESSION['assign_err'] as $assign_err){
				
				echo"<p>$assign_err</p>";
				
				
			}
			echo"</div>"; 
			unset($_SESSION['assign_err']);
}
 
?>
<h4 class="page-header text-primary"><i class="fa fa-plus-circle text-primary" ></i> ASSIGN SUBJECT/SUBJECTS TO TEACHER </h4>
<form action="do_assign_subjects.php" method="POST">
	<button  class='btn btn-primary btn-xs' type="submit"><i class='fa fa-plus-circle'></i> Assign Subjects</button><br><br>
					 

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
						$select1="SELECT * FROM subjects ";
						$query1=mysqli_query($conn,$select1);
						$total_items_in_cart=mysqli_num_rows($query1);
						
						while($results=mysqli_fetch_array($query1,MYSQLI_ASSOC))
						{ 
							
						echo '<tr> 
                                  <td><input type="checkbox" name="id[]" value="'.$results['subject_id'].'" class="checkbox"></td>
								   <td>'.$results['subject'].'</td>
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