<?php 
session_start(); 
include_once('includeFunction.php');
if($_SERVER['REQUEST_METHOD']=='POST')
				
			{
			
				
				
				$errors=array();
				$extension=array("image/jpeg","image/png","image/pjpeg","image/gif","image/jpg");
				$savepath= "C:\wamp\www\sms\images";
					
					if(isset($_POST['usrcd'])){
						$usrcd=$_POST['usrcd'];
					}
					if(empty($_POST['date']))
					{ 
						$errors[]='please enter date';
					
					}
					else
					{
							$date=$_POST['date'];
							
					}
					
					if(empty($_POST['bankName']))
						
						{
							
							$errors[]='please enter bank name';
							
							
						}
						else
						{ 
							$bankName=$_POST['bankName'];
						}
						
						if(empty($_POST['phoneNumber']))
						
						{
							
							$errors[]='please enter phone number';
							
							
						}
						else
						{ 
							$phoneNumber=$_POST['phoneNumber'];
						}
						
						if(isset($_POST['studentsName'])){
							if(empty($_POST['studentsName'])){
								
								$errors[]="please select a student";
							}
							else{
									$studentsName=$_POST['studentsName'];
							}
						}
						
						if(isset($_POST['studentName'])){
							if(empty($_POST['studentName'])){
								
								$errors[]="please select a student";
							}
							else{
									$studentName=$_POST['studentName'];
							}
						}
						
					if(empty($_POST['amount']))
					{
						$errors[]='please enter amount';
					}
					else{
							$amount=$_POST['amount'];
						}
					
					if(empty($_POST['paidBy']))
					{
						$errors[]='please enter payers name';
					}
					else{
							$paidBy=$_POST['paidBy'];
						}
					if(empty($_POST['recieptNumber']))
					{
						$errors[]="please enter reciept number";
					}
					else{
							$recieptNumber=$_POST['recieptNumber'];
						}
					if(isset($_POST['accademicSession']))
					{
						$accademicSession=$_POST['accademicSession'];
					}
					if(isset($_POST['paymentMode']))
					{
						$paymentMode=$_POST['paymentMode'];
					}
					
					if(!empty($_FILES['img']))
					{
						if(in_array($_FILES['img']['type'],$extension))
						{ 
							if($_FILES['img']['size']>5000000)
							{$errors[]='image size should not be more than 5MB';}
							else{
									$filename=$savepath ."/".$_FILES['img']['name'];
									$student_img=$_FILES['img']['name'];
									if(move_uploaded_file($_FILES['img']['tmp_name'],$filename))
									{
										echo"";
									}
									else
									{$errors[]='sorry image could not be uploaded please try again';}
								}
						}
						else
						{ $errors[]='sorry file must be of either .jpeg .jpg .png .gif type';}
					}
					else{$errors[]='kindly select a picture to upload';}
					$now=time();
					$start_year=date('Y',$now);
					$end_year=$start_year+1;
					if(empty($errors)){
						$mysqli=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME) or die('could not connect to the database'.mysqli_connect_error());
										
										if(!empty($studentsName)){
										foreach($studentsName as $student){
											$insert="INSERT INTO transaction_admindata(id,transaction_id,transaction_reference,amount,paid_by,phone_number,channel,payment_mode,email,student_name,reciept_img,date) VALUES('','N/A','$recieptNumber','$amount','$paidBy','$phoneNumber','Bank Teller','$paymentMode','N/A','$student','$student_img','$date')";
											$query=$mysqli->query($insert);
											if($mysqli->affected_rows>0){
												$_SESSION['offlinePaymentSuccess']="Payment Details Uploaded Successfully";
												header('location:offline_transactions.php?usrcd='.$usrcd.'');
											}
											//else{
												//	"echo an error occurred".mysqli_error($mysqli);
												//}
												
												
												/*else{"echo an error occurred".mysqli_error($mysqli);
													}*/
									
										}
									}
									if(!empty($studentName)){
										$insert="INSERT INTO transaction_admindata(id,transaction_id,transaction_reference,amount,paid_by,phone_number,channel,payment_mode,email,student_name,reciept_img,date) VALUES('','N/A','$recieptNumber','$amount','$paidBy','$phoneNumber','Bank Teller','$paymentMode','N/A','$studentName','$student_img','$date')";
											$query=$mysqli->query($insert);
											if($mysqli->affected_rows>0){
												$_SESSION['offlinePaymentSuccess']="Payment Details Uploaded Successfully";
												header('location:offline_transactions.php?usrcd='.$usrcd.'');
											}
									}
						
					}
					else{
						    foreach($errors as $error){
								
								echo"<li>$error</li>";
							}
							$_SESSION['offlinePaymentError']=$errors;
							header('location:offline_transactions.php?usrcd='.$usrcd.'');
							}
						
						
					}
				

?>