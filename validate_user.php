<?php
session_start();
include_once("includeFunction.php");
 class validateUser{
	public static $email;
	public static $password;
	public static $role;
	public static $username;
	public static $user;
	public static $student_token;
	public static function  validate_user(){
if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['signin'])){
	if(!empty(strip_tags(trim($_POST['email'])))){
		if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
			SELF::$email=$_POST['email'];
		
			}
		else{
			$errors[]='Please enter a valid email';
			
			
		}
	}
	else{
		
		$errors[]='Please enter your email';
		}
	
	if(!empty($_POST['password'])){
		SELF::$password=sha1($_POST['password']);
	}
		else{
				$errors[]='please enter your password';
		}
		if(!empty($_POST['role'])){
		SELF::$role=$_POST['role'];
	}
		else{
				$errors[]='please select your role';
		}
		
		if(isset($_POST['student_token'])){
		SELF::$student_token=$_POST['student_token'];
	}
		
		if(empty($errors)){
		
			switch(SELF::$role){
			case "admin":
			$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
			if($conn->connect_error){
				die('could not connect to the database');
			}
			else{
				
		$select="SELECT name,email,default_password,role FROM users WHERE email='".SELF::$email ."' AND role='".SELF::$role ."'";
		$query=$conn->query($select);
		if($query->num_rows > 0){
	    	while($results=$query->fetch_array(MYSQLI_ASSOC)){
			$stored_email=$results['email'];
			$stored_password=$results['default_password'];
			$stored_role=$results['role'];
			 SELF::$username=$results['name'];
			 SELF::$role=$results['role'];
	        	}
		if(SELF::$email==$stored_email && SELF::$password==$stored_password){
			$user_mail=$stored_email;
			$token=openssl_random_pseudo_bytes("16",$user_email);
			$_SESSION['user_token']=bin2hex($token);
			$update="UPDATE users SET user_token='".$_SESSION['user_token']."' WHERE email='".$user_mail."'";
			$query=$conn->query($update);
			$_SESSION['username']=SELF::$username;
			$_SESSION['role']=SELF::$role;
			header('location:admin_index.php?usrcd='.$_SESSION['user_token'].'');
			}
			else{
			    
			    	$_SESSION['validation_error']="Email or Password incorrect pls try again";
				header('location:login.php');
			}
		}
		else{
				$_SESSION['validation_error']="Email or Password incorrect pls try again";
				header('location:login.php');
			}
	}
			break;
			
			case "teacher":
			$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
			if($conn->connect_error){
				die('could not connect to the database');
			}
			else{
				
		$select="SELECT name,email,default_password,role FROM users WHERE email='".SELF::$email."' AND role='".SELF::$role."'";
		$query=$conn->query($select);
	if($query->num_rows > 0){
		while($results=$query->fetch_array(MYSQLI_ASSOC)){
			$stored_email=$results['email'];
			$stored_password=$results['default_password'];
			$stored_role=$results['role'];
			SELF::$username=$results['name'];
			 SELF::$role=$results['role'];
		    }
		if(SELF::$email==$stored_email && SELF::$password==$stored_password){
			$user_mail=$stored_email;
			$token=openssl_random_pseudo_bytes("16",$user_email);
			$_SESSION['user_token']=bin2hex($token);
			$update="UPDATE users SET user_token='".$_SESSION['user_token']."' WHERE email='".$user_mail."'";
			$query=$conn->query($update);
			$_SESSION['username']=SELF::$username;
			$_SESSION['email']=SELF::$email;
			$_SESSION['role']=SELF::$role;
			header('location:teachers_index.php?usrcd='.$_SESSION['user_token'].'');
			}
		else{
				$_SESSION['validation_error']="Email or Password incorrect pls try again";
				header('location:login.php');
			}
	}
		else{
				$_SESSION['validation_error']="Email or Password incorrect pls try again";
				header('location:login.php');
			}
		}
			break;
			case "parent":
			$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
			if($conn->connect_error){
				die('could not connect to the database');
			}
			else{
				
		$select="SELECT name,email,default_password,role FROM users WHERE email='".SELF::$email."' AND role='".SELF::$role."'";
		$query=$conn->query($select);
		if($query->num_rows > 0){
		while($results=$query->fetch_array(MYSQLI_ASSOC)){
			$stored_email=$results['email'];
			$stored_password=$results['default_password'];
			$stored_role=$results['role'];
			SELF::$username=$results['name'];
			 SELF::$role=$results['role'];
		}
		if(SELF::$email==$stored_email && SELF::$password==$stored_password){
			if(empty(SELF::$student_token)){
				$_SESSION['studentTokenError']="Enter Student Token";
				header('location:login.php');
			}
			else{
				
					$user_mail=$stored_email;
					$token=openssl_random_pseudo_bytes("16",$user_email);
					$_SESSION['user_token']=bin2hex($token);
					$update="UPDATE users SET user_token='".$_SESSION['user_token']."' WHERE email='".$user_mail."'";
					$query=$conn->query($update);
					$select="SELECT student_id,class_name FROM students WHERE student_token='".SELF::$student_token."'";
					$query=$conn->query($select);
					if($query->num_rows>0){
						$returnedResults=$query->fetch_array(MYSQLI_ASSOC);
						$student_id=$returnedResults['student_id'];
						$class_name=$returnedResults['class_name'];
						$_SESSION['username']=SELF::$username;
						$_SESSION['token']=SELF::$student_token;
						$_SESSION['role']=SELF::$role;
						header('location:parent_index.php?usrcd='.$_SESSION['user_token'].'');
						//header("location:view_reportCardArchives.php?stud_id=$student_id &class_name=$class_name");
				}
				else{
							$_SESSION['invalidTokenError']="No Records Found With the Token";
							header('location:login.php');
				}
			}
		
		}
		else{
				$_SESSION['validation_error']="Email or Password incorrect pls try again";
				header('location:login.php');
			}
		}
			else{
				$_SESSION['validation_error']="Email or Password incorrect pls try again";
				header('location:login.php');
			}
		}
			break;
			default:
			echo"";
			}
		}
		else{
			
		$_SESSION['empty_field']=$errors;
		header('location:login.php');
		}
		
		}
	}
}
 public static function  get_username(){
	 if(isset($_SESSION['username'])){
		 SELF::$user=$_SESSION['username'];
			return(SELF::$user);
		}
 }
	
 public static function  get_email(){
	  if(isset($_SESSION['email'])){
		 SELF::$email=$_SESSION['email'];
			return(SELF::$email);
		
	  }
	 }

	  public static function  getRole(){
	    if(isset($_SESSION['role'])){
		 SELF::$role=$_SESSION['role'];
			return(SELF::$role);
		
	  }
		
	  }
	 
