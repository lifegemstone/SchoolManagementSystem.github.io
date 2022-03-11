<?php

include_once("validate_user.php");
//include_once('functions.php');
$scores=array();
if(isset($_POST['student_id'])){
	$student_id=$_POST['student_id'];
}
if(isset($_POST['term'])){
	$term_stat=$_POST['term'];
}
if(isset($_POST['class_name'])){
	$class_name=$_POST['class_name'];
}


$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
if($conn->connect_error){
	die('could not connect to the database');
}
else{
			if($term_stat=="1st Term"){
			$select1="SELECT * FROM first_term WHERE student_id='$student_id'";
			$query1=$conn->query($select1);
			}
			elseif($term_stat=="2nd Term"){
				
			$select1="SELECT * FROM second_term WHERE student_id='$student_id'";
			$query1=$conn->query($select1);
				
			}
			elseif($term_stat=="3rd Term"){
				
			$select1="SELECT * FROM third_term WHERE student_id='$student_id'";
			$query1=$conn->query($select1);
				
				
				
			}
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width initial-scale=1">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.css" rel="stylesheet" type="text/css">
<link href="css/eportalstyle.css" rel="stylesheet" type="text/css">
<link href="css/sb-admin-2.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="dist/css/bootstrap-datepicker.css"/>
  <link href="css/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
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
td#recommend{text-align:center}
</style>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/bootstrap.js"></script>
<script  src="dist/js/bootstrap-datepicker.js"></script>
<script src="datatables/js/jquery.dataTables.min.js"></script>
<script src="datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="datatables-responsive/dataTables.responsive.js"></script>
<script type='text/javascript'>
google.charts.load('current',{packages: ['corechart','bar']});
google.charts.setOnLoadCallback(drawMaterial);

function drawMaterial(){
	var data=google.visualization.arrayToDataTable([
	["subjects","scores"],
	<?php
	
		while($results1=$query1->fetch_array(MYSQLI_NUM)){
			$subject=$results1[1];
			if($term_stat=="3rd Term"){
				$score=$results1[10];
			}
			else{
			$score=$results1[5];
			}
				echo'["'.$subject.'",'.$score.'],';
			
		}
		?>
		]);
		var options={
			chart: {
			title:"Student Performance Chart",
			},
			width:900,
			height:600,
			bars:'vertical',
			

		};
		var material=new google.charts.Bar(document.getElementById('barchart'));
		material.draw(data, options);
}
</script>
</head>
<body>
<?php  validateUser::heading2();
//heading();?>
<div class="container">
<div class="rows">
<div class="col-xs-12 col-sm-12 col-md-lg col-lg-12">
<form method="POST" action="do_firstTerm.php">
<ol class="breadcrumb"> 
<li><a href="#"><i class="fa fa-home"></i>TEACHERS</a></li> 
<li class=""><i class='fa fa-dashboard'></i> DASHBOARD</li> 
<li class="active">Peformance Analysis</li>  
</ol>
<h4 class="page-header text-primary"><i class="fa fa-edit"></i> Performance Analysis for <?php echo $term_stat;?></h4>

</head>
<body>
<div id="barchart" width="100%">
</div>
<?php
$select2="SELECT COUNT(subject) AS subjects FROM subjects WHERE class_name='$class_name'";
$query2=$conn->query($select2);
$results2=$query2->fetch_array(MYSQLI_ASSOC);
echo "<p><i class='fa fa-book text-primary'></i> <strong>Number of Subjects Offered:</strong> {$results2['subjects']}</p>";


$select3="SELECT COUNT(student_id) AS num_pupils FROM students WHERE class_name='$class_name'";
$query3=$conn->query($select3);
if($results3=$query3->fetch_array(MYSQLI_ASSOC)){
	$num_pupils=$results3['num_pupils'];
}

$total_score=100*$results2['subjects'];
$select5="SELECT totalscore FROM totalscore WHERE term='$term_stat' AND class_name='$class_name' ";
$query5=$conn->query($select5);
while($results5=$query5->fetch_array(MYSQLI_ASSOC)){
	$scores[]=$results5['totalscore'];
}

rsort($scores);
$select6="SELECT totalscore FROM totalscore WHERE student_id='$student_id' AND class_name='$class_name' AND term='$term_stat'";
$query6=$conn->query($select6);
if($query6->num_rows>0){
		if($results6=$query6->fetch_array(MYSQLI_ASSOC)){
			$student_totalScore=$results6['totalscore'];
			$key=array_search("$student_totalScore",$scores);
			$position=$key+1;
			
		}
}
else{
		$student_totalScore=0;
		$position="N/A";

}	
	$new_key=substr("$position",-1);
	if($new_key==1){
		$position .="st";
	}
	if($new_key==2){
		$position .="nd";
	}
	if($new_key==3){
		$position .="rd";
	}
	if($new_key>3){
		$position .="th";
	}
	
	$percent_score=round(($student_totalScore/$total_score)*100);
	
echo"<p>
			<i class='fa fa-users text-primary'></i> <strong>Number of Pupils in Class</strong>: $num_pupils</p>
			<i class='fa fa-sort-amount-asc text-primary'></i> <strong>Performance Position</strong>: $position</p>
			<p><span class='text-primary'>%</span> <strong>Percent Score:</strong> $percent_score%</p>";
			if($term_stat=="1st Term"){
				echo"<p><span class='text-primary'><i class='fa fa-calendar'></i> </span> <strong>Student Attendance 1st term:</strong>";
				$select7="SELECT SUM(attendance_rating) AS rating FROM attendance WHERE student_id='$student_id' AND term='First Term'";
			}
			if($term_stat=="2nd Term"){
				echo"<p><span class='text-primary'><i class='fa fa-calendar'></i> </span> <strong>Student Attendance 2nd term:</strong>";
				$select7="SELECT SUM(attendance_rating) AS rating FROM attendance WHERE student_id='$student_id' AND term='Second Term'";
			}
			if($term_stat=="3rd Term"){
				echo"<p><span class='text-primary'><i class='fa fa-calendar'></i> </span> <strong>Student Attendance 3rd term:</strong>";
				$select7="SELECT SUM(attendance_rating) AS rating FROM attendance WHERE student_id='$student_id' AND term='Third Term'";
			}
							$query7=$conn->query($select7);
					$rating=$query7->fetch_array(MYSQLI_ASSOC);//Note confirm the number of months used by schools per month
									echo'<div class="progress">';
									if($rating['rating']<25){
										echo'
									<div class="progress-bar progress-bar-striped progress-bar-danger" role="progressbar" style="width:'.round($rating['rating']).'%;" aria-valuenow="'.round($rating['rating']).'" aria-valuemin="0" aria-valuemax="100">'.round($rating['rating']).'%</div>';
									}
									elseif($rating['rating']>=25 && $rating['rating']<50){
										echo'<div class="progress-bar progress-bar-striped progress-bar-info" role="progressbar" style="width:'.round($rating['rating']).'%;" aria-valuenow="'.round($rating['rating']).'" aria-valuemin="0" aria-valuemax="100">'.round($rating['rating']).'%</div>';
									}
									elseif($rating['rating']>=50){
										echo'<div class="progress-bar progress-bar-striped progress-bar-success" role="progressbar" style="width:'.round($rating['rating']).'%;" aria-valuenow="'.round($rating['rating']).'" aria-valuemin="0" aria-valuemax="100">'.round($rating['rating']).'%</div>';
									}
									echo"</div></p>";
?>
<h4 class='page-header text-primary'><i class='fa fa-pencil'></i> RECOMMENDATION</h4>
<?php
			if($term_stat=="1st Term"){
			$select1="SELECT * FROM first_term WHERE student_id='$student_id'";
			$query1=$conn->query($select1);
			echo"<table class='table-bordered table-striped'>
			<tr><td><strong>SUBJECTS</strong></td>
			<td><strong>SCORE</strong></td>
			<td id='recommend'><strong>RECOMMENDATION</strong></td></tr>";
			while($results1=$query1->fetch_array(MYSQLI_ASSOC)){
				if(($results1['total_score'] >=91) &&($results1['total_score'] <=100)){
						echo"<tr><td>{$results1['subjects']}</td>
							<td align='center'><span style='color:blue'>{$results1['total_score']}</span></td>
							<td class='text-success'>Outstanding Performance. Student should keep it up<tr>";
						
					}
				elseif(($results1['total_score'] >=80) &&($results1['total_score'] <=90)){
						echo"<tr><td>{$results1['subjects']}</td>
							<td align='center'><span style='color:blue'>{$results1['total_score']}</span></td>
							<td class='text-success'>Excellent Performance. Student needs to be encouraged to keep up with this performance.<tr>";
						
					}
					elseif(($results1['total_score'] >=71) &&($results1['total_score'] <=79)){
						echo"<tr><td>{$results1['subjects']}</td>
							<td align='center'><span style='color:blue'>{$results1['total_score']}</span></td>
							 <td class='text-success'>Very Good Performance. Student can still do much better.<tr>";
						
					}
					elseif(($results1['total_score'] >=65) &&($results1['total_score'] <=70)){
						echo"<tr><td>{$results1['subjects']}</td>
							<td align='center'><span style='color:blue'>{$results1['total_score']}</span></td>
							<td class='text-success'>Good Performance. Student can still improve if extra concentration and monitoring is placed on student.
						<tr>";
						
					}
					elseif(($results1['total_score'] >=50) &&($results1['total_score'] <=64)){
						echo"<tr><td>{$results1['subjects']}</td>
								<td align='center'><span style='color:blue'>{$results1['total_score']}</span></td>
								<td>Average Performance. Assistance is needed and extra concentration/adequate monitoring should be placed on student to improve student performance in this subject  
							<br>Other considerations;
							<ol><li>Extra coaching</li>
								<li>Extra Parential follow up at home</li></ol></td><tr>";
					
						
					}
					
					elseif(($results1['total_score'] >=0) &&($results1['total_score'] <=49)){
						echo"<tr><td>{$results1['subjects']}</td>
							<td align='center'><span style='color:red'>{$results1['total_score']}</span></td>
							<td class='text-success'>More Assistance is needed and extra concentration/adequate monitoring should be placed on student to improve student performance in this subject  </td>
							<br>Other considerations;
							<ol><li>Extra coaching</li>
								<li>Counselling</li>
								<li>Extra Parential follow up at home</li></ol></td>
						
						<tr>";
						
					}
				
				}
				echo"</table>";
				
			}
			elseif($term_stat=="2nd Term"){
				
			$select1="SELECT * FROM second_term WHERE student_id='$student_id'";
			$query1=$conn->query($select1);
			echo"<table class='table-bordered table-striped'>
			<tr><td><strong>SUBJECTS</strong></td>
			<td><strong>SCORE</strong></td>
			<td align='center'><strong>RECOMMENDATION</strong></td></tr>";
			while($results1=$query1->fetch_array(MYSQLI_ASSOC)){
				
					if(($results1['total_score'] >=91) &&($results1['total_score'] <=100)){
						echo"<tr><td>{$results1['subjects']}</td>
							<td align='center'><span style='color:blue'>{$results1['total_score']}</span></td>
							<td class='text-success'>Outstanding Performance. Student should keep it up<tr>";
						
					}
				elseif(($results1['total_score'] >=80) &&($results1['total_score'] <=90)){
						echo"<tr><td>{$results1['subjects']}</td>
							<td align='center'><span style='color:blue'>{$results1['total_score']}</span></td>
							<td class='text-success'>Excellent Performance. Student needs to be encouraged to keep up with this performance.<tr>";
						
					}
					elseif(($results1['total_score'] >=71) &&($results1['total_score'] <=79)){
						echo"<tr><td>{$results1['subjects']}</td>
							<td align='center'><span style='color:blue'>{$results1['total_score']}</span></td>
							 <td class='text-success'>Very Good Performance. Student can still do much better.<tr>";
						
					}
					elseif(($results1['total_score'] >=65) &&($results1['total_score'] <=70)){
						echo"<tr><td>{$results1['subjects']}</td>
							<td align='center'><span style='color:blue'>{$results1['total_score']}</span></td>
							<td class='text-success'>Good Performance. Student can still improve if extra concentration and monitoring is placed on student.
						<tr>";
						
					}
					elseif(($results1['total_score'] >=50) &&($results1['total_score'] <=64)){
						echo"<tr><td>{$results1['subjects']}</td>
								<td align='center'><span style='color:blue'>{$results1['total_score']}</span></td>
								<td>Average Performance. Assistance is needed and extra concentration/adequate monitoring should be placed on student to improve student performance in this subject  
							<br>Other considerations;
							<ol><li>Extra coaching</li>
								<li>Extra Parential follow up at home</li></ol></td><tr>";
					
						
					}
					
					elseif(($results1['total_score'] >=0) &&($results1['total_score'] <=49)){
						echo"<tr><td>{$results1['subjects']}</td>
							<td align='center'><span style='color:red'>{$results1['total_score']}</span></td>
							<td class='text-success'>More Assistance is needed and extra concentration/adequate monitoring should be placed on student to improve student performance in this subject  </td>
							<br>Other considerations;
							<ol><li>Extra coaching</li>
								<li>Counselling</li>
								<li>Extra Parential follow up at home</li></ol></td>
						
						<tr>";
						
					}
				
				}
				echo"</table>";
				
				
				
			}
			elseif($term_stat=="3rd Term"){
				
			$select1="SELECT * FROM third_term WHERE student_id='$student_id'";
			$query1=$conn->query($select1);
				
				echo"<table class='table-bordered table-striped'>
			<tr><td><strong>SUBJECTS</strong></td>
			<td><strong>SCORE</strong></td>
			<td align='center'><strong>RECOMMENDATION</strong></td></tr>";
			while($results1=$query1->fetch_array(MYSQLI_ASSOC)){
				if(($results1['total_score'] >=91) &&($results1['total_score'] <=100)){
						echo"<tr><td>{$results1['subjects']}</td>
							<td align='center'><span style='color:blue'>{$results1['total_score']}</span></td>
							<td class='text-success'>Outstanding Performance. Student should keep it up<tr>";
						
					}
				elseif(($results1['total_score'] >=80) &&($results1['total_score'] <=90)){
						echo"<tr><td>{$results1['subjects']}</td>
							<td align='center'><span style='color:blue'>{$results1['total_score']}</span></td>
							<td class='text-success'>Excellent Performance. Student needs to be encouraged to keep up with this performance.<tr>";
						
					}
					elseif(($results1['total_score'] >=71) &&($results1['total_score'] <=79)){
						echo"<tr><td>{$results1['subjects']}</td>
							<td align='center'><span style='color:blue'>{$results1['total_score']}</span></td>
							 <td class='text-success'>Very Good Performance. Student can still do much better.<tr>";
						
					}
					elseif(($results1['total_score'] >=65) &&($results1['total_score'] <=70)){
						echo"<tr><td>{$results1['subjects']}</td>
							<td align='center'><span style='color:blue'>{$results1['total_score']}</span></td>
							<td class='text-success'>Good Performance. Student can still improve if extra concentration and monitoring is placed on student.
						<tr>";
						
					}
					elseif(($results1['total_score'] >=50) &&($results1['total_score'] <=64)){
						echo"<tr><td>{$results1['subjects']}</td>
								<td align='center'><span style='color:blue'>{$results1['total_score']}</span></td>
								<td>Average Performance. Assistance is needed and extra concentration/adequate monitoring should be placed on student to improve student performance in this subject  
							<br>Other considerations;
							<ol><li>Extra coaching</li>
								<li>Extra Parential follow up at home</li></ol></td><tr>";
					
						
					}
					
					elseif(($results1['total_score'] >=0) &&($results1['total_score'] <=49)){
						echo"<tr><td>{$results1['subjects']}</td>
							<td align='center'><span style='color:red'>{$results1['total_score']}</span></td>
							<td class='text-success'>More Assistance is needed and extra concentration/adequate monitoring should be placed on student to improve student performance in this subject  </td>
							<br>Other considerations;
							<ol><li>Extra coaching</li>
								<li>Counselling</li>
								<li>Extra Parential follow up at home</li></ol></td>
						
						<tr>";
						
					}
				
				}
				echo"</table>";
				
			}
?>
<br><br><br>
</body>
</html>