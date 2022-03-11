<?PHP
session_start();
include_once("includeFunction.php");
if($_SERVER["REQUEST_METHOD"]=="POST"){
	$error=array();
	if(!empty($_POST["category"])){
		
		
		$assignmentCategory=$_POST["category"];
		
		
	}
	else{
			
			$error[]="Category Name cannot be empty!!!";
	}
	
	if(empty($error)){
		
		$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
		if($conn->connect_error) die("Could not connect to the database");
		else{
			
				$select="SELECT category_name FROM assignment_category WHERE category_name='$assignmentCategory'";
				$query=$conn->query($select);
				if($query->num_rows>0){
					$_SESSION["categoryDuplicate"]="Sorry Category Name Already exists try again";
					header("location:doCreateAssignmentCategory.php");
				}
				else{
						$insert="INSERT INTO assignment_category(category_id,category_name)VALUES('','$assignmentCategory')";
						$query=$conn->query($insert);
						if($conn->affected_rows==1){
							$_SESSION["categoryCreationSuccess"]="Category was successfully created";
							header("location:create_assignment_category.php");
					
					}
			
			}
		
		
		}
	}
	else{
			$_SESSION['assignmentCategoryError']=$error;
			header("location:create_assignment_category.php");
		
	}

}

?>