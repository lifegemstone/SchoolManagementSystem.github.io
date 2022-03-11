<?php 
include_once("validate_user.php");
 //include_once('functions.php');

if(isset($_SESSION['username'])){
	$username=$_SESSION['username'];
}
else{
		echo "session not set";
}

	$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME);
	$select="SELECT email FROM users WHERE name='".$username."'";
	$query=$conn->query($select);
	$results=$query->fetch_array(MYSQLI_ASSOC);
	$userEmail=$results['email'];
	

?>
<!DOCTYPE HTML>
<html>
<head><title>Pay School Fees</title>
<meta name="viewport" content="width=device-width initial-scale=1">
<link href="MDB-Free_4.7.1/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.css" rel="stylesheet" type="text/css">
<link href="MDB-Free_4.7.1/css/mdb.min.css" rel="stylesheet" type="text/css">
<link href="MDB-Free_4.7.1/css/style.css" rel="stylesheet" type="text/css">
<link href="css/eportalstyle.css" rel="stylesheet" type="text/css">
<link href="css/sb-admin-2.css" rel="stylesheet" type="text/css">
  <link href="css/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
	<script type="text/javascript" src="MDB-Free_4.7.1/js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="MDB-Free_4.7.1/js/popper.min.js"></script>
	<script type="text/javascript" src="MDB-Free_4.7.1/js/bootstrap.js"></script>
	<script type="text/javascript" src="MDB-Free_4.7.1/js/mdb.min.js"></script>
	
<style type='text/css'>
.footer{background:black;
color:white;
position:fixed;
bottom:0px;
width:100%;}
.link{text-decoration:none;color:white}
a:hover{text-decoration:none;color:white}
body{position:relative;}
#transactionDetails{display:none}
</style>
</head>
<body>
<?php 
validateUser::heading4();
//heading();?>
<br>
<div class="container">
<div class="rows">
<div class="col-xs-12 col-sm-12 col-md-lg col-lg-12">
<ol class="breadcrumb"> 
<li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i>PARENT</a></li> 
<li class="breadcrumb-item"><i class='fa fa-graduation-cap'></i> DASHBOARD</li> 
<li class="active breadcrumb-item">PAY SCHOOL FEES</li> 
</ol>
<?php if(isset($_SESSION['stud_success_msg'])){
	
	echo"<div class='alert alert-success'> 
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true'> &times </button>
	<h4 class='page-header'>SUCCESS</h4>
			<p>".$_SESSION['stud_success_msg']."</p>
			</div>"; 
			unset($_SESSION['stud_success_msg']);
}
 if(isset($_SESSION['stud_error_msg'])){
	 echo "<div class='alert alert-danger'>
	 <button type='button' class='close' data-dismiss='alert' aria-hidden='true' href='#'> &times </button>
			<h4 class='page-header'><i class='fa fa-warning'></i> ERROR</h4>
			<p>Sorry the following errors occurred while trying to register patient. Kindly attend to these errors and try again!!!</p>";
	 foreach($_SESSION['stud_error_msg'] as $_SESSION['error'])
	  { 
			
			echo"<p><i class='fa fa-warning'></i> ".$_SESSION['error']." .</p>";
			
			
	  }
	
	  echo"</div>";
	    unset($_SESSION['stud_error_msg']);
 }
?>
<br>
<div id="hideForm">
<h4 style="border-bottom:1px solid #eee;line-height:180%"><i class="fa fa-credit-card"></i> ENTER YOUR CREDIT CARD DETAILS BELOW</h4>
<span style="color:red"><p> Fill out the form below to make payement, kindly note that all fields marked (*) are required. A reciept of payment would be sent to your email. </p>
<p> Your Credit card details are not stored on our database and should only be used whenever you need to make a payment.</p>
</span>

