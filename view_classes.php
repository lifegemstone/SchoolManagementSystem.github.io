<?php 
include_once('validate_user.php');
if(isset($_GET['usrcd'])){
		$usrcd=$_GET['usrcd'];
	}
else{
	
		exit();
}
if(isset($_SESSION['username'])){
	$username=$_SESSION['username'];
}
else{
		echo "session not set";
}
	$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
	$select="SELECT user_token FROM users WHERE name='".$username."'";
	$query=$conn->query($select);
	$results=$query->fetch_array(MYSQLI_ASSOC);
	$user_token=$results['user_token'];
		if($usrcd != $user_token){
			validateUser::logout();
			
			
		}
?>
<!DOCTYPE HTML>
<html>
<head><title>View Classes</title>
<meta name="viewport" content="width=device-width initial-scale=1">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.css" rel="stylesheet" type="text/css">
<link href="css/sb-admin-2.css" rel="stylesheet" type="text/css">
  <link href="css/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
	<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="datatables/js/jquery.dataTables.min.js"></script>
    <script src="datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="datatables-responsive/dataTables.responsive.js"></script>
	  <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
	function edit_class(id){
	var className=document.getElementById(id).innerHTML;
	document.getElementById(id).innerHTML="<input type='text'  id='className"+id+"' value='"+className+"' />";
		 document.getElementById('edit'+id).style.display="none";
		 document.getElementById('save'+id).style.display="block";
		 
	}
	
	
	function save_class(id){
	  document.getElementById('edit'+id).style.display="block";
		 document.getElementById('save'+id).style.display="none";
		 var  class_name=document.getElementById('className'+id).value;
		 $.ajax({
			 type:'POST',
			 url:'do_editClasses.php',
			 data:{
					 save_class:'save_class',
					 class_name:class_name,
					 class_id:id,
					
			 },
			 success:function(response){
				 if(response=="success"){
					 document.getElementById(id).innerHTML=class_name;
				 }
			 }
			
		 });
		 
	}
	
	
		function delete_class(id){
		  
	 // document.getElementById('edit'+id).style.display="block";
		// document.getElementById('save'+id).style.display="none";
		 var class_name=document.getElementById(id).innerHTML;
		 $.ajax({
			 type:'POST',
			 url:'do_editClasses.php',
			 data:{
					 delete_class:'delete_class',
					 class_name:class_name,
					 class_id:id,
					
			 },
			 success:function(response){
				 if(response=="success"){
				     
				     alert(class_name +" Deleted Successfully!!! ");
					 //document.getElementById(id).innerHTML=class_name;
				 }
			 }
			
		 });
		 
	}
    </script>
<style type='text/css'>
.footer{background:black;color:white;position:fixed;bottom:0;margin:0px;width:100%;}
.link{text-decoration:none;color:white}
a:hover{text-decoration:none;color:blue}
.save{display:none}
</style>
</head>
<body>
<?php validateUser::heading2();?>
<div class="container">
<div class="rows">
<div class="col-xs-12 col-sm-12 col-md-lg col-lg-12">
<ol class="breadcrumb"> 
<li><a href="#"><i class="fa fa-home"></i>School Management System</a></li> 
<li class=""><i class="fa fa-dashboard"></i> DASHBOARD</li> 
<li class="active"><i class="fa fa-eye"></i> VIEW CLASSES</li> 
</ol>
			
			<?php if(isset($_SESSION['deleted_successful'])){
	
	echo"<div class='alert alert-success'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h4 class='page-header'><i class='fa fa-check'></i> SUCCESS </h4>
			<p>".$_SESSION['deleted_successful']."</p>
			</div>"; 
			unset($_SESSION['deleted_successful']);
}
		?>	 
			
			<?php if(isset($_SESSION['deleted_error'])){
	
	echo"<div class='alert alert-danger'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h4 class='page-header'><i class='fa fa-bell'></i> ERROR </h4>
			<p>".$_SESSION['deleted_error']."</p>
			</div>"; 
			unset($_SESSION['delete_error']);
}
		?>
		<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
								
                                    <tr>
                                          
                                        <th> S/N </th>
                                        <th>Class Name</th>
                                        <th>Edit Class</th>
										<!--<th>Drop Class</th>-->
                                    </tr>
                                </thead>
                                <tbody>
						<?php 
								$id=1;
								$conn=mysqli_connect(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME)or die('could not connect to the databse'.mysqli_connect_error());
						$select1="SELECT * FROM school_classes ORDER BY class_name ";
						$query1=mysqli_query($conn,$select1);
						while($results=mysqli_fetch_array($query1,MYSQLI_ASSOC))
						{ 
							$class_id=$results['class_id'];
						echo '<tr>
                                  <td>'.$id.'</td>
								   <form action="do_editClasses.php" method="POST" onsubmit="event.preventDefault();"><td id='.$id.'>'.$results['class_name'].'</td>
								    <td align="center"><button type="button" class="btn btn-sm btn-primary" id=edit'.$id.' onclick="edit_class('.$id.')" >EDIT</button><button type="submit" class="btn btn-sm btn-success save" id=save'.$id.' onclick="save_class('.$id.')" >SAVE</button> </td>
									';
									//<td align="center"><a href="drop_class.php?c_id='.$class_id.'&usrcd='.$usrcd.'"><i class="fa fa-trash"></i></a></td>
						
						echo'</form></tr>';
						$id++;}
                                        
                                  
                       
							 ?>
                                
                                </tbody>
								
                            </table>
							</div>
			 </div>
			 </div><br>
			 
<div class="footer" >
		<footer>
<p align="center"> <strong>&copy <?php echo date('Y');?> Vinebranch School Management System </strong></p>
</footer>
</div>
</body>
</html>