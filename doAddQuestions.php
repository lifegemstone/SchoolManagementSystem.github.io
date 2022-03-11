<?PHP
include_once("includeFunction.php");
if($_SERVER["REQUEST_METHOD"]=="POST"){
	
	
	if(isset($_POST['category'])){
		$category=$_POST['category'];
	
	}
	if(isset($_POST['questionType'])){
		$questionType=$_POST['questionType'];
		
	}
	if(isset($_POST['questions'])){
		$questions=$_POST['questions'];
	
	}
	if(isset($_POST['options'])){
		
		$options=$_POST['options'];
		//print_r($options);
	}
	if(isset($_POST['points'])){
		
		$points=$_POST['points'];
		//print_r($options);
	}

		if(isset($_POST['answers'])){
		
		$answers=$_POST['answers'];
		print_r($answers);
	}
	
	
	$noOfQuestions=sizeof($questions);
	$noOfOptions=sizeOf($options);
	$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
if($conn->connect_error)die("Could not connect to the database");
else{
	for($counter=0;$counter<$noOfQuestions;$counter++){
		if(!isset($points[$counter])){
				$options[$counter]=0;
			}
			
			$insert="INSERT INTO questions(question_id,question,points,question_type,cat_id)VALUES('','{$questions[$counter]}','{$points[$counter]}','$questionType','$category')";
			$query=$conn->query($insert);
			if($conn->affected_rows>0){
				echo"success";
			}
			else{
					echo"error".$conn->error;
			}
			$select="SELECT question_id FROM questions WHERE question='{$questions[$counter]}'";
			$query=$conn->query($select);
			$result=$query->fetch_array(MYSQLI_ASSOC);
			if(!isset($options[$counter])){
				$options[$counter]="";
			}
			else{
					for($optionCount=0;$optionCount<sizeOf($options[$counter]);$optionCount++){
						//print_r($options[$counter][$optionCount]);
						if($options[$counter][$optionCount]!=""){
							$insert="INSERT INTO question_options(option_id,options,question_id)VALUES('','{$options[$counter][$optionCount]}','{$result['question_id']}')";
							$query=$conn->query($insert);
							//print_r($answers[$counter][$optionCount]);
							foreach($answers[$counter] as $answer){
								echo($options[$counter][$optionCount]);
								if($answer==$options[$counter][$optionCount]){
								//echo("(".$options[$counter][$optionCount]." Answer)");
							$insert="INSERT INTO question_answers(answer_id,answer,question_id)VALUES('','{$options[$counter][$optionCount]}','{$result['question_id']}')";
							$query=$conn->query($insert);
								}
							else{
									echo("(".$options[$counter][$optionCount]." Wrong Answer)");
								}
							}
					}
				
				}
			
			}
		}
		
	}

}


?>