public static	function heading(){
	
echo'
		<nav class="navbar navbar-inverse" role="navigation">
		<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse">
		<span class="icon-bar"></span> 
		<span class="icon-bar"></span> 
		<span class="icon-bar"></span> 
		</button>
		</div>
		<div class="collapse navbar-collapse" id="example-navbar-collapse">
		<ul class="nav navbar-nav">
		<li class="active"><a href="#"><i class="fa fa-graduation-cap"></i>School Management System</a></li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> Settings <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="#"><i class="fa fa-unlock"></i>Change Password</a></li>
				</ul>
				</li>
			<li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
			<li><a href="#" style="color:green"><i class="fa fa-user"></i> '.$_SESSION['username'].'</a></li>
				<li><a href="#"><i class="fa fa-calendar"></i> '.date("l dS M Y").'</a></li>
				<li><a href="#" style="color:green"><i class="fa fa-circle" style="font-size:1em"></i> online</a></li>
		</ul>
		</div>
		</nav>';

}

public static function heading2(){
	
echo'
<nav class="navbar navbar-inverse" role="navigation">
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse">
<span class="icon-bar"></span> 
<span class="icon-bar"></span> 
<span class="icon-bar"></span> 
</button>
</div>
<div class="collapse navbar-collapse" id="example-navbar-collapse">
<ul class="nav navbar-nav">
<li class="active"><a href="admin_index.php?usrcd='.$_SESSION['user_token'].'"><i class="fa fa-graduation-cap"></i>School Management System</a></li>
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> Settings <b class="caret"></b></a>
		<ul class="dropdown-menu">
		<!--<li><a href="set_grading.php"><i class="fa fa-tasks"></i> Set Grading System</a></li>-->
		<!--<li class="divider"></li>-->
		<li><a href="admin.php"><i class="fa fa-user-plus"></i> Add User</a></li>
		<li class="divider"></li>
		<li><a href="app_users.php?usrcd='.$_SESSION['user_token'].'"><i class="fa fa-users"></i>App Users</a></li>
			<li class="divider"></li>
		<li><a href="myphp-backup.php?usrcd='.$_SESSION['user_token'].'"><i class="fa fa-database"></i> Backup Database</a></li>	
		</ul>
		</li>
	<li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
	<li><a href="#" style="color:green"><i class="fa fa-user"></i> '.$_SESSION['username'].'</a></li>
		<li><a href="#"><i class="fa fa-calendar"></i> '.date("l dS M Y").'</a></li>
		<li><a href="#" style="color:green"><i class="fa fa-circle" style="font-size:1em"></i> online</a></li>
</ul>
</div>
</nav>';

}
public static function heading3(){
	
echo'
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#example-navbar-collapse">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="example-navbar-collapse">
<ul class="nav navbar-nav">
<li class="active nav-item"><a href="admin_index.php?usrcd='.$_SESSION['user_token'].'" class="nav-link"><i class="fa fa-graduation-cap"></i> School Management System</a></li>
	<li class="dropdown nav-item" >
		<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="fa fa-cog"></i> Settings <b class="caret"></b></a>
		<ul class="dropdown-menu">
		<!--<li><a href="set_grading.php" class="dropdown-item"><i class="fa fa-tasks"></i> Set Grading System</a></li>
		<li class="dropdown-divider"></li>-->
		<li><a href="admin.php" class="dropdown-item"><i class="fa fa-user-plus"></i> Add User</a></li>
		<li class="dropdown-divider"></li>
		<li><a href="app_users.php?usrcd='.$_SESSION['user_token'].'" class="dropdown-item"><i class="fa fa-users"></i> App Users</a></li>
		<li class="dropdown-divider"></li>
		<li><a href="myphp-backup.php?usrcd='.$_SESSION['user_token'].'" class="dropdown-item"><i class="fa fa-database"></i> Backup Database</a></li>	
		</ul>
		</li>
	<li class="nav-item"><a href="logout.php" class="nav-link"><i class="fa fa-power-off"></i> Logout</a></li>
	<li class="nav-item"><a href="#" style="color:green" class="nav-link"><i class="fa fa-user"></i> '.$_SESSION['username'].'</a></li>
		<li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-calendar"></i> '.date("l dS M Y").'</a></li>
		<li class="nav-item"><a href="#" style="color:green" class="nav-link"><i class="fa fa-circle" style="font-size:1em"></i> online</a></li>
</ul>
</div>
</nav>';

}



public static function heading4(){
	
echo'
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#example-navbar-collapse">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="example-navbar-collapse">
<ul class="nav navbar-nav">
<li class="active nav-item"><a href="#" class="nav-link"><i class="fa fa-graduation-cap"></i> School Management System</a></li>
	<li class="dropdown nav-item" >
		<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="fa fa-cog"></i> Settings <b class="caret"></b></a>
		<ul class="dropdown-menu">
		<li><a href="#"><i class="fa fa-unlock"></i>Change Password</a></li>		
		</ul>
		</li>
	<li class="nav-item"><a href="logout.php" class="nav-link"><i class="fa fa-power-off"></i> Logout</a></li>
	<li class="nav-item"><a href="#" style="color:green" class="nav-link"><i class="fa fa-user"></i> '.$_SESSION['username'].'</a></li>
		<li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-calendar"></i> '.date("l dS M Y").'</a></li>
		<li class="nav-item"><a href="#" style="color:green" class="nav-link"><i class="fa fa-circle" style="font-size:1em"></i> online</a></li>
</ul>
</div>
</nav>';

}
public static function logout(){
	
	$_SESSION=array();
	session_destroy();
	header('location:login.php');
	
}

 }
validateUser::validate_user();

?>