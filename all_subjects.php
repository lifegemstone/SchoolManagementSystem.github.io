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
<head><title>All Class Subjects</title>
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
<li class="active">All Class Subject</li> 
</ol>
			
			<?php 
			
		if(isset($_SESSION['delete_success'])){
	
	echo"<div class='alert alert-success'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h4 class='page-header'>SUCCESS</h4>
			<p>".$_SESSION['delete_success']."</p>
			</div>"; 
			unset($_SESSION['delete_success']);
				}
				
		if(isset($_SESSION['subjects_assigned'])&& isset($_SESSION['class_assigned'])){
			$counter=0;
			$size=sizeof($_SESSION['subjects_assigned']);
	echo"<div class='alert alert-danger'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h4 class='page-header'><i class='fa fa-bell'></i> ERROR</h4>
			<p>The following subjects could not be deleted because they are assigned to a teacher<br>
			Try Unassigning the subject from the teacher and then try again...</p>";
			foreach($_SESSION['subjects_assigned'] as $subject_name){
						echo"<p> >>{".$subject_name."} {".$_SESSION['class_assigned'][$counter]."}</p>";
						$counter++;
			}
			echo"</div>"; 
			unset($_SESSION['subjects_assigned']);
			unset($_SESSION['class_assigned']);
				}	
				
	if(isset($_SESSION['undo_success'])){
	
	echo"<div class='alert alert-success'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h4 class='page-header'>SUCCESS</h4>
			<p>".$_SESSION['undo_success']."</p>
			</div>"; 
			unset($_SESSION['undo_success']);
}
		?>	 
		<form method="POST" action="edit_subjects.php">
		<button type="submit" name="edit" class='btn btn-xs btn-primary'><i class='fa fa-edit'></i> Edit Subjects</button><button type="submit" name="delete" style="color:white" class='btn btn-xs btn-warning'><i class='fa fa-trash'></i> Delete Subjects</button><br><br>
		<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
								
                                    <tr>
                                          
                                        <th> Select</th>
                                        <th>Subject Name</th>
                                        <th>Class Name</th>
										 <th>Subject Teacher</th>
										  
										  
                                    </tr>
                                </thead>
                                <tbody>
						<?php 
								$id=1;
								$conn=mysqli_connect(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME)or die('could not connect to the databse'.mysqli_connect_error());
						$select1="SELECT * FROM subjects ORDER BY class_name ASC";
						$query1=mysqli_query($conn,$select1);
						$total_sub=mysqli_num_rows($query1);
						
						while($results=mysqli_fetch_array($query1,MYSQLI_ASSOC))
						{ 
							
						echo '<tr>
                                  <td><input type="checkbox" name="checked[]" value='.$results['subject_id'].' class="checkbox" /></td>
								   <td>'.$results['subject'].'</td>
								    <td>'.$results['class_name'].'</td>';
									$sub_select="SELECT teacher_name FROM teachers AS t INNER JOIN assign_subjects AS aSub ON t.teacher_id=aSub.teacher_id WHERE aSub.subject_id='".$results['subject_id']."' AND aSub.class_name='".$results['class_name']."' ";
									$do_query=mysqli_query($conn,$sub_select);
									if(mysqli_num_rows($do_query)>0){
									$query_results=mysqli_fetch_array($do_query,MYSQLI_ASSOC);
									echo'<td class="text-primary">'.$query_results['teacher_name'].'</td>';
									}
									else{
											echo'<td class="text-danger">N/A</td>';
									}
									
						 
						echo' </tr>';
						$id++;}
                                        
                                  
                       
							 ?>
                                
                                </tbody>
								
                            </table> 
							<input type="hidden" name="usrcd" value='<?php echo "$usrcd";?>' />
							</form>
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