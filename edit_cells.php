<?php
if(isset($_POST['cell_name'])){
	
	$cell_name=$_POST['cell_name'];
}
if(isset($_POST['td_id'])){
	
	$td_id=$_POST['td_id'];
}
if(isset($_POST['tbl_id'])){
	
	$tbl_id=$_POST['tbl_id'];
}
//Handles file submission;
//Handles form value
echo"
<input type='text' value='$cell_name' class='click' name='my_name[]' />
<input type='hidden' value='$td_id'  name='td_id' />
<input type='hidden' value='$tbl_id' name='tbl_id' />
";

	






?>