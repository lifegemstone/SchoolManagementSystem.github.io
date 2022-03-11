<?php 

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
<head><title>Stundents Statistics</title>
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
		$('tr').click(function(){
			
			var tr_id=$(this).attr('id');
			$('#yes').val(tr_id);
			
			
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
<li class="active">STUDENTS STATISTICS</li> 
</ol>


		
<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
								
                                    <tr>
                                          
                                        <th> S/N </th>
                                        <th>Student Name</th>
                                        <th>Student Token</th>
                                        <th>Class</th>
										<th>Sex</th>
										<th>Age</th>
										<th>Parent Telephone No</th>
										 <th>Edit</th>
										  <th>Generate Student ID Card</th>
										  
                                    </tr>
                                </thead>
                                <tbody>
						<?php 
								$id=1;
								$conn=mysqli_connect(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME)or die('could not connect to the databse'.mysqli_connect_error());
						$select1="SELECT * FROM students";
						$query1=mysqli_query($conn,$select1);
						while($results=mysqli_fetch_array($query1,MYSQLI_ASSOC))
						{ 
							
						echo '<tr id='.$results['student_id'].'>
                                  <td>'.$id.'</td>
								   <td>'.$results['student_name'].'</td>
								   <td><span class="text-primary">'.$results['student_token'].'</span></td>
								    <td align="center">'.$results['class_name'].'</td>
									<td align="center">'.$results['sex'].'</td>
									<td align="center">';
									$current_timestamp=time();
									$current_year=date('Y',$current_timestamp);
									$birth_year=date('Y',strtotime($results['date_birth']));
									$age=$current_year-$birth_year;
									echo''.$age.'</td>
									<td>'.$results['telephone_no'].'</td>
									<td><a href="edit_student.php?s_id='.$results['student_id'].'&usrcd='.$usrcd.'"><i class="fa fa-pencil"></i></a></td>
									<td><a href="student_idcard.php?s_id='.$results['student_id'].'&usrcd='.$usrcd.'">Generate ID Card</a></td>
									<div class="modal fade" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="mymodal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="mymodal" style="color:green"><span class="fa fa-warning" style="color:black" aria-hidden="true"></span> Remove Student From Database</h4>
				</div>
				
				<div class="modal-body">
			<form action="do_delete_students.php" method="GET">
				<h5 class="text-danger">ARE YOU SURE YOU WANT TO REMOVE THIS STUDENT FROM SCHOOL DATABASE</h5>
				<input type="hidden" name="s_id" value=""  id="yes"/>
				<input type="hidden" name="usrcd" value="'.$usrcd.'" />
<button type="submit" class="btn btn-primary" >YES</button>
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