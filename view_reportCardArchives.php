<?php 

include_once("validate_user.php");

if(isset($_GET['stud_id'])){
	$student_id=$_GET['stud_id'];
}

$monthFull=date('F');	
$monthNumeric=date('m');
?>
<!DOCTYPE HTML>
<html>
<head><title>Student Profile </title>
<meta name="viewport" content="width=device-width initial-scale=1">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.css" rel="stylesheet" type="text/css">
<link href="css/sb-admin-2.css" rel="stylesheet" type="text/css">
  <link href="css/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
<style type='text/css'>
.footer{background:black;
color:white;
position:fixed;
bottom:0px;
width:100%;}
.link{text-decoration:none;color:white}
a:hover{text-decoration:none;color:white}
body{position:relative;}
</style>
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
</head>
<body>
<?php  

	if(validateUser::getRole()=="admin")
		{
			validateUser::heading2();
		}
		else{
				validateUser::heading();
			
		}
	
//heading();?>
<div class="container">
<div class="rows">
<div class="col-xs-12 col-sm-12 col-md-lg col-lg-12">
<ol class="breadcrumb"> 
<li><a href="#"><i class="fa fa-home"></i>STUDENTS</a></li> 
<li class=""><i class='fa fa-dashboard'></i> DASHBOARD</li> 
<li class="active">STUDENTS PROFILE</li>  
</ol>
<h4 class="page-header text-primary"><i class="fa fa-user"></i> Student Basic Information</h4>
<?php 
$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
if($conn->connect_error){
	die('could not connect to the database');
}
else{
		$classes=array();
		$select="SELECT * FROM students WHERE student_id='$student_id'";
		$query=$conn->query($select);
		while($results=$query->fetch_array(MYSQLI_ASSOC)){
		echo"
			<img src='studentImages/{$results['student_img']}' width='200px' height='200px' class='img-rounded thumbnail'>
			<h5><strong>STUDENT NAME:</strong> ".ucwords($results['student_name'])."</h5>
			<h5><strong>SEX:</strong> {$results['sex']}</h5>
			<h5><strong>DATE OF BIRTH:</strong> {$results['date_birth']}</h5>
			<h5><strong>AGE:</strong>";
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
			echo"
			<h5><strong>CURRENT CLASS:</strong> {$results['class_name']}</h5>
			<h5><strong>PARENT NAME:</strong> ".ucwords($results['parent_name'])."</h5>
			<h5><strong>GUIDIAN PHONE NUMBER:</strong> {$results['telephone_no']}</h5>
			<h5><strong>HOME ADDRESS:</strong> ".ucwords($results['home_address'])."</h5>";
			$class_name=$results['class_name'];
		}
	}
	?>	 
	
	<h4 class='page-header text-primary'><i class='fa fa-bar-chart'></i> CURRENT ACADEMIC PROGRESS</h4>
	<h5>Attendance Status For <?php echo $monthFull;?>:</h5>
	<?php 
	$select="SELECT SUM(attendance_rating) AS rating FROM attendance WHERE student_id='$student_id' AND month='$monthNumeric'";
							$query=$conn->query($select);
							$rating=$query->fetch_array(MYSQLI_ASSOC);
								echo'<div class="col-sm-8 col-md-8 col-lg-8">
								<div class="progress">';
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
									echo'
									</div></div>';
									?>
	<div class='col-sm-12'>
	<h4 class='page-header text-primary'><i class='fa fa-bar-chart'></i> Student Performance Chart</h4>
	<p style='color:red'><i class='fa fa-angle-double-down'></i>Select a term to view Analysis</p>
	<form method='POST' action='term_analysis.php' id='form' class='form-inline' >
	<select name='term' class='form-control'>
	<option selected value='1st Term'>First Term</option>
	<option value='2nd Term'>Second Term</option>
	<option value='3rd Term'> Third Term</option>
	</select>
	<input type="hidden" name="student_id" value="<?php echo $student_id; ?>" />
	<input type="hidden" name="class_name" value="<?php echo $class_name; ?>" />
	<button type='submit' class='btn btn-xs btn-primary'>View Analysis</button>
	</form>
	<h4 class='page-header text-primary'><i class='fa fa-database'></i> ACADEMIC ACHIVES</h4>
	<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
								
                                    <tr>
                                          
                                        <th><i class='fa fa-calendar'></i> Session Year</th>
										 <th><i class='fa fa-building'></i> Class</th>
                                        <th><i class=""></i> First Term Report</th>
                                        <th><i class=""></i> Second Term Report</th>
										<th><i class=""></i> Third Term Report</th>  
                                    </tr>
                                </thead>
                                <tbody>
								<?php
								$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
								if($conn->connect_error){
									die('could not connect to the database');
								}
								else{
									$select="SELECT class_name,start_year,end_year FROM class_session WHERE student_id='$student_id'";
									$query=$conn->query($select);
									while($results1=$query->fetch_array(MYSQLI_ASSOC)){
										echo"<tr>
                                  <td>{$results1['start_year']}/{$results1['end_year']}</td>
								   <td>{$results1['class_name']}</td>
								    <td align='center'><a href='view_firstReportCard.php?stud_id=".$student_id."&tr=first_term&class_name={$results1['class_name']}&s_yr={$results1['start_year']}&e_yr={$results1['end_year']}'><i class='fa fa-eye text-primary'> view 1st term report</a></i></td>
									<td align='center'><a href=' view_secondReportCard.php?stud_id=".$student_id."&tr=second_term&class_name={$results1['class_name']}&s_yr={$results1['start_year']}&e_yr={$results1['end_year']}'><i class='fa fa-eye text-primary'> view 2nd term report</a></i></td>
									<td align='center'><a href='view_thirdReportCard.php?stud_id=".$student_id."&tr=third_term&class_name={$results1['class_name']}&s_yr={$results1['start_year']}&e_yr={$results1['end_year']}'><i class='fa fa-eye text-primary'> view 3rd term report</a></i></td>
									
								
						 </tr>";
									}
								}
                               ?> 
                               </tbody>
								
                            </table>
	<br>
	<br>
	<br>
	</div>
	</div>
			 </div>
			 </div>
<div class="footer">
		<footer>
<p align="center"> <strong>&copy  <?php echo''.date("Y").'';?> Vinebranch School Management System </strong></p>
</footer>
</body>
</html>