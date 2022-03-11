<?php
//include_once('validate_user.php');
function heading(){
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
<li class="active"><a href="sms_index.php"><i class="fa fa-graduation-cap"></i> Vinebranch School Management System</a></li>
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> Settings <b class="caret"></b></a>
		<ul class="dropdown-menu">
		<li><a href="#"><i class="fa fa-image"></i> Upload profile picture</a></li>
		<li class="divider"></li>
		<li><a href="#"><i class="fa fa-unlock"></i> Change your password</a></li>
		<li class="divider"></li>
		<li><a href="#"><i class="fa fa-user"></i> My Profile</a></li>	
			<li class="divider"></li>
		<li><a href="#"><i class="fa fa-database"></i> Backup Options</a></li>	
		</ul>
		</li>
	<li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>';
	//<li><a href="#" style="color:green"><i class="fa fa-user"></i> Signed In As '.validateUser::get_username().'</a></li>
		echo'<li><a href="#"><i class="fa fa-calendar"></i> '.date("l M Y").'</a></li>';
		//<li><a href="#" style="color:green"><i class="fa fa-circle" style="font-size:1em"></i> online</a></li>
echo'</ul>
</div>
</nav>';


}

function heading2(){
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
<li class="active"><a href="tutors_home.php"><i class="fa fa-dashboard"></i>HMO</a></li>
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> Settings <b class="caret"></b></a>
		<ul class="dropdown-menu">
		<li><a href="admin.php"><i class="fa fa-user-plus"></i> Add User</a></li>
		<li class="divider"></li>
		<li><a href="reset_password.php"><i class="fa fa-unlock"></i> Reset User password</a></li>
		<li class="divider"></li>
		<li><a href="#"><i class="fa fa-user"></i> Delete User </a></li>	
			<li class="divider"></li>
		<li><a href="#"><i class="fa fa-database"></i> Backup Options</a></li>	
		</ul>
		</li>
	<li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
	<li><a href="#" style="color:green"><i class="fa fa-user"></i> Signed In As '.validateUser::get_username().'</a></li>
		<li><a href="#"><i class="fa fa-calendar"></i> '.date("l M Y").'</a></li>
		<li><a href="#" style="color:green"><i class="fa fa-circle" style="font-size:1em"></i> online</a></li>
</ul>
</div>
</nav>';

}

?>