<form  class="form-horizontal">
<script src="https://js.paystack.co/v1/inline.js"></script>
<!--<div class="form-group">
<label for="email" class="col-sm-3 control-label">First Name *</label>
<div class="col-sm-6">
<input type="text" name="firstName" autocomplete="off" id="fName" placeholder="Enter Your Firstname" class="form-control"/>
</div>
</div>
<div class="form-group">
<label for="email" class="col-sm-3 control-label">Last Name *</label>
<div class="col-sm-6">
<input type="text" name="lastName" autocomplete="off" id="lName" placeholder="Enter Your Lastname" class="form-control"/>
</div>
</div>-->
<div class="form-group">
<label for="sender-name" class="col-sm-3 control-label">Sender Name *</label>
<div class="col-sm-6">
<input type="text" name="senderName" autocomplete="off" id="senderName" placeholder="Enter Your Full Name" class="form-control"/>
</div>
</div>
<div class="form-group">
<label for="phone-number" class="col-sm-3 control-label">Phone Number *</label>
<div class="col-sm-6">
<input type="text"  name="phoneNumber" autocomplete="off" id="phoneNumber" placeholder="Enter Your Phone Number" class="form-control"/>
</div>
</div>
<div class="form-group">
<label for="email" class="col-sm-3 control-label">Email *</label>
<div class="col-sm-6">
<input type="text" name="email" autocomplete="off" id="email" placeholder="Enter Your Email" class="form-control"/><br>
<input type="hidden" name="userEmail" id="userEmail" value="<?php echo $userEmail;?>" />
<button class="btn btn-primary btn-md" id="button" type="button" >Click Button To Continue</button>

</div>
</div>

</form>
</div>
<br><br>
<div id="transactionDetails">
</div>
<br><br><br>
<script>
$(document).ready(function(){
	var flag;
	$("#button").on("click",function(){
		//alert("clicked");
		if(($("#senderName").val()=="")||($("#phoneNumber").val()=="")||($("#email").val()=="")){
			
			alert("Sorry All Fields Must Be Filled Out Before Payment Can Be Made");
			flag=false;
		}
		else{
				if(!flag){
			
				payWithPaystack();
				
				}
				
		}
	});
  function payWithPaystack(){
	  var email=document.getElementById("email").value;
      var senderName=document.getElementById("senderName").value;
	  var phoneNumber=document.getElementById("phoneNumber").value; 
	  var userEmail=document.getElementById("userEmail").value;
    var handler = PaystackPop.setup({
      key: 'pk_test_320c9145825f5e6ac00db50301b10dd247c66216',
      email: ''+email,
      amount: 5000,
	 
      //ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
      metadata: {
         custom_fields: [
            {
                display_name: "Mobile Number",
                variable_name: "mobile_number",
                value: ""+phoneNumber,
				
            },
			  {
                display_name: "Paid By",
                variable_name: "sender_name",
                value: ""+senderName,
				
            }
         ]
      },
      callback: function(response){
		  $("#hideForm").html("LOADING PLEASE WAIT.....");
		  
		  $.ajax({
					url:"https://myschoolmanagementsystem.000webhostapp.com/SMS/verifyTransaction.php",
					method:"POST",
					data:{reference:response.reference,userEmail:userEmail},
					dataType:"json",
					success:function(data){
						console.log(data);
						$("#transactionDetails").html("<div class='card'> <h5 class='card-header'>Transaction ID::"+ response.reference+"</h5><div class='card-body'><h5 class='card-title'>Payment Information</h5><p class='card-text'> Transaction ID: " +data.id+ "</p>"+
							"<p class='card-text'> Transaction Reference: " +data.reference+ "</p>"+ 
							"<p class='card-text'> Transaction Date:" + data.date +"</p>"+ 
							"<p class='card-text'> Transaction Status:" + data.status +"</p>"+ 
							"<p class='card-text'> Payment Channel:" + data.channel +"</p>"+ 
							"<p class='card-text'> Amount Paid :"+ data.amount +"</p>"+ 
							"<p class='card-text'>" +data.senderName+ ":"+ data.senderValue +"</p>"+ 
							"<p class='card-text'>" +data.displayName+ ":"+ data.phoneNumber +"</p>"+ 	
						"<a href='#' class='btn btn-primary' id='close'> Close </a> </div></div>");
						$("#transactionDetails").show();
						$("#hideForm").hide();
						$("#close").on("click",function(){
							window.location="http://localhost/SMS/payFees.php";
						});
					}
			  		
		    
      });
	  //window.location= "http://localhost/SMS/verifyTransaction.php?reference=" + response.reference
    
	  },
      onClose: function(){
          alert('window closed');
      }
	    });
    handler.openIframe();
  }

})
</script>
			 </div>
			 </div>
			 </div>
<div class="footer">
		<footer>
<p align="center"> <strong>&copy <?php echo date('Y');?>  Vinebranch School Management System </strong></p>
</footer>

</script>
</body>
</html>
</body>
</html>