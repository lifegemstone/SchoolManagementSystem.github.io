<?php 

include_once('validate_user.php');
//include_once('functions.php');

$usr_email=validateUser::get_email();
$id=1;

?>
<!DOCTYPE HTML>
<html>
<head><title>Teachers Profile</title>
<meta name="viewport" content="width=device-width initial-scale=1">
<link href="MDB-Free_4.7.1/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.css" rel="stylesheet" type="text/css">
<link href="MDB-Free_4.7.1/css/mdb.min.css" rel="stylesheet" type="text/css">
<link href="MDB-Free_4.7.1/css/style.css" rel="stylesheet" type="text/css">
<link href="css/sb-admin-2.css" rel="stylesheet" type="text/css">
<link href="MDB-Free_4.7.1/css/addons/datatables.min.js" rel="stylesheet" type="text/css">
	
<style type='text/css'>
.footer{background:black;color:white;position:fixed;bottom:0;margin:0px;width:100%;}
.link{text-decoration:none;color:white}
a:hover{text-decoration:none;color:white}
lecture_days{ padding-bottom:15px}
.table{margin-bottom:50px!important;
border:1px solid gray}
td{border:1px solid gray!important;}
.gray{background:gray}
.save{display:none}
</style>
</head>
<body>
<?php  validateUser::heading4() ?>
<br>
<div class="container">
<div class="row">
<div class="col-sm-12 col-md-12 col-lg-12">
<ol class="breadcrumb"> 
<li class="breadcrumb-item active"><i class="fa fa-dashboard"></i> DASHBOARD</li> 
<li class="breadcrumb-item"><a href="allAssignment_category.php"><i class="fa fa-list"></i> All Assignments </a></li> <!--also have option to delete
category which will pop up a warning on deleting that says all questions assigned to the category and its records will be deleted-->
<li class="breadcrumb-item"><a href="create_assignment_category.php"><i class="fa fa-pencil"></i> Create Assignment Category</a></li>  
<li class="breadcrumb-item"><a href="assign_assignments.php"><i class="fa fa-building"></i> Assign Assignments to Class</a></li> 
<li class="breadcrumb-item"><a href="#"><i class="fa fa-book"></i> Active Assignments </a></li>   <!-- will hold the class the assignment is assigned to, the status of submission of the
assignment-->
</ol>
	<br>		
	<h5 style="border-bottom:1px solid #eee;line-height:180%" class='text-danger' ><i class='fa fa-list'></i> All Assignment Categories </h5><br>
						<?php 
								
						$conn=mysqli_connect(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME)or die('could not connect to the databse'.mysqli_connect_error());
						$select1="SELECT * FROM assignment_category";
						$query1=mysqli_query($conn,$select1);
						echo'
							<table width="100%" class="table table-striped table-bordered table-hover" id="dataTable">
                                <thead>
								
                                    <tr>
                                          
                                        <th> S/N </th>
                                        <th>Category Name</th>
                                        <th>View Category</th>
										<th>Add Questions</th>
										<th>Assign Assignments</th>
										<th>Delete Category</th>											
                                    </tr>
                                </thead>
                                <tbody>';
						while($results=mysqli_fetch_array($query1,MYSQLI_ASSOC))
						{ 
								echo '<tr>
                                  <td>'.$id.'</td>
								   <td>'.$results['category_name'].'</td>
									<td align="center"><a href="viewAssignmentCategory.php?cat_id='.$results['category_id'].'">View</a></td>
									<td><a href="addQuestions.php">Add Questions</a></td>
									<td><a href="assignAssignments.php">Assign Assignments</a></td>
									<td><a href="deleteCategory.php"><i class="fa fa-trash"></a></td>
									
						 </tr>';
						$id++;}
                                
                               echo" </tbody>
								
                            </table>"; 
?>							
               
			 </div></div></div>
			 <br><br><br>
			 
<div class="footer" >
		<footer>
<p align="center"> <strong>&copy <?php echo date('Y');?>  Vinebranch School Management System </strong></p>
</footer>
<script type="text/javascript" src="MDB-Free_4.7.1/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="MDB-Free_4.7.1/js/popper.min.js"></script>
<script type="text/javascript" src="MDB-Free_4.7.1/js/bootstrap.js"></script>
<script type="text/javascript" src="MDB-Free_4.7.1/js/mdb.min.js"></script>
<script type="text/javascript" src="MDB-Free_4.7.1/js/addons/datatables.min.js"></script>
<script>
$(document).ready(function(){
	$('#dataTable').DataTable({
		responsive: true
	});
});
</script>
</div>
</body>
</html>