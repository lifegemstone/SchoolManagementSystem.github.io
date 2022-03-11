<?php
include_once("includeFunction.php");
$student_id=array();
if(isset($_GET['class_name'])){
	
	$class_name=$_GET['class_name'];
	
}
$id=1;
$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
if($conn->connect_error){
	die('could not connect to the database');
}
else{
	echo'
	
	
	
	<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
								
                                    <tr>
                                          
                                        <th> S/N </th>
                                        <th>Student Name</th>
                                        <th>Generate Report Card</th>								
                                    </tr>
                                </thead>
                                <tbody>';
	$select1="SELECT * FROM students WHERE class_name='$class_name'";
						$query1=mysqli_query($conn,$select1);
						while($results=mysqli_fetch_array($query1,MYSQLI_ASSOC))
						{ 
							$select2="SELECT SUM(attendance_rating) AS rating FROM attendance WHERE student_id='{$results['student_id']}'";
							$query2=$conn->query($select2);
							$rating=$query2->fetch_array(MYSQLI_ASSOC);
						echo '<tr>
                                  <td>'.$id.'</td>
								   <td>'.$results['student_name'].'</td>
									<td class="text-primary"><a href="generate_reportcard.php?stud_id='.$results['student_id'].' &class_name='.$class_name.'">Generate Report Card</a></td>
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
						  ";
	}
?>