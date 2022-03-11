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

	//echo $class_name;
}
if(isset($_GET['f_tr'])){
	$third_term=$_GET['f_tr'];
	
	
}
$subjects_name=array();
$first_term=array();
$second_term=array();

?>
<!DOCTYPE HTML>
<html>
<head><title>Create Third Term Cognitive Report </title>
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
<li class='breadcrumb-item'><a href="#"><i class="fa fa-home"></i>TEACHERS</a></li> 
<li class="breadcrumb-item"><i class='fa fa-dashboard'></i> DASHBOARD</li> 
<li class="breadcrumb-item">Create Third Term Cognitive Report</li>  
</ol><br>
<h5 style='border-bottom:1px solid #eee;line-height:180%'><i class="fa fa-edit"></i> Create Third Term Cognitive Report </h5><br>


<?php


if(isset($_SESSION['error'])){
	
	echo"<div class='alert alert-warning'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h5 style='border-bottom:1px solid #eee;line-height:180%'><i class='fa fa-warning'></i> ERROR</h5>
			<p>".$_SESSION['error']."</p>
			</div>"; 
			unset($_SESSION['error']);
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
			<img src='studentImages/{$results['student_img']}'  class='img-fluid rounded z-depth-2' alt='image'>
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
<?php 

if(!isset($_SESSION['success'])){
	echo"<form method='POST' action='do_third_term_cognitive.php'>
<div id='div_results'>
<div  class='col-sm-12 col-md-12 col-lg-12'>
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
<td><strong>3<sup>rd</sup> Term Scores</strong></td>
<td><strong>Avg Scores</strong></td>
<td><strong>GRADE 3<sup>rd</sup> Term</strong></td>
<td><strong>REMARKS</strong></td>
</tr>
<tr>
<td><strong>Obtainable Marks</strong></td>
<td align='center'>10</td>
<td align='center'>30</td>
<td align='center'>60</td>
<td align='center'>1stTerm Score</td>
<td align='center'>2ndTerm Score</td>
<td align='center'>100</td>
<td align='center'>Avg Score</td>
<td></td>
<td></td>
</tr>";

$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
if($conn->connect_error){
	die('could not connect to the database');
}
else{
		$i=1;
		$select="SELECT c.subject AS subject,f.total_score AS first_total_score,s.total_score AS second_total_score from subjects AS c INNER JOIN first_term AS f ON c.subject=f.subjects INNER JOIN second_term AS s ON f.subjects=s.subjects  WHERE s.class_name='$class_name' AND f.student_id='$student_id' AND  s.student_id='$student_id' GROUP BY s.subjects ";
		$query=$conn->query($select);
		$num_rows=$query->num_rows;
		while($results=$query->fetch_array(MYSQLI_ASSOC)){
			echo"<tr>
					<td>{$results['subject']}</td>
					<td><input type='text' id='other_CA$i' name='other_CA[]' onkeyup=check('$i') class='form-control' /></td>
					<td><input type='text' id='CA$i' onkeyup=ca_check('$i') name='CA[]' class='form-control' /></td>
					<td><input type='text' id='exam$i' name='EXAMS[]' onkeyup=exam_check('$i') class='form-control'/></td>";
						echo"
					<td align='center' id='first$i'>{$results['first_total_score']}</td>
					<td align='center' id='second$i'>{$results['second_total_score']}</td>";
					echo"<td><input type='text' id='score_thirdTerm$i' onfocus=custom('$i') onkeyup=check1('$i') name='score_thirdTerm[]' class='form-control'/></td>
					<td><input type='text' id='avg_thirdTerm$i' onfocus=avg('$i')  class='form-control scores' disabled /></td>
					<td><input type='text' id='grade_thirdTerm$i' class='form-control grades' disabled /></td>
					<td><input type='text' id='remarks$i'  class='form-control remarks' disabled /></td>
					</tr>";
					$subjects_name[]=$results['subject'];
					$first_term[]=$results['first_total_score'];
					$second_term[]=$results['second_total_score'];
					$i++;
					
			}
			$subjects_name=json_encode($subjects_name);
			$first_term=json_encode($first_term);
			$second_term=json_encode($second_term);
}
echo"
</table><br><br><br>
</div>
</div>
</div>
<input type='hidden' name='num_rows' id='$num_rows' value='{$subjects_name}' />
<input type='hidden' name='subject_name' value='{$subjects_name}' />
<input type='hidden' name='student_id' value='$student_id' />
<input type='hidden' name='class_name' value='$class_name' />
<input type='hidden' name='third_term' value='$third_term'/>
<input type='hidden'name='first_term' value='$first_term' />
<input type='hidden' name='second_term' value='$second_term' />
<input type='hidden' name='avg_thirdTerm[]' value='' id='score' />
<input type='hidden' name='grade_thirdTerm[]' value=''  id='grade'/>
<input type='hidden' name='remark[]' value='' id='remark' />
<button type='submit'  id='button' class='btn btn-md aqua-gradient'>SUBMIT</button>
</form>";
}
else{
	
	if(isset($_SESSION['success'])){
	
	echo"<div class='alert alert-success'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h5 style='border-bottom:1px solid #eee;line-height:180%'><i class='fa fa-check'></i> SUCCESS</h5>
			<p>".$_SESSION['success']."</p>
			</div>"; 
			unset($_SESSION['success']);
			echo"<button type='button' class='btn btn-sm btn-primary'><a href='third_term_compute_assessment.php?s_id=$student_id&c_name=$class_name&f_tr=$third_term' style='color:white'><i class='fa fa-angle-double-left'></i> BACK</a></button>

			<button type='button' class='btn btn-sm btn-success'><a href='third_term_observation_conduct_report.php?stud_id=$student_id&class_name=$class_name&f_tr=$third_term' style='color:white'> NEXT <i class='fa fa-angle-double-right'></i></a></button>";
				}
	
	
	
	

}

	?>
	
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
		alert("INVALID INPUT::ONLY NUMBER INTEGERS ARE ALLOWED IN THIS FIELD");
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
		alert("INVALID INPUT::ONLY NUMBER INTEGERS ARE ALLOWED IN THIS FIELD");
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
		alert("INVALID INPUT::ONLY NUMBER INTEGERS ARE ALLOWED IN THIS FIELD");
		this_id.value="";
	}
		custom(id);
}




