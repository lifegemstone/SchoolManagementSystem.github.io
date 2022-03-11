<?PHP

if(isset($_GET['numberOfOptions'])){
	$numberOfOptions=$_GET['numberOfOptions'];
}
if(isset($_GET['id'])){
	$id=(($_GET['id'])-1);
	
}
$counter=1;
for(;$counter<=$numberOfOptions;$counter++){
					
		echo" Option $counter <input type=text name=options[".$id."][] id=$id$counter class=form-control /><input type=checkbox name=answers[".$id."][] id=answer$id$counter />Mark as answer<br><br>";
				echo"<script>
				$(document).ready(function(){
					var id;
					var val;
					$('input[type=text]').click(function(){
						
						id=$(this).attr('id');
						
						$(this).keyup(function(){
							val=$(this).val();
							$('#answer'+id).val(val);
							
						});
					});	
				});
				</script>";
	
	
	
}



?>