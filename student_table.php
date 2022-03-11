<?php
include_once("includeFunction.php");
if(isset($_GET['class_name'])){
	
	$class_name=$_GET['class_name'];
	
}
$id=1;
$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
if($conn->connect_error){
	die('could not connect to the database');
}
else{
	echo'<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
								
                                    <tr>
                                          
                                        <th> S/N </th>
                                        <th>Student Name</th>
                                        <th>Student Profile</th>
										<th>Sex</th>
										<th>Age</th>
										<th>Parent Telephone No</th>	  
                                    </tr>
                                </thead>
                                <tbody>';
	$select1="SELECT * FROM students WHERE class_name='$class_name'";
						$query1=mysqli_query($conn,$select1);
						while($results=mysqli_fetch_array($query1,MYSQLI_ASSOC))
						{ 
							
						echo '<tr>
                                  <td>'.$id.'</td>
								   <td>'.$results['student_name'].'</td>
								    <td align="center"><a href="student_profile.php?stud_id='.$results['student_id'].'"><i class="fa fa-user text-primary"></a></i></td>
									<td align="center">'.$results['sex'].'</td>
									<td align="center">';
									$current_timestamp=time();
									$current_year=date('Y',$current_timestamp);
									$birth_year=date('Y',strtotime($results['date_birth']));
									$age=$current_year-$birth_year;
									if($age>0){
									echo "<span class='text-success'>$age yrs</span>";
									}
									else{
										echo "<span class='text-success'>$age yr</span>";
									}
									echo'</td>
									<td>'.$results['telephone_no'].'</td>
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