function custom(id){
	var this_id=document.getElementById("score_thirdTerm"+id);
	var other_CA=document.getElementById("other_CA"+id).value;
	var CA=document.getElementById("CA"+id).value;
	var exam=document.getElementById("exam"+id).value;
	var term_scores=Number(other_CA)+Number(CA)+Number(exam);
	this_id.value=term_scores;
	var this_id_avg=document.getElementById("avg_thirdTerm"+id);
	var first_total_score=document.getElementById("first"+id).textContent;
	var second_total_score=document.getElementById("second"+id).textContent;
	var third_total_score=document.getElementById("score_thirdTerm"+id).value;
	var average_scores=(Number(first_total_score)+Number(second_total_score)+Number(third_total_score))/3;
	this_id_avg.value=average_scores.toFixed(1);
	
	if(Number(this_id_avg.value)>=80 && Number(this_id_avg.value)<=100){
		document.getElementById("grade_thirdTerm"+id).value="A";
		document.getElementById("grade_thirdTerm"+id).style['color']="blue";
		document.getElementById("remarks"+id).value="EXCELLENT";
		document.getElementById("remarks"+id).style['color']="blue";
	}
	if(Number(this_id_avg.value)>=60 && Number(this_id_avg.value)<80){
		document.getElementById("grade_thirdTerm"+id).value="B";
		document.getElementById("grade_thirdTerm"+id).style['color']="blue";
		document.getElementById("remarks"+id).value="VERY GOOD";
		document.getElementById("remarks"+id).style['color']="blue";
	}
	if(Number(this_id_avg.value)>=50 && Number(this_id_avg.value)<60){
		document.getElementById("grade_thirdTerm"+id).value="C";
		document.getElementById("grade_thirdTerm"+id).style['color']="blue";
		document.getElementById("remarks"+id).value="GOOD";
		document.getElementById("remarks"+id).style['color']="blue";
	}
	if(Number(this_id_avg.value)>=40 && Number(this_id_avg.value)<50){
		document.getElementById("grade_thirdTerm"+id).value="D";
		document.getElementById("grade_thirdTerm"+id).style['color']="blue";
		document.getElementById("remarks"+id).value="PASS";
		document.getElementById("remarks"+id).style['color']="blue";
	}
	if(Number(this_id_avg.value)>=35 && Number(this_id_avg.value)<40){
		document.getElementById("grade_thirdTerm"+id).value="E";
		document.getElementById("grade_thirdTerm"+id).style['color']=" brown";
		document.getElementById("remarks"+id).value="FAIR";
		document.getElementById("remarks"+id).style['color']="brown";
	}
	if(Number(this_id_avg.value)>=0 && Number(this_id_avg.value)<35){
		document.getElementById("grade_thirdTerm"+id).value="F";
		document.getElementById("grade_thirdTerm"+id).style['color']="red";
		document.getElementById("remarks"+id).value="FAIL";
		document.getElementById("remarks"+id).style['color']="red";
	}
}

/*function avg(id){
	var this_id=document.getElementById("avg_thirdTerm"+id);
	var first_total_score=document.getElementById("first"+id).textContent;
	var second_total_score=document.getElementById("second"+id).textContent;
	var third_total_score=document.getElementById("score_thirdTerm"+id).value;
	var average_scores=(Number(first_total_score)+Number(second_total_score)+Number(third_total_score))/3;
	this_id.value=average_scores.toFixed(1);
	
}*/
function check1(id){
	
	var this_id=document.getElementById(id);
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