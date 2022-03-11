<?php 

include_once("validate_user.php");
//include_once('functions.php');
if(isset($_GET['s_id'])){
	$student_id=$_GET['s_id'];
	
}
else{
	
		exit();
}
if(isset($_GET['c_name'])){
	$class_name=$_GET['c_name'];
	
}
if(isset($_GET['f_tr'])){
	$second_term=$_GET['f_tr'];
	
}
$subjects_name=array();
?>
<!DOCTYPE HTML>
<html>
<head><title>Compute Second Term Cognitive Report</title>
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
.footer{background:black;
color:white;
position:fixed;
bottom:0px;
width:100%;}
.link{text-decoration:none;color:white}
a:hover{text-decoration:none;color:black}
body{position:relative;}
.end_term{text-align:center!important}
.start_term{text-align:center!important}
.spacing{padding-top:0!important}
.conduct{padding-top:0!important}
</style>
</head>
<body>
<?php  validateUser::heading4();
//heading();?><br>
<div class="container">
<div class="rows">
<div class="col-xs-12 col-sm-12 col-md-lg col-lg-12">
<ol class="breadcrumb"> 
<li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i>TEACHERS</a></li> 
<li class="breadcrumb-item"><i class='fa fa-dashboard'></i> DASHBOARD</li> 
<li class="breadcrumb-item active">Compute Second Term Cognitive Report</li>  
</ol><br>
<h5 style='border-bottom:1px solid #eee;line-height:180%' class="page-header text-primary"><i class="fa fa-edit"></i> Compute Second Term Cognitive Report</h4><br>

<?php



if(isset($_SESSION['error'])){
	
	echo"<div class='alert alert-warning'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h5 style='border-bottom:1px solid #eee;line-height:180%'><i class='fa fa-warning'></i> ERROR</h5>
			<p>".$_SESSION['error']."</p>
			</div>"; 
			unset($_SESSION['error']);
}


if(isset($_SESSION['totalscore_error'])){
	
	echo"<div class='alert alert-warning'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h5 style='border-bottom:1px solid #eee;line-height:180%'><i class='fa fa-warning'></i> ERROR</h5>
			<p>".$_SESSION['totalscore_error']."</p>
			</div>"; 
			unset($_SESSION['totalscore_error']);
}

$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
if($conn->connect_error){
	die('could not connect to the database');
}
else{
		
		$select="SELECT student_name,class_name,sex,date_birth,student_img FROM students  WHERE student_id='$student_id'";
		$query=$conn->query($select);
		echo"<div class='row'>";
		while($results=$query->fetch_array(MYSQLI_ASSOC)){
		echo"
		<div class='col-sm-12 col-md-4 col-lg-4'>
			<img src='studentImages/{$results['student_img']}' class='img-fluid rounded z-depth-2'  alt='image'>
			<br><br>
		</div>
		<div class='col-sm-12 col-md-8 col-lg-8'>
			<h6><strong>STUDENT NAME:</strong> ".ucwords($results['student_name'])."</h6>
			<h6><strong>SEX:</strong> {$results['sex']}</h6>
			<h6><strong>AGE:</strong>";
			$current_timestamp=time();
									$current_year=date('Y',$current_timestamp);
									$birth_year=date('Y',strtotime($results['date_birth']));
									$age=$current_year-$birth_year;
									if($age>0){
									echo " $age yrs";
									}
									else{
										echo " $age yr";
									}
									echo"</h6>";
			echo"<h6><strong>CLASS:</strong> {$results['class_name']}</h6></div>";
		}
		echo"</div>";
}
	
	?>

		<br>
