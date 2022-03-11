<?php
 session_start();
class academics{
	
public $studentName;
public $tutorName;
public $studentId;
public $tutorId;
protected function setTutorName(){
	
	
	return($this->tutorName);
}

protected function setStudentName(){

return($this->studentName);



}	
	
	protected function tutorId(){
		$this->tutorId="TUT-ID:".rand(); 
		
	return($this->tutorId);	
		
	}
	
	
protected function studentId(){
	
	$this->studentId="STUD-ID:".rand();
	return($this->studentId);
	
	
}
}

class tutor extends academics{
	
	private $email;
	private $password;
	public $className;
	public $courseName;
	private $qualification;
	public function setTutorId(){
		
		return(parent::tutorId());
		
		
	}
	public function signUp(){
		
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$this->tutorId=SELF::setTutorId();
		
		
		
		try{
				$this->tutorName=$_POST['name'];
		
			if(empty(strip_tags(trim($this->tutorName))))
			{
				$msg="fill in your name";
				
				throw new Exception($msg);
			
			}
		}
		
		catch(Exception $e)
		{
			echo("ERROR LINE ". $e->getLine().",". $e->getMessage() ."");
			
			
		}
			if(!empty($_POST['email']))
			{
				try
				{
					$this->email=filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
					if(!$this->email)
				
					{
						
						$msg="Invalid email";
						 throw new Exception($msg);
						
						
					}
				}
				
				catch(Exception $e)
				{
					
					echo("ERROR on line:".$e->getLine() .",".$e->getMessage() ."");
					
				}
			}
			
			
				try{
					
					$this->password=$_POST['password'];
				
				if(empty($this->password)){
					throw new Exception("Fill in your password");
				
					}
				}
		
				catch(Exception $e){
					
					
					echo $e->getMessage();
					
				}
			
			if(empty($e)){
				
				try{
					$conn=new mysqli("localhost","root","","eportal");
					if($conn->connect_error)
				
					{
						throw new Exception("Could not connect to the database ");
						
						
						unset($conn);
					}
					else{
						$this->tutorName=$conn->real_escape_string($this->tutorName);
						$this->password=$conn->real_escape_string($this->password);
						$insert="INSERT INTO tutors(tutor_no,tutor_id,tutor_name,tutor_email,tutor_password,date)VALUES('','".$this->tutorId ."','".$this->tutorName ."','".$this->email ."','".SHA1($this->password)."', NOW())";
						$query=$conn->query($insert);
						if($conn->affected_rows ==1)
						{
							
							header('location:tutors_home.php');
							
						}
						else{
							
						echo "error your account was not created".$conn->error;	
							
						}
						
					}
						
				}
			catch(Exception $e){
				echo("".$e->getMessage() ."");
				
			}
			}
			else{
				
				
				echo"OOPS error occurred";
				
			}
	}
}
	
	public function createClass(){
		
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			$errors=array();
			if(isset($_POST['faculty'])){
				
			
				$faculty=$_POST['faculty'];
			
				
			}
			if(empty($_POST['class_name']))
			{
				
				$errors[]="please enter a name for the class";
				
				
				
			}
			else{
				
				
				$class_name=strip_tags(trim($_POST['class_name']));
				
				
				
			}
			
			if(isset($_POST['class_grade'])){
				
				
				$class_grade=$_POST['class_grade'];
				
				
			}
			if(empty($_POST['course_title']))
			{
				
				
				$errors[]="enter a course title";
				
				
				
				
			}
			else{
				
				
				$course_title=strip_tags(trim($_POST['course_title']));
				
				
				
			}
			if(empty($_POST["course_code"]))
			{
				
			$errors[]="enter course code";	
				
				
				
			}
			else{
					$course_code=strip_tags(trim($_POST['course_code']));
				
				
			}
			if(empty($_POST['lecture_day'])){
				
				$errors="thick out your lecture days";
				
				
			}			
				
				
			
			
			 if(empty($errors)){

				try{
				$conn=new mysqli("localhost","root","","eportal");
				if($conn->connect_error)
				{
					throw new Exception("could not connect  to the database");
					unset($conn);	
				}

				else{
					
				$insert="INSERT INTO class(class_id,faculty,class_name,class_grade,course_title,course_code,tutor_name,date)VALUES('','$faculty','$class_name','$class_grade','$course_title','$course_code','',NOW())";
				$query=$conn->query($insert);
				if($conn->affected_rows==1)
				{
					
					foreach($_POST['lecture_day'] as $selected_days)
						{
							
					
							switch($selected_days)
								{
									
									case "monday":
									if(isset($_POST['mon_lecture_start'])&& isset($_POST['mon_lecture_end']))
									{
										$week_day= $selected_days;
										$mon_start_time=$_POST['mon_lecture_start'];
										$mon_end_time=$_POST['mon_lecture_end'];
										
									$insert2="INSERT INTO lecture_days(day_id,class_name,class_grade,course_title,course_code,week_day,start_time,end_time,tutor_name)VALUES('','$class_name','$class_grade','$course_title','$course_code','$week_day','$mon_start_time','$mon_end_time','')";
									$query2=$conn->query($insert2);	
									
									}
									break;
									case "tuesday":
									if(isset($_POST['tue_lecture_start'])&& isset($_POST['tue_lecture_end']))
									{
										
										$week_day= $selected_days;
										$tue_start_time=$_POST['tue_lecture_start'];
										$tue_end_time=$_POST['tue_lecture_end'];
									$insert3="INSERT INTO lecture_days(day_id,class_name,class_grade,course_title,course_code,week_day,start_time,end_time,tutor_name)VALUES('','$class_name','$class_grade','$course_title','$course_code','$week_day','$tue_start_time','$tue_end_time','')";
									$query3=$conn->query($insert3);	
									
									}
									break;
									case "wednessday":
									if(isset($_POST['wed_lecture_start'])&& isset($_POST['wed_lecture_end']))
									{
										
										$week_day= $selected_days;
										$wed_start_time=$_POST['wed_lecture_start'];
										$wed_end_time=$_POST['wed_lecture_end'];
									$insert4="INSERT INTO lecture_days(day_id,class_name,class_grade,course_title,course_code,week_day,start_time,end_time,tutor_name)VALUES('','$class_name','$class_grade','$course_title','$course_code','$week_day','$wed_start_time','$wed_end_time','')";
									$query4=$conn->query($insert4);	
									
									}
									break;
									case "thursday":
									if(isset($_POST['thu_lecture_start'])&& isset($_POST['thu_lecture_end']))
									{
										
										$week_day= $selected_days;
										$thu_start_time=$_POST['thu_lecture_start'];
										$thu_end_time=$_POST['thu_lecture_end'];
									$insert5="INSERT INTO lecture_days(day_id,class_name,class_grade,course_title,course_code,week_day,start_time,end_time,tutor_name)VALUES('','$class_name','$class_grade','$course_title','$course_code','$week_day','$thu_start_time','$thu_end_time','')";
									$query5=$conn->query($insert5);	
									
									}
									break;
									case "friday":
									if(isset($_POST['fri_lecture_start'])&& isset($_POST['fri_lecture_end']))
									{
										
										$week_day= $selected_days;
										$fri_start_time=$_POST['fri_lecture_start'];
										$fri_end_time=$_POST['fri_lecture_end'];
									$insert6="INSERT INTO lecture_days(day_id,class_name,class_grade,course_title,course_code,week_day,start_time,end_time,tutor_name)VALUES('','$class_name','$class_grade','$course_title','$course_code','$week_day','$fri_start_time','$fri_end_time','')";
									$query6=$conn->query($insert6);	
									
									}
									break;
									default:
									echo "";
								}
					
						}
					$success_msg="$class_name was successfully created";
					$_SESSION['success_msg']=$success_msg;
					header("location:create_class.php");
				}
					
			} 

			 
			 }
			 catch(Exception $e)
			 {
				 
				echo $e->getMessage(); 
				 
			}
			
			
		}
		
	}
	
}




