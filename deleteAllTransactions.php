<?php
session_start();
include_once("includeFunction.php");
if(isset($_GET['email'])){
	
	$userEmail=base64_decode($_GET['email']);
	echo $userEmail;
}

$conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME) or die("could not connect to the database");
$delete="DELETE FROM transaction_data WHERE email='$userEmail'";
$query=$mysqli->query($delete);
if($mysqli->affected_rows>0){
	$_SESSION["allTransactionDeleteSuccess"]="All Transactions have been successfully deleted.";
	header("location:transactionHistory.php");
}
else{
	
			$_SESSION["allTransactionDeleteSuccess"]="No Transaction Available.";
			header("location:transactionHistory.php");
	
}




?>