<div id='div_results'>
<div  class='col-sm-12 col-md-12 col-lg-12'>
<?php 
	if(!isset($_SESSION['success'])){
		echo"<form method='POST' action='do_second_term_cognitive.php'>
<h5 style='border-bottom:1px solid #eee;line-height:180%'><i class='fa fa-arrow-circle-right' style='color:red'></i> COGNITIVE RECORD</h5><br>
<div class='table-responsive'>
<table class='table-bordered table-striped'>
<tr>
<td><strong>SUBJECTS</strong></td>
<td><strong>other CA</strong></td>
<td><strong>CA</strong></td>
<td><strong>EXAMS</strong></td>
<td><strong>1<sup>st</sup> Term Scores</strong></td>
<td><strong>2<sup>nd</sup> Term Scores</strong></td>
<td><strong>GRADE 2<sup>nd</sup> Term</strong></td>
<td><strong>REMARKS</strong></td>
</tr>
<tr>
<td><strong>Obtainable Marks</strong></td>
<td align='center'>10</td>
<td align='center'>30</td>
<td align='center'>60</td>
<td align='center'>1stTerm Score</td>
<td align='center'>100</td>
<td></td>
<td></td>
</tr>";
$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
if($conn->connect_error){
	die('could not connect to the database');
}
else{
		$i=1;
		$select="SELECT c.subject AS subject,f.total_score AS total_score  from subjects AS c INNER JOIN first_term AS f ON c.subject=f.subjects WHERE c.class_name='$class_name' AND student_id='$student_id'";
		$query=$conn->query($select);
		$num_rows=$query->num_rows;
		while($results=$query->fetch_array(MYSQLI_ASSOC)){
			echo"<tr>
					<td>{$results['subject']}</td>
					<td><input type='text' id='other_CA$i' name='other_CA[]' onkeyup=check('$i') class='form-control' /></td>
					<td><input type='text' id='CA$i' onkeyup=ca_check('$i') name='CA[]' class='form-control' /></td>
					<td><input type='text' id='exam$i' name='EXAMS[]' onkeyup=exam_check('$i') class='form-control'/></td>";
						echo"
					<td align='center'><strong>{$results['total_score']}</strong></td>";
					
					echo"<td><input type='text' id='score_secondTerm$i' onfocus=custom('$i') onkeyup=check1('$i')  class='form-control scores general' disabled /></td>
					<td><input type='text' id='grade_secondTerm$i'  class='form-control grades general' disabled/></td>
					<td><input type='text' id='remarks$i'   class='form-control remarks general' disabled /></td>
					</tr>";
					$subjects_name[]=$results['subject'];
					$i++;
			}
			$subjects_name=json_encode($subjects_name);
}
echo"
</table>
</div>
<input type='hidden' name='num_rows' id='$num_rows' value='{$subjects_name}' />
<input type='hidden' name='subject_name' value='{$subjects_name}' />
<input type='hidden' name='student_id' value='$student_id' />
<input type='hidden' name='second_term' value='$second_term' />
<input type='hidden' name='class_name' value='$class_name' />
<input type='hidden' name='score_secondTerm[]' value='' id='score' />
<input type='hidden' name='grade_secondTerm[]' value=''  id='grade'/>
<input type='hidden' name='remarks[]' value='' id='remark' /><br><br>
<button type='submit' class='btn btn-md aqua-gradient' id='button'>SUBMIT</button>
</form>";


	}
	
else{
	
	
		
		if(isset($_SESSION['success'])){
	
	echo"<div class='alert alert-success'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h4 class='page-header'><i class='fa fa-check'></i> SUCCESS</h4>
			<p>".$_SESSION['success']."</p>
			</div>"; 
			unset($_SESSION['success']);
			echo"<button type='button' class='btn btn-sm btn-primary'><a href='second_term.php?s_id=$student_id &c_name=$class_name &f_tr=$second_term' style='color:white'><i class='fa fa-angle-double-left'></i> BACK</a></button>

			<button type='button' class='btn btn-sm btn-success'><a href='second_term_observation_conduct_report.php?s_id=$student_id &c_name=$class_name &f_tr=$second_term' style='color:white'> NEXT <i class='fa fa-angle-double-right'></i></a></button>";
				}
	
	
	
	
	
}
	
	?>
	<br><br><br>
</div>
</div>
<!----End First Term---->
			</div>
			 </div>
			 </div><br><br><br>
<div class="footer">
		<footer>
<p align="center"> <strong>&copy  <?php echo''.date("Y").'';?> Vinebranch School Management System </strong></p>
</footer>
<script type="text/javascript">
$(document).ready(function(){
	var status=false;
	$('input[type="text"]').focus(function(){
			$('button').attr('disabled',false);
		});
		
	$('#button').on('click',function(){
		
		var classScores=$('.scores');
		var grades=$('.grades');
		var remarks=$('.remarks');
		var scoresArray=[];
		var gradesArray=[];
		var remarksArray=[];
		
		for(var i=0; i<classScores.length;i++){
			scoresArray.push($(classScores[i]).val());
			gradesArray.push($(grades[i]).val());
			remarksArray.push($(remarks[i]).val());
			
			
	}
		$('#score').val(scoresArray);
		$('#grade').val(gradesArray);
		$('#remark').val(remarksArray);
		
		$("input[type='text']").each(function(){
			if(($(this).val())==""){
				status=true;
				$('button').attr('disabled',true);
				
			}
			
			
		});
		if(status!=false){
			alert("ALL INPUT FIELDS MUST BE FILLED OUT");
			status=false;
			}
		});
	
	});
