<?php
session_start();
include_once("includeFunction.php");

?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>User Login</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
<style type="text/css">
.btn{
	
background:blue!important;
color:white;	
	
}
</style>
    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><i class='fa fa-graduation-cap'></i> <strong>SCHOOL MANAGEMENT SYSTEM</strong></h1>
							<p align="center">Version 1.0</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3 class='text-primary'>Login Account Details</h3>
                            		<p class='text-danger'>Enter your email and password to login:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-lock" style="color:black"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
							<?php 
							if(isset($_SESSION['validation_error'])){
								echo"<span class='text-danger'><i class='fa fa-warning'></i> ".$_SESSION['validation_error']."</span>";
							unset($_SESSION['validation_error']);
							}
							
							if(isset($_SESSION['empty_field'])){
								
								echo"<div class='alert alert-danger alert-dismissable'>
									<button class='close' data-dismiss='alert' aria-hidden='true'> &times</button>
									<h4 class='page-header'>ERROR Some Field Where Not Filled</h4>";
									foreach($_SESSION['empty_field'] as $error){
										echo"<li style='list-style:none'><i class='fa fa-arrow-right'></i> $error</li>";
									}
									unset($_SESSION['empty_field']);
									echo"</div>";
							}
							
							if(isset($_SESSION['studentTokenError'])){
								echo"<span class='text-danger'><i class='fa fa-warning'></i> ".$_SESSION['studentTokenError']."</span>";
							unset($_SESSION['studentTokenError']);
							}
							
						if(isset($_SESSION['invalidTokenError'])){
								echo"<span class='text-danger'><i class='fa fa-warning'></i> ".$_SESSION['invalidTokenError']."</span>";
							unset($_SESSION['invalidTokenError']);
							}
							?>
			                    <form role="form" action="validate_user.php" method="post" class="">
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">Email</label>
			                        	<input type="text" name="email" placeholder="enter your email" class="form-username form-control" id="form-username">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">Password</label>
			                        	<input type="password" name="password" placeholder="enter your password" class="form-password form-control" id="form-password">
			                        </div>
									<div class="form-group">
			                        	<label class="sr-only" for="form-password">Role</label>
			                        	<select name="role" class="form-password form-control" id="role">
										<option disabled selected>--select your role --</option>
										<?php
										$stored_roles=array();
										$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
										if($conn->connect_error){
											
											
											die('could not connect to the database');
										} 
										else{
											
											$select="SELECT role FROM users";
											$query=$conn->query($select);
											while($results=$query->fetch_array(MYSQLI_ASSOC)){
												$stored_roles[]=$results['role'];
											}
											$roles=array_unique($stored_roles);
											foreach($roles as $role){
												
												echo"<option>$role</option>";
											
											}
										}
										
										
										
										?>
										</select>
			                        </div>
									<div class="form-group">
			                        	<label class="sr-only" for="form-token">Student Token</label>
										<input type="text" name="student_token" placeholder="Enter Student Token" class="form-control" id="student_token" >
			                        </div>
			                        <button type="submit" name="signin" class="btn">Sign in!</button>
			                    </form>
		                    </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){
			var selectedVal;
			$("#student_token").hide();
			$("#role").on("change",function(){
				selectedVal=$("#role").val();
				if(selectedVal=="parent"){
					$("#student_token").show();
				}
			});
			
			
		});
		</script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>