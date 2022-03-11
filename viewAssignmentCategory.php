<?php 
//include_once('C:/wamp/dbconn_vbsms.php');
include_once('validate_user.php');
//include_once('functions.php');

if(isset($_GET['cat_id'])){
	$cat_id=$_GET['cat_id'];
}
$usr_email=validateUser::get_email();
$id=1;

$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
if($conn->connect_error) die("Could not connect to the database");
$select="SELECT * FROM assignment_category WHERE category_id='$cat_id'";
$query=$conn->query($select);
$queryResult=$query->fetch_array(MYSQLI_ASSOC);
$category_name=$queryResult['category_name'];
$selectQuestions="SELECT * FROM questions WHERE cat_id='$cat_id'";
$queryQuestions=$conn->query($selectQuestions);
$totalQuestionsInCategory=$queryQuestions->num_rows;
?>
<!DOCTYPE HTML>
<html>
<head><title>View Categories</title>
<meta name="viewport" content="width=device-width initial-scale=1">
<link href="MDB-Free_4.7.1/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.css" rel="stylesheet" type="text/css">
<link href="MDB-Free_4.7.1/css/mdb.min.css" rel="stylesheet" type="text/css">
<link href="MDB-Free_4.7.1/css/style.css" rel="stylesheet" type="text/css">
<link href="css/eportalstyle.css" rel="stylesheet" type="text/css">
<link href="css/sb-admin-2.css" rel="stylesheet" type="text/css">
  <link href="css/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
	
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
<li class="breadcrumb-item"><a href="#"><i class="fa fa-pencil"></i> View Categories </a></li> 
</ol>
	<br>	
	<h5 style="border-bottom:1px solid #eee;line-height:180%" class='text-danger' ><?PHP echo "<span class='text-primary'><i class='fa fa-list'></i> Category::</span> $category_name";?></h5><br>
	<?PHP echo"<p><i class='fa fa-tags'></i> Questions in Category: <span class='text-primary'>$totalQuestionsInCategory</span></p>";
			
			
							echo'<table width="100%" class="table table-striped table-bordered table-hover" id="dataTable">
									<thead>
                                    <tr> 
                                        <th> S/N </th>
										<th>Questions</th>
										<th>View Question</th>
										<th>Delete Category</th>											
                                    </tr>
                                </thead>
                                <tbody>';
						while($queryQuestionsResults=$queryQuestions->fetch_array(MYSQLI_ASSOC)){
							echo '<tr>
                                  <td>'.$id.'</td>
								   <td>'.$queryQuestionsResults['question'].'</td>
									<td align="center"><a href="viewQuestion.php?q_id='.$queryQuestionsResults['question_id'].'&c_name='.$category_name.'">View</a></td>
									<td><a href="deleteQuestion.php?q_id='.$queryQuestionsResults['question_id'].'"><i class="fa fa-trash"></i> </a></td>
									
						 </tr>';
						$id++;}
                                
                               echo" </tbody>
								
                            </table>"; 
?>							
   			
			 </div>
		</div>
	</div>
			 <br><br><br>
			 
<div class="footer" >
		<footer>
<p align="center"> <strong>&copy <?php echo date('Y');?>  Vinebranch School Management System </strong></p>
</footer>
</div>
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
</body>
</html>