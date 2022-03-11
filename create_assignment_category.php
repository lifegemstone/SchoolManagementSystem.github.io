<?php 

include_once('validate_user.php');
//include_once('functions.php');

$usr_email=validateUser::get_email();

?>
<!DOCTYPE HTML>
<html>
<head><title>Create Assignment Category</title>
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
<li class="breadcrumb-item"><a href="#"><i class="fa fa-pencil"></i> Create Category </a></li> <!--also have option to delete
category which will pop up a warning on deleting that says all questions assigned to the category and its records will be deleted-->
   <!-- will hold the class the assignment is assigned to, the status of submission of the
assignment-->
</ol>
	<br>	
	<?PHP	
	
		if(isset($_SESSION["categoryDuplicate"])){
		
		echo"<div class='alert alert-warning'> 
		 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
		<h4 class='page-header'><i class='fa fa-warning'></i> ERROR</h4>
				<p>".$_SESSION['categoryDuplicate']."</p>
				</div>"; 
				unset($_SESSION['categoryDuplicate']);
		}
	
		if(isset($_SESSION["categoryCreationSuccess"])){
		
		echo"<div class='alert alert-success'> 
		 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
		<h4 class='page-header'><i class='fa fa-check'></i> SUCCESS </h4>
				<p>".$_SESSION['categoryCreationSuccess']."</p>
				</div>"; 
				unset($_SESSION['categoryCreationSuccess']);
		}
		
		if(isset($_SESSION["assignmentCategoryError"])){
		
		echo"<div class='alert alert-warning'> 
		 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
		<h4 class='page-header'><i class='fa fa-warning'></i> ERROR</h4>";
			foreach($_SESSION["assignmentCategoryError"] AS $error){
				echo"<p>".$error."</p>";
			}
				echo"</div>"; 
				unset($_SESSION['assignmentCategoryError']);
		}


	
	?>
	<h5 style="border-bottom:1px solid #eee;line-height:180%" class='text-danger' ><i class='fa fa-pencil'></i> Create Assignment Category </h5><br>
	<form action="doCreateAssignmentCategory.php" method="POST">
		<div class="form-group">
			<label class="control-label col-sm-3">Category Name: </label>
		<div class="col-xs-12 col-sm-12 col-md-8">
			<input type="text" name="category" placeholder="Category Name E.g Science,English" class="form-control" /><br>
			<button type="submit" class="btn btn-sm purple-gradient">Create Category</button>
		</div>
	</div>
</form>
							
						
			 </div>
		</div>
	</div>
			 <br><br><br>
			 
<div class="footer" >
		<footer>
<p align="center"> <strong>&copy <?php echo date('Y');?>  Vinebranch School Management System </strong></p>
</footer>
</div>
</body>
</html>