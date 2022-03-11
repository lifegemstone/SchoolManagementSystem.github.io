<?php
include_once("includeFunction.php");
//include_once("validate_user.php");
include_once('functions.php');
$scores=array();
if(isset($_GET['stud_id'])){
	$student_id=$_GET['stud_id'];
}
if(isset($_GET['class_name'])){
	$class_name=$_GET['class_name'];
}
if(isset($_GET['s_yr'])&&isset($_GET['e_yr'])){
	$start_year=$_GET['s_yr'];
	$end_year=$_GET['e_yr'];
	
}
else{
	
		$now=time();
		$start_year=date('Y',$now);
		$end_year=$start_year+1;
}
$params=array();
$grades=array();
$subjects=array();
$other_CA=array();
$CA=array();
$exams=array();
$secondterm_score=array();
$secondterm_grade=array();
$remark1=array();
$total_studentScore=0;
$firstTermTotalScore=array();
?>
<!DOCTYPE HTML>
<html>
<head><title>Generic:: Reports</title>
<meta name="viewport" content="width=device-width initial-scale=1">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.css" rel="stylesheet" type="text/css">
<link href="css/eportalstyle.css" rel="stylesheet" type="text/css">
<link href="css/sb-admin-2.css" rel="stylesheet" type="text/css">
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
td{}
</style>
</head>
<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="printarea/js/jquery.printarea.js" type="text/JavaScript"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	$("#printButton1").click(print1);
	
});
	function print1(){
		var mode='iframe';
var close=mode=='popup';
var options={mode:mode,popClose:close};
$("div.printableArea1").printArea(options);
		
	};
</script>
<a href="#"  id="printButton1"><i class='fa fa-print' style="font-size:2em"></i> Print Result</a>
<div class='printableArea1'>
<h2 align="center">VINEBRANCH FOUNDATION SCHOOL</h2>
<p align="center"> Mokola Road</p>
<div align="center"><label  class="label label-md label-default" style="font-size:1.3em">REPORT SHEET</label></div><br>
<p align='center'><strong>Session<?php echo"$start_year/$end_year" ;?></strong></p>

<br><br>
<?php

