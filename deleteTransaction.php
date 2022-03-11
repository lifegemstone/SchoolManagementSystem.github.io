<?php
session_start();
include_once("includeFunction.php");
if(isset($_GET['transacRef'])){
	
	$transactionReference=$_GET['transacRef'];
}

 $conn=new mysqli(SERVER_NAME,DB_USER,DB_PASSWORD,DB_NAME) or die("could not connect to the database");
$delete="DELETE FROM transaction_data WHERE transaction_reference='$transactionReference'";
$query=$mysqli->query($delete);
if($mysqli->affected_rows>0){
	$_SESSION["transactionDeleteSuccess"]="Transaction $transactionReference has been successfully deleted.";
	header("location:transactionHistory.php");
}







?>