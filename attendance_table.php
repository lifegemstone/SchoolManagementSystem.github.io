<?php
include_once("includeFunction.php");
$student_id=array();
if(isset($_GET['class_name'])){
	
	$class_name=$_GET['class_name'];
	
}
$id=1;
$currentMonth=date('m');
$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
if($conn->connect_error){
	die('could not connect to the database');
}
else{
	echo'
	
	<form action="take_attendance.php" method="POST">
	<div class="form-group">
 <label  class="col-sm-2 control-label">Select a Term *</label>
 <div class="col-sm-12 col-md-6 col-lg-6">
	<select name="term" class="form-control">
		<option> First Term </option>
		<option>Second Term </option>
		<option>Third Term</option>
	</select>
</div>
</div>
<br><br>
<div class="form-group">
<label class="col-sm-2"><i class="fa fa-check-square"></i> Check All:
<input type="checkbox" id="delete_all" /></label>
<br>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label"><i class="fa fa-calendar"></i> Attendance Date:</label>
<div class="col-sm-12 col-md-6 col-lg-6">
<input type="text" autocomplete="none" class="form-control" name="date" required id="datepicker" />
</div>
</div>
<button type="submit" class="btn btn-primary">Take Attendance</button>
<br><br><br>
	
	
	<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
								
                                    <tr>
                                          
                                        <th> S/N </th>
                                        <th>Student Name</th>
                                        <th>Present</th>
										
										<th>Note</th>
										<th>Parent Telephone No</th>
										<th>Attendance Bar</th>										
                                    </tr>
                                </thead>
                                <tbody>';
	$select1="SELECT * FROM students WHERE class_name='$class_name'";
						$query1=mysqli_query($conn,$select1);
						while($results=mysqli_fetch_array($query1,MYSQLI_ASSOC))
						{ 
							$select2="SELECT SUM(attendance_rating) AS rating FROM attendance WHERE student_id='{$results['student_id']}' AND month='$currentMonth'";
							$query2=$conn->query($select2);
							$rating=$query2->fetch_array(MYSQLI_ASSOC);
							$student_id[]=$results['student_id'];
						echo '<tr>
                                  <td>'.$id.'</td>
								   <td>'.$results['student_name'].'</td>
									<td align="center"><input type="checkbox" class="checkbox delete" name="present[]" value="'.$results['student_id'].'" /></td>
									<td><input type="text" name="note[]" class="form-control" /></td>
									<td>'.$results['telephone_no'].'</td>
									<td><div class="progress">';
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
									</div></td>
						 </tr>';
						$id++;}
                                
                               echo" </tbody>
								
                            </table>";
							
							$json=json_encode($student_id);
							echo"
							<input type='hidden' name='class_name' value='$class_name' />
							<input type='hidden' name='student_id' value='{$json}' />
							</form>
							<script>
							$(document).ready(function(){
								$('#dataTables-example').DataTable({
									responsive: true
									});
									
									$('#delete_all').change(function(){
			
			
			if($(this).is(':checked')){
				$('.delete').prop('checked',true);
				$('.delete').parent().closest('tr').addClass('green');
			}
			else{
				
				$('.delete').prop('checked',false);
				$('.delete').parent().closest('tr').removeClass('green');	
			}
		});

							})
							</script>
							<script>
						$('#datepicker').datepicker();
						</script>";
	}
?>