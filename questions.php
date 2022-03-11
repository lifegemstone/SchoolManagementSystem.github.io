<?PHP

if(isset($_GET['questionType'])){
	$questionType=$_GET['questionType'];
}
if(isset($_GET['numberOfQuestions'])){
	$numberOfQuestions=$_GET['numberOfQuestions'];
}


switch($questionType){
	case "Multichoice":
	
	for($counter=1;$counter<=$numberOfQuestions;$counter++){
		
		echo"<div class='form-group'>
		<label>".
		($counter % 2==0?"<span class='text-danger'>Question$counter":"<span class='text-success'>Question$counter</span>");
		echo"</label> 
		<input type='text' name='questions[]' id='question$counter' class='form-control'>
		<br>
		<label class='control-label'>Enter Number of Options Question $counter:<input type='number' id='$counter' class='form-control options'><br><br>
		<div id='ajaxLoader$counter'></div>
		<script>
		$(document).ready(function(){
			var options;
			var id;
		$('.options').keyup(function(){
						id=$(this).attr('id');
						options=$(this).val();			
						$('#ajaxLoader'+id).load('ajaxLoadOptions.php?numberOfOptions='+options+'&id='+id);
				});
			});
		</script>
		
		<label class='control-label'>Enter points for Question $counter:</label>
		<input type='text' name='points[]' class='form-control'>
		</div>";
		
		
	}
	break;
	case "Text":
		for($counter=1;$counter<$numberOfQuestions;$counter++){
		
		echo"<label class='control-label'>Question $counter:</label> <input type='text' name='question[]' id='question$counter' class='form-control'><br>
		<label class='control-label'>Enter points for Question $counter:</label>
		<input type='text' name='points[]' class='form-control'>";
		
		
	}
	break;
	default:
	echo"Invalid Selection Type";
}


?>