public function generateTimeTable()
{
	try{
	$conn=new mysqli("localhost","root","","eportal");
	if($conn->connect_error)
	{
		
		throw new Exception("sorry connection to the database failed try again");
		
	}
	else{
		$database_days=array();
		$days=array('monday','tuesday','wednessday','thursday','friday');
		$select="SELECT * FROM lecture_days";
		$query=$conn->query($select);
		if($query->num_rows > 0)
		{
			echo "
			<table class='table table-responsive'>
			<thead>
			<tr>
				<td class='text-success'>week day</td>
				<td class='text-success'>course title</td>
				<td class='text-success'>course code</td>
				<td class='text-success'>class  grade</td>
				<td class='text-success'>start time</td>
				<td class='text-success'>end time</td>
				</tr>
				</thead>
				<tbody>";
			while($results=$query->fetch_array(MYSQLI_ASSOC)){
				
				$database_days[]=$results['week_day'];
				
				
			}
			 foreach($days as $day){
				
				if(!in_array($day,$database_days)){
					echo "";
					
				}
				else{
				echo"
				
				<tr>
				<td class='text-primary'>$day</td>
				<td  class='gray'></td>
				<td  class='gray'></td>
				<td  class='gray'></td>
				<td  class='gray'></td>
				<td  class='gray'></td>
				</tr>";
				switch($day){
					case "monday":
					$select2="SELECT * FROM lecture_days WHERE week_day='$day' ORDER BY week_day ASC";
					$query2=$conn->query($select2);
					while($results2=$query2->fetch_array(MYSQLI_ASSOC))
					{
						echo"<tr><td class='gray'></td>
				<td class='text-danger'>{$results2['course_title']}</td>
				<td class='text-danger'>{$results2['course_code']}</td>
				<td class='text-danger'>{$results2['class_grade']}</td>
				<td class='text-danger'>{$results2['start_time']}</td>
				<td class='text-danger'>{$results2['end_time']}</td>
				</tr>";
					}
					break;
					case "tuesday":
					$select2="SELECT * FROM lecture_days WHERE week_day='$day' ORDER BY week_day ASC";
					$query2=$conn->query($select2);
					while($results2=$query2->fetch_array(MYSQLI_ASSOC))
					{
						echo"<tr><td class='gray'></td>
				<td class='text-danger'>{$results2['course_title']}</td>
				<td class='text-danger'>{$results2['course_code']}</td>
				<td class='text-danger'>{$results2['class_grade']}</td>
				<td class='text-danger'>{$results2['start_time']}</td>
				<td class='text-danger'>{$results2['end_time']}</td>
				</tr>";
					}
					break;
					case "wednessday":
					$select2="SELECT * FROM lecture_days WHERE week_day='$day' ORDER BY week_day ASC";
					$query2=$conn->query($select2);
					while($results2=$query2->fetch_array(MYSQLI_ASSOC))
					{
						echo"
						<tr><td class='gray'></td>
				<td class='text-danger'>{$results2['course_title']}</td>
				<td class='text-danger'>{$results2['course_code']}</td>
				<td class='text-danger'>{$results2['class_grade']}</td>
				<td class='text-danger'>{$results2['start_time']}</td>
				<td class='text-danger'>{$results2['end_time']}</td>
				</tr>";
					}
					break;
					case "thursday":
					$select2="SELECT * FROM lecture_days WHERE week_day='$day' ORDER BY week_day ASC";
					$query2=$conn->query($select2);
					while($results2=$query2->fetch_array(MYSQLI_ASSOC))
					{
						echo"<tr><td class='gray'></td>
				<td class='text-danger'>{$results2['course_title']}</td>
				<td class='text-danger'>{$results2['course_code']}</td>
				<td class='text-danger'>{$results2['class_grade']}</td>
				<td class='text-danger'>{$results2['start_time']}</td>
				<td class='text-danger'>{$results2['end_time']}</td>
				</tr>";
					}
					break;
				case "friday":
					$select2="SELECT * FROM lecture_days WHERE week_day='$day' ORDER BY week_day ASC";
					$query2=$conn->query($select2);
					while($results2=$query2->fetch_array(MYSQLI_ASSOC))
					{
						echo"<tr><td class='gray'></td>
				<td class='text-danger'>{$results2['course_title']}</td>
				<td class='text-danger'>{$results2['course_code']}</td>
				<td class='text-danger'>{$results2['class_grade']}</td>
				<td class='text-danger'>{$results2['start_time']}</td>
				<td class='text-danger'>{$results2['end_time']}</td>
				</tr>";
					}
					break;
					default:
					echo"";
				
			}
				
		}
			echo "
			";
		}
	}
	}
	}
	catch(Exception $e){
		
		echo $e->getMessage();
		
		
		
	}
	
}
	public function viewClass(){
		
		
		
		
		
		
	}
	public function logout(){
		
		
		
		
	}
	public function addStudent(){
		
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			$errrors=array();
			if(empty($_POST['faculty'])){
				
				$errors[]="select a faculty";
				
			}
			else{
				
				
				$faculty=$_POST['faculty'];
				
				
			}
			
			if(empty($_POST['class_name']))
			{
				
				$errors[]="select a class name";
				
			}
			else{
				
				$class_name=$_POST['class_name'];
				
				
				
			}
			
				
			if(empty($_POST['class_grade']))
			{
				
				$errors[]="select a class grade";
				
			}
			else{
				
				$class_grade=$_POST['class_grade'];
				
				
				
			}
			
				
			if(empty(trim($_POST['first_name'])))
			{
				
				$errors[]="enter your first name";
				
			}
			else{
				
				$first_name=strip_tags($_POST['first_name']);
				
				
				
			}
				
			if(empty(trim($_POST['last_name'])))
			{
				
				$errors[]="enter your last name";
				
			}
			else{
				
				$last_name=strip_tags($_POST['last_name']);
				
				
				
			}
			
				
			if(empty(trim($_POST['other_name'])))
			{
				
				$errors[]="enter your other name";
				
			}
			else{
				
				$other_name=strip_tags($_POST['other_name']);
				
				
				
			}
			
			if(empty($errors))
			{
				
				try{
					$conn=new mysqli('localhost','root','','eportal');
					if($conn->connect_error)
					{
						
						throw new Exception('could not connect to the database');	
							unset($conn);
					}
					else{
						
					$first_name=$conn->real_escape_string($first_name);
					$last_name=$conn->real_escape_string($last_name);
					$other_name=$conn->real_escape_string($other_name);
					$insert="INSERT INTO class_students(id,faculty,class_name,class_grade,first_name,last_name,other_name,tutor_name)VALUES('','$faculty','$class_name','$class_grade','$first_name','$last_name','$other_name','')";	
						$query=$conn->query($insert);
						if($conn->affected_rows==1)
						{
							
							
							
							
							$success_msg="$first_name $last_name $other_name was successfully added to class";
							$_SESSION['success_msg']=$success_msg;
							header('location:add_student.php');
						
						
					}
					
				}
			}		
			catch(Exception $e){echo $e->getMessage();}	
			}
		else{
			$_SESSION['error_msg']=$errors;
			
			header('location:add_student.php');
			
		
			}
		} 
		
		
		
		
	}
	
	
}


?>