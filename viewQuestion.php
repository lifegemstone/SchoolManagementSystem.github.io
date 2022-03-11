<?php 
//include_once('C:/wamp/dbconn_vbsms.php');
include_once('validate_user.php');
//include_once('functions.php');
$error=array();
$returnedOptions=array();
$returnedAnswers=array();
if(isset($_GET['q_id'])){
	$questionId=$_GET['q_id'];
}
if(isset($_GET['c_name'])){
	$categoryName=$_GET['c_name'];
}
$usr_email=validateUser::get_email();
$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
if($conn->connect_error) die("Could not connect to the database");
else{
		$selectQuestions="SELECT * FROM questions WHERE question_id=?";
		$stmt=$conn->prepare($selectQuestions);
		$stmt->bind_param("i",$questionId);
		$stmt->execute();
		$result=$stmt->get_result();
		if($result->num_rows==0){
				$error["noData"]=true;
				$error["errorMsg"]="<span class='text-danger'>Sorry Question Not Found. Please Try Again!!!</span>";
			
		}
		elseif($result->num_rows>0){
					$returnedData=$result->fetch_array(MYSQLI_ASSOC);
					$question=$returnedData["question"];
					$questionType=$returnedData["question_type"];
					$points=$returnedData["points"];
		}
		$stmt->close();
		
		$selectOptions="SELECT * FROM question_options WHERE question_id=?";
		$stmt=$conn->prepare($selectOptions);
		$stmt->bind_param("i",$questionId);
		$stmt->execute();
		$result=$stmt->get_result();
		if($result->num_rows==0){
			$error["noData"]=true;
			$error["errorMsg"]="<span class='text-danger'>Sorry No Options Exsits For This Question </span>";
		}
		elseif($result->num_rows>0){
			while($returnedData=$result->fetch_array(MYSQLI_ASSOC)){
				$returnedOptions[]=$returnedData;
			}
		}
		$stmt->close();
		
		
		$selectAnswer="SELECT answer FROM question_answers WHERE question_id=?";
		$stmt=$conn->prepare($selectAnswer);
		$stmt->bind_param("i",$questionId);
		$stmt->execute();
		$result=$stmt->get_result();
		if($result->num_rows==0){
			$error["noData"]=true;
			$error["errorMsg"]="<span class='text-danger'>Sorry No Answer Exsits For This Question </span>";
		}
		elseif($result->num_rows>0){
		while($returnedData=$result->fetch_array(MYSQLI_ASSOC)){
				$returnedAnswers[]=$returnedData['answer'];
				//print_r($returnedData);
			}
		}
		$stmt->close();
}
?>
<!DOCTYPE HTML>
<html>
<head><title>View Question</title>
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
a:hover{text-decoration:none;color:red}
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
<li class="breadcrumb-item"><a href="#"><i class="fa fa-pencil"></i> View Question</a></li> 
</ol>
	<br>	
	<h5 style="border-bottom:1px solid #eee;line-height:180%" class='text-danger' ><?PHP echo "<span class='text-primary'><i class='fa fa-list'></i> Category::</span> $categoryName";?></h5><br>
	<?PHP 
	
			echo"<p><i class='fa fa-tags'></i> Question Type: <span class='text-primary'>$questionType</span></p>
			<p><i class='fa fa-tags'></i> Points: <span class='text-primary'>$points</span></p>
			<p><i class='fa fa-tags'></i> Question : <span class='text-primary'>$question</span> <a href='editQuestion.php?q_id=$questionId'><i class='fa fa-pencil'></i> Edit</a></p>
			<p><i class='fa fa-bullseye'></i> Options:";
				foreach($returnedOptions AS $option){
					if(in_array($option['options'],$returnedAnswers)){
						$answer="<span class='text-success'>Correct Answer</span>";
					}
					else{ 
							$answer=null;
					}
					echo"<li>{$option['options']}";
						if($answer !=null){
							echo"($answer)";
						}
						echo" <a href='editOptions.php?optn_id=".$option['option_id']."'><i class='fa fa-pencil'></i> Edit</a></li>";
					}
					echo"</p>";
					//print_r($returnedAnswers);
			
			
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