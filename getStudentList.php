<?PHP
//include_once("validate_user.php");
include_once("includeFunction.php");
if(isset($_GET["c_name"])){
	$className=$_GET["c_name"];

}
if(isset($_GET["mode"])){
	$paymentMode=$_GET["mode"];
}

echo"<br><br><div id='selectedResults'></div><br><br>";
$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME) or die("could not connect to the database");
$select="SELECT student_id,student_name,class_name,parent_name,telephone_no FROM students";
$query=$conn->query($select);
if($query->num_rows>0){
	echo'<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
								
                                    <tr>
                                          
                                        <th> S/N </th>
										<th>Student Name</th>
										<th>Class Name</th>
										<th>Parent Name</th>
                                        <th>Parent Phone Number</th>
										<th>Select </th>
                                    </tr>
                                </thead>
                                <tbody>';
								$id=1;
						while($results=$query->fetch_array(MYSQLI_ASSOC))
						{ 
							
						echo '<tr>
                                  <td>'.$id.'</td>
								   <td>'.$results['student_name'].'</td>
								   <td>'.$results['class_name'].'</td>
								    <td align="center">'.$results['parent_name'].'</td>
									 <td align="center">'. $results['telephone_no'].'</td>
									<td align="center">';
										echo "<input type='radio' name='studentName' value='".$results['student_name']."' class='singleMode' />";
										echo "<input type='checkbox' name='studentsName[]' value='".$results['student_name']."' class='bulkMode' />";
										
									echo'</td>
								 </tr>';
						$id++;}
                                        
                                  
                       
							
                                
                               echo" </tbody>
								
                            </table>
							";
	
}
else{
	
		echo "<span style='color:red'>*Error Kindly Select a Class...</span>";
	
}
?>
							<script>
							$(document).ready(function(){
								var count = 0; 
								$("#selectedResults").empty();
								$("#selectedResults").hide();
								var selectedStudents=[];
								var results=[];
							var paymentMode="<?php echo $paymentMode;?>";
							if(paymentMode=='Single Mode'){
									$('.singleMode').show();
									$('.bulkMode').hide();
								
							}
							else{
									$('.bulkMode').show();
									$('.singleMode').hide();
								
							}
							
							$(".bulkMode").click(function(){
								count++;
								if($(this).is(":checked")){
									var value=$(this).val();
								if(count == 1){
										$("#selectedResults").append("<h5 style=color:red> *Selected Students will be attached to the Uploaded Reciepts</h5>");
									}
								
									if($.inArray(value,selectedStudents)==-1){
										//alert(value);
										selectedStudents.push(value);
											$("#selectedResults").append("<span class='span'><i class='fa fa-check'></i>"+value+"</span>"+"<br>");
											$('.span').css({'padding-left':'10px','padding-top':'2px'});
										}
										
										$("#selectedResults").css('background','#f5f5f5').show();
										//rselectedStudents.slice();
							
								
								}
								else{
										var removeItem=$(this).val();
										selectedStudents.splice($.inArray(removeItem,selectedStudents),1);
										$("#selectedResults").empty();
										count = 0;
										count++;
									if(count == 1){
										$("#selectedResults").append("<h5 style=color:red> *Selected Students will be attached to the Uploaded Reciepts</h5>");
									 }
										for(var i=0;i<selectedStudents.length;i++){
											if(i==(selectedStudents.length - 1))
											{
												$("#selectedResults").remove("<h5 style=color:red> *Selected Students will be attached to the Uploaded Reciepts</h5>");
									
											}
											$("#selectedResults").append("<span class='span'><i class='fa fa-check'></i>"+selectedStudents[i]+"</span>"+"<br>");
											$('.span').css({'padding-left':'10px','padding-top':'2px'});
										}
											
								}
								
								
								
							});
							
							
							$(".singleMode").click(function(){
								if($(this).is(":checked")){
									var value=$(this).val();
											$('#selectedResults').empty();
											$("#selectedResults").append("<h5 style=color:red> *Selected Students will be attached to the Uploaded Reciepts</h5>");
											$("#selectedResults").append("<span class='span'><i class='fa fa-check'></i>"+value+"</span>"+"<br>");
											$('.span').css({'padding-left':'10px','padding-top':'2px'});
											$("#selectedResults").css('background','#f5f5f5').show();
										}
								else{
										var removeItem=$(this).val();
										selectedStudents.splice($.inArray(removeItem,selectedStudents),1);
										$("#selectedResults").empty();
										for(var i=0;i<selectedStudents.length;i++){
										$("#selectedResults").append("<span class='span'><i class='fa fa-check'></i>"+selectedStudents[i]+"</span>"+"<br>");
										$('.span').css({'padding-left':'10px','padding-top':'2px'});
										}
											
								}
								
								
								
							});
							
							
							/*$('.paymentMode').on('change',function(){
									var paymentMode=$(this).val();
									if(paymentMode=='Single Mode'){
										$('.singleMode').show();
										$('.bulkMode').hide();
									}
									else{
										
											$('.bulkMode').show();
											$('.singleMode').hide();
											
									}*/
									
									$('#dataTables-example').DataTable({
									responsive: true
									});
							})
							</script>