$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
if($conn->connect_error){
	die('could not connect to the database');
}
else{
	$select1="SELECT * FROM other_params WHERE student_id='$student_id' AND term='2nd Term' AND class_name='$class_name'";
	$query=$conn->query($select1);
	echo"<div class='container'>
	<div class='rows'>
	<div class='col-sm-12 col-md-12 col-lg-12'>";
	while($results=$query->fetch_array(MYSQLI_ASSOC)){
		echo"<div class='col-xs-4 col-sm-4 col-md-4 col-lg-4'>
		<h6 class='text-danger'>ATTENDANCE RECORD</h6>
		<table class='table table-bordered'>
			<tr>
				<th>No of times School Opened</th>
				<th>No of times Present</th>
				<th>No of times School Absent</th>
			</tr>
			<tr>
				<td>{$results['times_schOpen']}</td>
				<td>{$results['times_present']}</td>
				<td>{$results['times_absent']}</td>
			</tr>
		</table>
		</div>
		<div class='col-xs-4 col-sm-4 col-md-4 col-lg-4'>
		<h6 class='text-danger'>CALENDAR</h6>
		<table class='table table-bordered'>
			<tr>
				<th>Begining of Term</th>
				<th>End of Term</th>
				<th>Teachers Comment</th>
			</tr>
			<tr>
				<td>{$results['term_begins']}</td>
				<td>{$results['term_ends']}</td>
				<td class='text-primary'>".ucwords($results['teachers_comment'])."</td>
			</tr>
		</table>
		</div>
		<div class='col-xs-4 col-sm-4 col-md-4 col-lg-4'>
		<h6 class='text-danger'> HEALTH & PHYSICAL DEVELOPMENT</h6>
		<table class='table table-bordered'>
			<tr>
	<th>HEIGHT</th>
	<th>WEIGHT</th>
</tr>
<tr>
<th class='start_term' colspan='2'>Beginning Of Term</th></tr>
<tr>
	<td>{$results['height_start']}m</td>
	<td>{$results['weight_start']}kg</td>
</tr>
<tr>
<th colspan='2' class='end_term'>End Of Term</th></tr>
<tr>
	<td>{$results['height_end']}m</td>
	<td>{$results['weight_end']}kg</td>
</tr>
		</table>
		</div>";
	}
		
echo"<div class='col-sm-12 col-md-12 col-lg-12'>
		<table class='table-bordered'>
			<tr>
					<td colspan='2'><strong>OBSERVATION ON CONDUCT</strong></td>
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
					<td colspan='2'>Rating Key <strong>A=Excellent B=Good C=fair D=weak</strong></td>
					<td><strong>Obtainable Marks</strong></td>
					<td align='center'>10</td>
					<td align='center'>30</td>
					<td align='center'>60</td>
					<td align='center'></td>
					<td align='center'>100</td>
					<td></td>
					<td></td>
			</tr>";
			$select2="SELECT * FROM observation_conduct_grades WHERE student_id='$student_id' AND class_name='$class_name' AND term='2nd term'";
		$query2=$conn->query($select2);
		while($results2=$query2->fetch_array(MYSQLI_ASSOC)){
				$params[]=$results2['params'];
				$grades[]=$results2['grade'];
		}
			$select3="SELECT s.subjects AS subjects,s.other_CA as other_CA,s.CA as CA,s.exams as exams,s.total_score as total_score,s.grade as grade,s.remark as remark,f.total_score AS firstTermTotalScore  from second_term AS s INNER JOIN first_term AS f ON s.subjects=f.subjects WHERE s.class_name='$class_name' AND f.student_id='$student_id' AND s.student_id='$student_id' AND s.start_year='$start_year' AND s.end_year='$end_year' ";
			$query3=$conn->query($select3);
		while($results3=$query3->fetch_array(MYSQLI_ASSOC)){
					$subjects[]=$results3['subjects'];
					$other_CA[]=$results3['other_CA'];
					$CA[]=$results3['CA'];
					$exams[]=$results3['exams'];
					$secondterm_score[]=$results3['total_score'];
					$secondterm_grade[]=$results3['grade'];
					$remark1[]=$results3['remark'];
					$firstTermTotalScore[]=$results3['firstTermTotalScore'];
	}
	$count=sizeof($params);
	
	for($i=0;$i<$count;$i++){
		echo"<tr>";
		echo"<td>".$params[$i]."</td>
		<td>".$grades[$i]."</td>";
		if(!isset($subjects[$i])){
			$subjects[$i]="";
			echo"<td></td>";
		}
		else{echo"
		
		<td>".$subjects[$i]."</td>";}
		
		if(!isset($other_CA[$i])){
			$other_CA[$i]="";
			echo"<td></td>";
		}
		else{
			if($other_CA[$i]<5){
					echo"
						<td class='text-danger' align='center'>".$other_CA[$i]."</td>";}
		else{
				echo"
					<td class='text-primary' align='center'>".$other_CA[$i]."</td>";}
		
			}
		
		
		if(!isset($CA[$i])){
			$CA[$i]="";
			echo"<td></td>";
		}
		else{
			
			if($CA[$i]<15){
				echo"
					<td class='text-danger' align='center'>".$CA[$i]."</td>";
					}
			else{
				
				echo"<td class='text-primary' align='center'>".$CA[$i]."</td>";
					
			}
		}
		if(!isset($exams[$i])){
			$exams[$i]="";
			echo"<td></td>";
		}
		else{
				if($exams[$i]<30){
					echo"
						<td class='text-danger' align='center'>".$exams[$i]."</td>";
				}
				else{
						echo"<td class='text-primary' align='center'>".$exams[$i]."</td>";
				}
		}
		if(!isset($firstTermTotalScore[$i])){
			$firstTermTotalScore[$i]="";
			echo"<td></td>";
		}
		else{
			
			if($firstTermTotalScore[$i]<30){
						echo"<td align='center' class='text-danger'>".$firstTermTotalScore[$i]."</td>";
						}
				else{
					
						echo"<td align='center' class='text-primary'>".$firstTermTotalScore[$i]."</td>";
					
					
				}
		}
		
		if(!isset($secondterm_score[$i])){
			$secondterm_score[$i]="";
			echo"<td></td>";
		}
		else{
			if($secondterm_score[$i]<30){
				echo"
					<td class='text-danger' align='center'>".$secondterm_score[$i]."</td>";
					}
					
			else{
					echo"<td class='text-primary' align='center'>".$secondterm_score[$i]."</td>";
				}
		}
		if(!isset($secondterm_grade[$i])){
			$secondterm_grade[$i]="";
			echo"<td></td>";
		}
		else{
			if($secondterm_score[$i]<30){
						echo"<td align='center' class='text-danger'>".$secondterm_grade[$i]."</td>";
						}
				else{
					
						echo"<td align='center' class='text-primary'>".$secondterm_grade[$i]."</td>";
					
					
				}
		}
		if(!isset($remark1[$i])){
			$remark1[$i]="";
			echo"<td></td>";
		}
		else{
			if($secondterm_score[$i]<30){
						echo"<td align='center' class='text-danger'>".$remark1[$i]."</td>";
						}
				else{
					
						echo"<td align='center' class='text-primary'>".$remark1[$i]."</td>";
					
					
				}
		}
		echo"</tr>";
		
		$total_studentScore += (int) $secondterm_score[$i];
	
	}
	echo"</table><br><br>
	</div>";
}
$select4="SELECT COUNT(student_id) AS num_pupils FROM class_session WHERE class_name='$class_name' AND start_year='$start_year' AND end_year='$end_year'";
$query4=$conn->query($select4);
if($results4=$query4->fetch_array(MYSQLI_ASSOC)){
	$num_pupils=$results4['num_pupils'];
}
$select4="SELECT COUNT(subjects) AS num_subjects FROM second_term WHERE student_id='$student_id' AND class_name='$class_name' AND start_year='$start_year' AND end_year='$end_year'";
$query4=$conn->query($select4);
if($query4->num_rows>0){
	$results4=$query4->fetch_array(MYSQLI_ASSOC);
	$num_subjects=$results4['num_subjects'];
}
else{
	$num_subjects=null;
}
$total_score=100*$num_subjects;
if($num_subjects!=0){
$percent_score=round(($total_studentScore/$total_score)*100);}//prevents division by zero error
else{$percent_score=0;}
$select5="SELECT totalscore FROM totalscore WHERE term='2nd term' AND class_name='$class_name' AND start_year='$start_year' AND end_year='$end_year' ";
$query5=$conn->query($select5);
while($results5=$query5->fetch_array(MYSQLI_ASSOC)){
	$scores[]=$results5['totalscore'];
}
$unique_scores = array_unique($scores);
rsort($unique_scores);
//print_r($unique_scores);
$select6="SELECT totalscore FROM totalscore WHERE student_id='$student_id' AND class_name='$class_name' AND term='2nd term' AND start_year='$start_year' AND end_year='$end_year'";
$query6=$conn->query($select6);
		if($results6=$query6->fetch_array(MYSQLI_ASSOC)){
			$student_totalScore=$results6['totalscore'];
			$key=array_search("$student_totalScore",$unique_scores);
			//echo $key;
			$position=$key+1;
			
		}
		else{
				$position=0;
				echo"<p style='color:red'>!!! There are no records yet for Second Term..</p>";
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

	echo"<p>Number Of Pupils in Class:...<strong>$num_pupils</strong>...........Total Score..<strong>$total_studentScore/$total_score</strong>.......................Position....<strong>$position</strong>...........percentage Score:..<strong>$percent_score%</strong>............</p>
	<p>Next Term Begins:.............. Teachers Comment:..................................................................Date/Signature&Stamp.........................</p>";
echo"</div>
</div>
</div>
</div>
<br><br>";		
		
		
?>		
		
		
<div class="footer">
		<footer>
<p align="center"> <strong>&copy  <?php echo''.date("Y").'';?> Vinebranch School Management System </strong></p>
</footer>

</body>
</html>
</body>
</html>
