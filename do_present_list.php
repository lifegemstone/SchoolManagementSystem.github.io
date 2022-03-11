<?php
include_once("includeFunction.php");
if(isset($_GET['class_name'])){
	
	$class_name=$_GET['class_name'];
	
}
if(isset($_GET['start_date'])){
	
	$start_date=$_GET['start_date'];

}
if(isset($_GET['end_date'])){
	
	$end_date=$_GET['end_date'];
	
}
$id=1;
 $conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
 if($conn->connect_error) die("Could not connect to the database");
	else{
				
			echo'<button type="button" class="btn btn-success btn-xs pull-right"><a href="present_excel.php?class_name='.base64_encode($class_name).' & x_date='.base64_encode($start_date).'  & y_date='.base64_encode($end_date).'" style="color:white;text-decoration:none"><i class="fa fa-download"></i> Export to Excel</a></button>
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
								
                                    <tr>
                                          
                                        <th> S/N </th>
                                        <th>Student Name</th>
                                        <th>Attendance Status</th>
										<th>Date</th>											
                                    </tr>
                                </thead>
                                <tbody>';
						$select1="SELECT s.student_name as student_name,a.class_name as class_name,a.attendance_status,a.attendance_date  FROM students AS s INNER JOIN attendance as a  ON s.student_id=a.student_id WHERE a.class_name='$class_name' AND attendance_date BETWEEN '$start_date' AND '$end_date' AND attendance_status='Present' ORDER BY attendance_date";				

						$query1=mysqli_query($conn,$select1);
						while($results=mysqli_fetch_array($query1,MYSQLI_ASSOC))
						{ 
						echo '<tr>
                                  <td>'.$id.'</td>
								   <td>'.$results['student_name'].'</td>
									<td align="center" class="text-success">'.$results['attendance_status'].'</td>
									<td>'.$results['attendance_date'].'</td>
								</td>
						 </tr>';
						$id++;}
                                
                               echo" </tbody>
								
                            </table>
							<script>
							$(document).ready(function(){
								$('#dataTables-example').DataTable({
									responsive: true
									});
							})
							</script>";
	} 
?>