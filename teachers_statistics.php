<?php 
include_once('validate_user.php');
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
<head><title>Teachers Statistics</title>
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
    });
    </script>
<style type='text/css'>
.footer{background:black;color:white;position:fixed;bottom:0;margin:0px;width:100%;}
.link{text-decoration:none;color:white}
a:hover{text-decoration:none;color:blue}

</style>
</head>
<body>
<?php validateUser::heading2();?>
<div class="container">
<div class="rows">
<div class="col-xs-12 col-sm-12 col-md-lg col-lg-12">
<ol class="breadcrumb"> 
<li><a href="#"><i class="fa fa-home"></i>Vinebranch School Management System</a></li> 
<li class="">DASHBOARD</li> 
<li class="active">Teachers STATISTICS</li> 
</ol>
			
			<?php if(isset($_SESSION['delete_success'])){
	
	echo"<div class='alert alert-success'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h4 class='page-header'>SUCCESS</h4>
			<p>".$_SESSION['delete_success']."</p>
			</div>"; 
			unset($_SESSION['delete_success']);
}
		?>	 
		
		<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
								
                                    <tr>
                                          
                                        <th> S/N </th>
                                        <th>Teacher Name</th>
                                        <th>Teacher Profile</th>
										 <th>Drop Teacher</th>
										  <th>Assign Subjects</th>
										   <th>UnAssign Subjects</th>
										 <th>Create Time-Table</th>
										 <th>Edit Time-Table</th>
										  <th>Generate Teacher ID Card</th>
										  
                                    </tr>
                                </thead>
                                <tbody>
						<?php 
								$id=1;
								$conn=mysqli_connect(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME)or die('could not connect to the databse'.mysqli_connect_error());
						$select1="SELECT * FROM teachers ";
						$query1=mysqli_query($conn,$select1);
						$total_items_in_cart=mysqli_num_rows($query1);
						
						while($results=mysqli_fetch_array($query1,MYSQLI_ASSOC))
						{ 
							$teacher_id=$results['teacher_id'];
						echo '<tr>
                                  <td>'.$id.'</td>
								   <td>'.$results['teacher_name'].'</td>
								    <td align="center"><a href="teacher_profile.php?t_id='.$teacher_id.'&usrcd='.$usrcd.'"><i class="fa fa-user"></i></a></td>
									<td align="center"><a href="delete_teacher.php?t_id='.$teacher_id.'&usrcd='.$usrcd.'"><i class="fa fa-trash"></i></a></td>
									<td align="center"><a href="assign_subjects.php?t_id='.$teacher_id.'&usrcd='.$usrcd.'"><i class="fa fa-plus-circle text-success"></i> Assign Subjects</a></td>
									<td align="center"><a href="unassign_teacher.php?t_id='.$teacher_id.'&usrcd='.$usrcd.'"><i class="fa fa-minus-circle text-danger"></i> UnAssign Subjects</a></td>
									<td><a href="create_timetable.php?t_id='.$teacher_id.'&usrcd='.$usrcd.'">Create Time-Table</a></td>
									<td><a href="edit_timetable.php?t_id='.$teacher_id.'&usrcd='.$usrcd.'">Edit Time-Table</a></td>
									<td><a href="teachers_idcard.php?t_id='.$teacher_id.'&usrcd='.$usrcd.'">Generate ID Card</a></td>
						 
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