function check(id){
	
	var this_id=document.getElementById('other_CA'+id);
	var this_value=parseInt(this_id.value);
	if(this_value>10){
		alert("SCORE VALUE CAN NOT BE GREATER THAN 10");
		this_id.value="";
		}
	
	if(Number.isInteger(this_value)==false){
		
		alert("INVALID TYPE::ONLY NUMBER INTEGERS ARE ALLOWED IN THIS FIELD");
		this_id.value="";
		
	}
	
	custom(id);
}
	function ca_check(id){
	
	var this_id=document.getElementById('CA'+id);
	var this_value=parseInt(this_id.value);
	if(this_value>30){
		alert("CA SCORE CANNOT BE GREATER THAN 30");
		this_id.value="";
		}
	if(Number.isInteger(this_value)==false){
		
		alert("INVALID TYPE::ONLY NUMBER INTEGERS ARE ALLOWED IN THIS FIELD");
		this_id.value="";
		
	}
	
	custom(id);
	
}

function exam_check(id){
	
	var this_id=document.getElementById('exam'+id);
	var this_value=parseInt(this_id.value);
	if(this_value>60){
		alert("EXAM SCORE  CANNOT BE GREATER THAN 60");
		this_id.value="";
		}
	if(Number.isInteger(this_value)==false){
		
		alert("INVALID TYPE::ONLY NUMBER INTEGERS ARE ALLOWED IN THIS FIELD");
		this_id.value="";
		
	}
	
	custom(id);
}


function custom(id){
	var this_id=document.getElementById("score_secondTerm"+id);
	var other_CA=document.getElementById("other_CA"+id).value;
	var CA=document.getElementById("CA"+id).value;
	var exam=document.getElementById("exam"+id).value;
	var term_scores=Number(other_CA)+Number(CA)+Number(exam);
	this_id.value=term_scores;
	if(Number(this_id.value)>=80 && Number(this_id.value)<=100){
		document.getElementById("grade_secondTerm"+id).value="A";
		document.getElementById("grade_secondTerm"+id).style['color']="blue";
		document.getElementById("remarks"+id).value="EXCELLENT";
		document.getElementById("remarks"+id).style['color']="blue";
	}
	if(Number(this_id.value)>=60 && Number(this_id.value)<80){
		document.getElementById("grade_secondTerm"+id).value="B";
		document.getElementById("grade_secondTerm"+id).style['color']="blue";
		document.getElementById("remarks"+id).value="VERY GOOD";
		document.getElementById("remarks"+id).style['color']="blue";
	}
	if(Number(this_id.value)>=50 && Number(this_id.value)<60){
		document.getElementById("grade_secondTerm"+id).value="C";
		document.getElementById("grade_secondTerm"+id).style['color']="blue";
		document.getElementById("remarks"+id).value="GOOD";
		document.getElementById("remarks"+id).style['color']="blue";
	}
	if(Number(this_id.value)>=40 && Number(this_id.value)<50){
		document.getElementById("grade_secondTerm"+id).value="D";
		document.getElementById("grade_secondTerm"+id).style['color']="blue";
		document.getElementById("remarks"+id).value="PASS";
		document.getElementById("remarks"+id).style['color']="blue";
	}
	if(Number(this_id.value)>=35 && Number(this_id.value)<40){
		document.getElementById("grade_secondTerm"+id).value="E";
		document.getElementById("grade_secondTerm"+id).style['color']=" brown";
		document.getElementById("remarks"+id).value="FAIR";
		document.getElementById("remarks"+id).style['color']="brown";
	}
	if(Number(this_id.value)>=0 && Number(this_id.value)<35){
		document.getElementById("grade_secondTerm"+id).value="F";
		document.getElementById("grade_secondTerm"+id).style['color']="red";
		document.getElementById("remarks"+id).value="FAIL";
		document.getElementById("remarks"+id).style['color']="red";
	}
}
function check1(id){
	
	var this_id=document.getElementById("score_secondTerm"+id);
	var this_value=this_id.value;
	if(this_value>100){
		alert("SCORE VALUE CAN NOT BE GREATER THAN 100");
		this_id.value="0";
		}
	
	
}
</script>
<script>
$(document).ready(function(){
	$('.datepicker').datepicker();
});
		</script>
</body>
</html>
</body>
</html>